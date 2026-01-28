<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\Admin\UserController;

session_start();

$controller = new UserController();
$controller->index();
