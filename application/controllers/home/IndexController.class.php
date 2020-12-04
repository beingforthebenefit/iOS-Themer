<?php
// application/controllers/admin/IndexController.class.php

include UTIL_PATH . 'XML.class.php';
include UTIL_PATH . 'SSL.class.php';

class IndexController extends Controller {

    // build :: void -> void
    public function build($path, $model = [ ]) {
        ob_start();
        $this->headerAction();
        $this->menuAction();
        include $path;
        $this->footerAction();
        return ob_get_clean();
    }

    // indexAction :: void -> void
    public function indexAction($icons = [ ]) {
        if (empty($icons)) {
            if (!array_key_exists('icons', $_SESSION)) {
                $_SESSION['icons'] = [ ];
            }
            $icons = $_SESSION['icons'];
        }

        $_SESSION['icons'] = $icons;

        echo $this->build(CURR_VIEW_PATH . 'main.php', $icons);
    }

    public function uploadAction() {
        $_SESSION['editMode'] = false;
        $_SESSION['tab'] = $_POST['tab'];
        $_SESSION['page'] = $_POST['page'];
        $errors = [];
        $fileType = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
        if (array_key_exists('submit', $_POST)) {
            $size = getimagesize($_FILES['icon']['tmp_name']);
            if ($fail = !$size) {
                $errors[] = "File is not an image.";
            } else if ($fail = $_FILES['icon']['size'] > 500000) {
                $errors[] = "File too large. Must be under 500KB.";
            } else if ($fail = !in_array($fileType, ['jpg', 'jpeg', 'gif', 'png'])) {
                $errors[] = "Only JPG, GIF, or PNG files are allowed.";
            } else if ($fail = $_FILES['icon']['error']) {
                $errors[] = "There was an error uploading this file.";
            }
        } else {
            $fail = true;
        }

        if (!$fail) {
            $urls = json_decode(file_get_contents(CONFIG_PATH . 'urls.json'), true);
            $urls = $_REQUEST['ios14_3'] ? array_filter($urls, function($key) {
                return 'apple' != explode('.', $key)[1];
            }, ARRAY_FILTER_USE_KEY) : $urls;
            if (array_key_exists($_REQUEST['bundleId'], $urls)) {
                $url = array_key_exists($_REQUEST['bundleId'], $urls) ? $urls[$_REQUEST['bundleId']] : '';
            }

            $_SESSION['icons'][] = serialize(
                new IconModel(
                    $_REQUEST['label'],
                    $_REQUEST['bundleId'],
                    $_FILES['icon']['tmp_name'],
                    $fileType,
                    $url ?? ' '
                )
            );
        } else {
            $_SESSION['errors'] = $errors;
        }

        return $this->indexAction();
    }

    public function batchUploadAction() {
        $_SESSION['editMode'] = false;
        $_SESSION['tab'] = $_POST['tab'];
        $_SESSION['page'] = $_POST['page'];
        $icons = [ ];
        $labels = [ ];
        $bundleIds = [ ];
        $fileTypes = [ ];
        $systemApps = json_decode(file_get_contents(CONFIG_PATH . 'default-apps.json'), true);
        foreach ($_FILES['icon']['name'] as $id) {
            $bundleId = explode('-', $id)[0];
            $response = json_decode(
                file_get_contents('https://itunes.apple.com/lookup?bundleId=' . $bundleId),
                true
            );
            if ($response['resultCount'] == 1) {
                $label = $response['results'][0]['trackName'];
            } else {
                $label = array_search($bundleId, $systemApps);
            }

            if ($label) {
                $labels[] = $label;
                $bundleIds[] = $bundleId;
                $fileTypes[] = strtolower(pathinfo($id, PATHINFO_EXTENSION));
            }
        }

        for ($i = 0; $i < count($labels); $i++) {
            $_SESSION['icons'][] = serialize(
                new IconModel(
                    $labels[$i],
                    $bundleIds[$i],
                    $_FILES['icon']['tmp_name'][$i],
                    $fileTypes[$i],
                    ' '
                )
            );
        }

        return $this->indexAction();
    }

    public function downloadAction() {

        header('Content-Type: application/xml;');
        header('Content-Disposition: attachment; filename=MyTheme.mobileconfig');

        if (DEBUG) {
            echo \XML::createConfig($_SESSION['icons']);
            exit;
        }
        $hash = md5(date('ymdhmsu'));
        mkdir(TEMP_PATH . $hash, 0777);
        exec("echo " . \XML::createConfig($_SESSION['icons']) . ">>" . TEMP_PATH . $hash . '/unsigned.mobileconfig');
        $result = \SSL::sign(TEMP_PATH . $hash . '/unsigned.mobileconfig', TEMP_PATH . $hash . '/signed.mobileconfig');
        var_dump($result);die;
        echo file_get_contents(TEMP_PATH . $hash . '/signed.mobileconfig');
    }

    public function deleteAction() {
        $_SESSION['editMode'] = true;
        $_SESSION['page'] = 'installer';
        $_SESSION['icons'] = array_filter(
            $_SESSION['icons'],
            function ($icon) {
                $icon = unserialize($icon);
                return $icon->PayloadUUID != $_POST['delete'];
            }
        );

        return $this->indexAction();
    }

    public function deleteAllAction() {
        $_SESSION['editMode'] = false;
        $_SESSION['page'] = 'installer';

        unset($_SESSION['icons']);

        return $this->indexAction();
    }

    // Dangerous function. Use with caution.
    // public function saveIconsAction() {
    //     file_put_contents(UPLOAD_PATH . 'example.icons', serialize($_SESSION['icons']));
    // }

    public function loadIconsAction() {
        $_SESSION['editMode'] = false;
        
        $_SESSION['icons'] = unserialize(file_get_contents('uploads/example.icons'));

        return $this->indexAction();
    }

    public function importArchiveAction() {
        $keys = new ApiKeyModel('apiKeys');
        if (!$keys->validate($_POST['key'])) {
            $_SESSION['errors'][] = 'Invalid API Key';
            return $this->indexAction();
        } else {
            $keys->logUsage($_POST['key']);
        }

        $hash = md5(date('ymdhmsu'));
        $zipFile = UPLOAD_PATH . "{$hash}.zip";

        set_time_limit(0);
        $temp = file_get_contents($_POST['file']);
        file_put_contents($zipFile, $temp);

        $destPath = TEMP_PATH . $hash . '/';
        $destFile = 'ready.icons';

        // Extract files to temp directory
        exec("unzip -q \"$zipFile\" -d \"$destPath\"");
        exec("ls {$destPath}*.png", $list);

        $icons = [ ];
        foreach ($list as $icon) {
            $parts = explode('-', pathinfo($icon)['filename']);
            $label = implode('-', array_slice($parts, 1));
            $bundleId = $parts[0];

            $icons[] = serialize(
                new IconModel(
                    $label,
                    $bundleId,
                    $icon,
                    'png',
                    ' '
                )
            );
        }

        // Clean up files
        exec("rm {$zipFile}");
        exec("rm {$destPath}*");
        exec("rmdir {$destPath}");

        $_SESSION['messages'][] = 'Icon pack successfully loaded from ' . $_SERVER["HTTP_REFERER"];
        $_SESSION['icons'] = $icons;

        return $this->downloadAction();
    }

    // menuAction :: void -> void
    public function menuAction() {
        include CURR_VIEW_PATH . 'menu.php';
    }

    // headerAction :: void -> void
    public function headerAction() {
        include CURR_VIEW_PATH . 'header.php';
    }

    // footerAction :: void -> void
    public function footerAction() {
        include CURR_VIEW_PATH . 'footer.php';
    }
}