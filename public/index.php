<?php

session_start();
$_SESSION['page'] = $_GET['page'];

require __DIR__ . '/../framework/core/Framework.class.php';

\Framework::run();