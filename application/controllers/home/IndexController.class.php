<?php
// application/controllers/admin/IndexController.class.php

include UTIL_PATH . 'XML.class.php';
include UTIL_PATH . 'SSL.class.php';

class IndexController extends Controller {

    // MAX_FILE_SIZE :: int
    public const MAX_FILE_SIZE = 500000;

    // build :: {string, string?} -> string
    public function build($path, $model = [ ]) {
        ob_start();
        include CURR_VIEW_PATH . 'header.php';
        include $path;
        include CURR_VIEW_PATH . 'footer.php';
        return ob_get_clean();
    }

    // indexAction :: string? -> void
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

    // uploadAction :: void -> string
    public function uploadAction() {
        // Set session info
        $_SESSION['editMode'] = false;
        $_SESSION['tab'] = $_POST['tab'];
        $_SESSION['page'] = $_POST['page'];

        // Check file size/type/etc
        $errors = $this->uploadCheck();

        if (empty($errors)) {
            $fileType = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));


            $_SESSION['icons'][] = serialize(
                new IconModel(
                    $_REQUEST['label'],
                    $_REQUEST['bundleId'],
                    $_FILES['icon']['tmp_name'],
                    $fileType
                )
            );
        } else {
            $_SESSION['errors'] = $errors;
        }

        return $this->indexAction();
    }

    public function batchUploadAction() {
        // Set session info
        $_SESSION['editMode'] = false;
        $_SESSION['tab'] = $_POST['tab'];
        $_SESSION['page'] = $_POST['page'];

        // Check file sizes/types/etc
        $errors = $this->uploadCheck();

        // Check filename format
        foreach ($_FILES['icon']['name'] as $name) {
            if (!preg_match('/.* - .*/', $name)) {
                $errors[] = "'{$name}' does not fit the naming convention.";
            }
        }

        if (empty($errors)) {
            $icons = [ ];

            $systemApps = json_decode(file_get_contents(CONFIG_PATH . 'default-apps.json'), true);
            foreach ($_FILES['icon']['name'] as $i => $id) {
                $parts = explode(' - ', $id);
                $bundleId = $parts[0];
                $label = pathinfo(implode(' - ', array_slice($parts, 1)), PATHINFO_FILENAME);
                $fileType = strtolower(pathinfo($id, PATHINFO_EXTENSION));

                $_SESSION['icons'][] = serialize(
                    new IconModel(
                        $label,
                        $bundleId,
                        $_FILES['icon']['tmp_name'][$i],
                        $fileType
                    )
                );
            }
        } else {
            $_SESSION['errors'] = $errors;
        }

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
            $parts = explode(' - ', pathinfo($icon)['filename']);
            $label = implode(' - ', array_slice($parts, 1));
            $bundleId = $parts[0];

            $fileType = strtolower(pathinfo($icon, PATHINFO_EXTENSION));

            $icons[] = serialize(
                new IconModel(
                    $label,
                    $bundleId,
                    $icon,
                    'png'
                )
            );
        }

        // Clean up files
        exec("rm {$zipFile}");
        exec("rm {$destPath}*");
        exec("rmdir {$destPath}");

        // $_SESSION['messages'][] = 'Icon pack successfully loaded from ' . $_SERVER["HTTP_REFERER"];
        $_SESSION['icons'] = $icons;

        // return $this->indexAction();
        return $this->downloadAction();
    }

    // uploadCheck :: void -> [string?]
    public function uploadCheck() {
        $errors = [ ];
        if (array_key_exists('submit', $_POST)) {
            if (is_array($_FILES['icon']['name'])) {
                foreach ($_FILES['icon']['size'] as $index => $size) {
                    $name = $_FILES['icon']['name'][$index];
                    $fileType = strtolower(pathinfo($_FILES['icon']['name'][$index], PATHINFO_EXTENSION));
                    $errors = array_merge($errors, self::fileCheck($name, $size, $fileType));
                }
            } else {
                $name = $_FILES['icon']['name'];
                $size = $_FILES['icon']['size'];
                $fileType = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
                $errors = self::fileCheck($name, $size, $fileType);
            }
        } else {
            $errors[] = "There was an error uploading this file.";
        }
        return $errors;
    }

    // fileCheck :: (string, string, string) -> [string?]
    public function fileCheck($name, $size, $fileType) {
        $errors = [ ];

        if (!$size || $size > self::MAX_FILE_SIZE) {
            $errors[] = "'$name' too large. Must be under " . self::MAX_FILE_SIZE / 1000 . "KB.";
        } else if (!in_array(
            strtolower($fileType),
            ['jpg', 'jpeg', 'gif', 'png'])
        ) {
            $errors[] = "'{$name}' not allowed. Only JPG, GIF, or PNG files are allowed.";
        }

        return $errors;
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
        // $result = \SSL::sign(TEMP_PATH . $hash . '/unsigned.mobileconfig', TEMP_PATH . $hash . '/signed.mobileconfig');
        echo file_get_contents(TEMP_PATH . $hash . '/signed.mobileconfig');
    }

    public function renameIconAction() {
        $_SESSION['page'] = 'installer';

        $index = $_GET['index'];
        $name = $_GET['name'];

        $icon = unserialize($_SESSION['icons'][$index]);
        $icon->rename($name);
        $_SESSION['icons'][$index] = serialize($icon);

        return $this->indexAction();
    }

    public function deleteAction() {
        $_SESSION['editMode'] = false;
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

    public function clearAllLabelsAction() {
        $_SESSIOn['editMode'] = false;
        $_SESSION['page'] = 'installer';
        for ($i = 0; $i < sizeof($_SESSION['icons']); $i++) {
            $icon = unserialize($_SESSION['icons'][$i]);
            $icon->rename(' ');
            $_SESSION['icons'][$i] = serialize($icon);
        }

        return $this->indexAction();
    }

    // Dangerous function. Use with caution.
    // public function saveIconsAction() {
    //     file_put_contents(UPLOAD_PATH . 'example.icons', serialize($_SESSION['icons']));
    // }

    public function loadIconsAction() {
        $_SESSION['icons'] = [ ];

        $path = ICON_PACK_PATH . $_GET['pack'] . DS;

        $icons = [ ];

        exec("ls {$path}*.png", $list);
        if (empty($list)) {
            exec("ls {$path}*.PNG", $list);
        }

        $systemApps = json_decode(file_get_contents(CONFIG_PATH . 'default-apps.json'), true);

        foreach ($list as $icon) {
            $parts = explode(' - ', pathinfo($icon)['filename']);
            $label = implode(' - ', array_slice($parts, 1));
            $bundleId = $parts[0];

            $fileType = strtolower(pathinfo($icon, PATHINFO_EXTENSION));

            $_SESSION['icons'][] = serialize(
                new IconModel(
                    $label,
                    $bundleId,
                    $icon,
                    'png'
                )
            );
        }

        return array_key_exists('customize', $_GET) ? $this->indexAction() : $this->downloadAction();
    }

    // getIconPackInfoAction :: void -> void
    public function getIconPackInfoAction() {
        header('Content-Type: application/json');
        echo json_encode((new PackModel('packs'))->rows());
    }


    // This endpoint accepts JSON POST requests of the form:
    // {
    //     "0": {
    //         "label":"<Icon Label>",
    //         "bundleId":"<Bundle ID>",
    //         "base64":"<Base64 encoded jpg icon"
    //         },
    //        ...
    // }


    // buildFileAction :: void -> void
    public function buildFileAction() {
        $request = json_decode(file_get_contents('php://input'), true);

        // Initialize the session variable key `icons`
        $_SESSION['icons'] = [ ];
        foreach ($request as $index => $_icon) {       
            $_SESSION['icons'][] = serialize(
                new IconModel(
                    $_icon['label'],
                    $_icon['bundleId'],
                    null,
                    null,
                    $_icon['base64'],
                    $index + 1
                )
            );
        }

        $name = md5(date('mdyhmsu')) . '.mobileconfig';
        file_put_contents(UPLOAD_PATH . $name, \XML::createConfig($_SESSION['icons']));
        echo '/uploads/' . $name;
    }

    // getIconPacksAction :: void -> [string -> string]
    public function getIconPacksAction() {
        echo file_get_contents("https://flurly.com/api/store_details/22over7");
    }
}
 