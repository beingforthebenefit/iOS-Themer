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

    public static function makeIcon($label, $bundleId, $iconPath, $url = 'No') {
        $hash = md5(date("ymdhsu"));
        $dest = TEMP_PATH . "$hash.jpg";
        shell_exec("convert '$iconPath' '$dest'");
        return [
            'Label' => $label,
            'PayloadDisplayName' => $label,
            'PayloadIdentifier' => 'geralds.icon.themer.' . $hash . "." . (count($_SESSION['icons']) + 1),
            'PayloadUUID' => $hash,
            'TargetApplicationBundleIdentifier' => $bundleId,
            'URL' => $url,
            'Icon' => base64_encode(
                file_get_contents($dest)
            )
        ];
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
        }

        if (!$fail && move_uploaded_file($_FILES['icon']['tmp_name'], TEMP_PATH . $_FILES['icon']['name'])) {
            $_SESSION['icons'][] = self::makeIcon(
                $_REQUEST['label'],
                $_REQUEST['bundleId'],
                TEMP_PATH . $_FILES['icon']['name']
            );
        } else {
            $_SESSION['errors'] = $errors;
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