<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\Admin\ServiceController;

session_start();

$controller = new ServiceController();
$controller->add();
