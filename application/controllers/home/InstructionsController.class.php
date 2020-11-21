<?php
// application/controllers/admin/InstructionsController.class.php

class InstructionsController extends Controller {

    // build :: void -> void
    public function build($path) {
        ob_start();
        include CURR_VIEW_PATH . 'header.php';
        include $path;
        include CURR_VIEW_PATH . 'footer.php';
        return ob_get_clean();
    }

    public function indexAction() {
        echo $this->build(CURR_VIEW_PATH . 'instructions.php');
    }
}