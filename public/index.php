<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\HomeController;

session_start();

$controller = new HomeController();
$controller->index();
