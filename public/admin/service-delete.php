<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Core\Middleware;
use App\Core\Auth;
use App\Models\Service;

session_start();

Middleware::requireAdmin();

$auth = new Auth();
$user = $auth->getUser();
$serviceModel = new Service();

$serviceId = $_GET['id'] ?? null;

if (!$serviceId) {
    header('Location: services.php');
    exit;
}

$service = $serviceModel->findById($serviceId);

if ($service) {
    if ($service['image']) {
        $imagePath = __DIR__ . '/../../public/uploads/' . $service['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $serviceModel->delete($serviceId);
}

header('Location: services.php');
exit;
