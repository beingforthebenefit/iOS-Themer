<?php

session_start();
if (array_key_exists('page', $_GET)) {
    $_SESSION['page'] = $_GET['page'];
} else {
    $_SESSION['page'] = 'home';
}

require __DIR__ . '/../framework/core/Framework.class.php';

\Framework::run();