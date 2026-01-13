<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Core\Auth;

session_start();

$auth = new Auth();
$auth->logout();

header('Location: /index.php');
exit;
