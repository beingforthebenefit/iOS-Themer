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
        echo $this->build(CURR_VIEW_PATH . '/icon-packs/edit.php');
    }

    // createAction :: void -> void
    public function createAction() {
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
        return indexAction();
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
}