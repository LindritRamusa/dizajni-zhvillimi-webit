<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\AuthController;

session_start();

$controller = new AuthController();
$controller->register();
