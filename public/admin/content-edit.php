<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\Admin\ContentController;

session_start();

$controller = new ContentController();
$controller->edit();
