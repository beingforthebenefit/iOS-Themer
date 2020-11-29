<?php
// application/controllers/admin/IndexController.class.php

class IndexController extends Controller {

    // build :: void -> void
    public function build($path, $model = [ ]) {
        ob_start();
        include $path;
        return ob_get_clean();
    }

    // authenticate :: void -> void
    public function authenticate($admin) {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'This is not the page you are looking for...';
            exit;
        }

        
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        return $admin->validate($username, $password);
    }

    // indexAction :: void -> void
    public function indexAction() {
        $admin = new AdminModel('admins');
        if ($this->authenticate($admin)) {
            $admin->login($admin);
            echo $this->build(CURR_VIEW_PATH . 'main.php');
        } else {
            echo "This is not the page you are looking for...";
        }
    }
}