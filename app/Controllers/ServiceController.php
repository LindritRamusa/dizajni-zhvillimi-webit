<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceModel = new Product();
        $services = $serviceModel->findAll();

        $this->render('services', [
            'pageTitle' => 'Shërbimet - Klinika Medina',
            'pageDescription' => 'Shërbimet e Klinikës Medina',
            'currentPage' => 'services',
            'additionalScripts' => [],
            'services' => $services,
        ]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: services.php');
            exit;
        }

        $serviceModel = new Product();
        $service = $serviceModel->findById($id);

        if (!$service) {
            header('Location: services.php');
            exit;
        }

        $this->render('service-details', [
            'pageTitle' => $service['title'] . ' - Klinika Medina',
            'pageDescription' => $service['subtitle'] ?? $service['title'],
            'currentPage' => 'services',
            'additionalScripts' => [],
            'service' => $service,
        ]);
    }
}
