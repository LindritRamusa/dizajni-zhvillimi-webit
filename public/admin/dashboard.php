<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\Admin\DashboardController;

session_start();

$controller = new DashboardController();
$controller->index();
