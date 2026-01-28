<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\Admin\NewsController;

session_start();

$controller = new NewsController();
$controller->edit();
