<?php
// application/controllers/admin/IndexController.class.php

include UTIL_PATH . 'XML.class.php';

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
    public function indexAction() {
        $_SESSION['icons'] = [ ];

        echo $this->build(CURR_VIEW_PATH . 'main.php', $_SESSION['icons']);
    }

    public function uploadAction() {
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

        echo $this->build(CURR_VIEW_PATH . 'main.php', $_SESSION['icons']);
    }

    public function batchUploadAction() {
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

        echo $this->build(CURR_VIEW_PATH . 'main.php', $_SESSION['icons']);
    }

    public function downloadAction() {
        header('Content-Type: application/xml;');
        header('Content-Disposition: attachment; filename=MyTheme.mobileconfig');
        echo XML::createConfig($_SESSION['icons']);
    }

    public function clearAction() {

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