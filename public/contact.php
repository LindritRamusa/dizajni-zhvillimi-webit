<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\ContactController;

session_start();

$controller = new ContactController();
$controller->index();
