<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\PageController;

session_start();

$controller = new PageController();
$controller->about();
