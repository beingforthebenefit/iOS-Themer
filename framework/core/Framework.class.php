<?php
// framework/core/Framework.class.php

class Framework {

    // \Framework::run :: void -> void
    public static function run() {
        self::init();

        self::autoload();

        self::dispatch();
    }

    // \Framwork::init :: void -> void
    private static function init() {

        // Define path constants
        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS . '..' . DS);
        define("APP_PATH", ROOT . 'application' . DS);
        define("FRAMEWORK_PATH", ROOT . 'framework' . DS);
        define("PUBLIC_PATH", ROOT . 'public' . DS);
        define("TEMP_PATH", ROOT . 'tmp' . DS);

        define("CONFIG_PATH", APP_PATH . 'config' . DS);
        define("CONTROLLER_PATH", APP_PATH . 'controllers' . DS);
        define("MODEL_PATH", APP_PATH . 'models' . DS);
        define("VIEW_PATH", APP_PATH . 'views' . DS);
        define("UTIL_PATH", APP_PATH . 'utils' . DS);
        define("TEMPLATE_PATH", APP_PATH . 'templates' . DS);

        define("CORE_PATH", FRAMEWORK_PATH . 'core' . DS);
        define("DB_PATH", FRAMEWORK_PATH . 'database'. DS);
        define("LIB_PATH", FRAMEWORK_PATH . 'helpers' . DS);
        define("HELPER_PATH", FRAMEWORK_PATH . 'helpers'. DS);

        define("UPLOAD_PATH", PUBLIC_PATH . 'uploads'. DS);

        // Define platform, controller, and action
        define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');
        define("CONTROLLER" , isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Index');
        define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');

        define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
        define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);
        define("AD_PATH", CURR_VIEW_PATH . 'ads' . DS);

        // Load core classes
        require CORE_PATH . "Controller.class.php";
        require CORE_PATH . "Loader.class.php";
        require DB_PATH . "Mysql.class.php";
        require CORE_PATH . "Model.class.php";

        // Load configuration file
        $GLOBALS['config'] = include CONFIG_PATH . "config.php";

        // Start session if one does not exist
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

    }

    // Framework::autoload :: void -> void
    private static function autoload() {
        spl_autoload_register([__CLASS__, 'load']);
    }

    // Framework::load :: void -> void
    // Custom load method.
    // Enforces naming convention for controllers `xxxController.class.php`
    //   and for models `xxxModel.class.php`
    private static function load($classname) {
        if (substr($classname, -10) == 'Controller') {
            require_once CURR_CONTROLLER_PATH . "{$classname}.class.php";
        } else if (substr($classname, -5) == "Model") {
            require_once MODEL_PATH . "{$classname}.class.php";
        }
    }

    // Framework::dispatch :: void -> void
    private static function dispatch() {
        $controller_name = CONTROLLER . 'Controller';
        $action_name = ACTION . 'Action';
        $controller = new $controller_name;
        $controller->$action_name();
    }
}