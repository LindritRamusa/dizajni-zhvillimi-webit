<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\Admin\MessageController;

session_start();

$controller = new MessageController();
$controller->index();
