<?php
// application/controllers/admin/IconPackController.class.php

class IconPackController extends Controller {

    // build :: void -> void
    public function build($path) {
        ob_start();
        include CURR_VIEW_PATH . 'header.php';
        include $path;
        include CURR_VIEW_PATH . 'footer.php';
        return ob_get_clean();
    }

    public function indexAction() {
        echo $this->build(CURR_VIEW_PATH . 'main.php');
    }

    // editAction :: void -> void
    public function editAction() {
        echo $this->build(CURR_VIEW_PATH . 'icon-packs' . DS . 'edit.php');
    }

    // uploadAction :: void -> void
    public function uploadAction() {
        echo $this->build(CURR_VIEW_PATH . 'icon-packs' . DS . 'upload-files.php');
    }

    // createAction :: void -> void
    public function createAction() {
        echo $this->build(CURR_VIEW_PATH . 'icon-packs' . DS . 'new.php');
    }

    // createAction :: void -> void
    public function createPackAction() {
        $pack = (new PackModel('packs'));

        $properties = [ ];
        foreach ([
            'background',
            'paid',
            'title',
            'description',
            'link1Text',
            'link1Url',
            'link2Text',
            'link2Url'
        ] as $property) {
            $properties[$property] = $_POST[$property];
        }

        $pack->insert($properties);
        return $this->indexAction();
    }

    // editIconPackAction :: void -> void
    public function editPackAction() {
        (new PackModel('packs'))->row(['packId' => $_POST['packId']]);

        $updates = [ ];
        foreach ($_POST as $key => $value) {
            $updates[$key] = $value;
        }

        (new PackModel('packs'))->update($updates);
        return $this->indexAction();
    }

    // uploadPack :: void -> void
    public function uploadPackAction() {
        $destination = ICON_PACK_PATH . $_POST['directory'];
        mkdir($destination);

        $icons = [ ];
        foreach ($_FILES['icons'] as $attribute => $array) {
            foreach ($array as $index => $value) {
                $icons[$index][$attribute] = $value;
            }
        }

        $validName = preg_match("/.+ - .*.(png|PNG)", $icon['name']);

        if (!$validName) {
            $_SESSION['errors'][] = "$icon['name'] does not fit the required name format of `bundleId - Icon Label.png.<br />Please rename and try again.";
            header("Location : /?p=admin&c=IconPack&a=upload");
            return;
        }

        foreach ($icons as $icon) {
            move_uploaded_file($icon['tmp_name'], $destination . DS . $icon['name']);

        }

        move_uploaded_file($_FILES['background']['tmp_name'], PUBLIC_PATH . 'images' . DS . 'icon-pack-previews' . DS . $_FILES['background']['name']);

        // TODO make this newAction();
        return $this->createAction();
    }
}