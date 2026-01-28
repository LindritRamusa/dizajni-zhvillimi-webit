<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\Auth;
use App\Models\Product;

class ServiceController extends Controller
{
    private function uploadDir()
    {
        return dirname(__DIR__, 3) . '/public/uploads/';
    }

    public function index()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $serviceModel = new Product();

        $services = $serviceModel->findAll();

        $this->render('services', [
            'pageTitle' => 'Shërbimet',
            'pageDescription' => 'Menaxho shërbimet e klinikës',
            'currentPage' => 'services',
            'user' => $user,
            'services' => $services,
        ], 'admin');
    }

    public function add()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $serviceModel = new Product();

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $subtitle = trim($_POST['subtitle'] ?? '');
            $icon = trim($_POST['icon'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $duration = trim($_POST['duration'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $availability = trim($_POST['availability'] ?? '');

            if (empty($title)) {
                $error = 'Titulli është i detyrueshëm';
            } else {
                $imagePath = null;
                $uploadDir = $this->uploadDir();
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $fileName = uniqid('service_') . '.' . $ext;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                            $imagePath = $fileName;
                        } else {
                            $error = 'Gabim gjatë ngarkimit të imazhit';
                        }
                    } else {
                        $error = 'Formati i imazhit nuk është i lejuar';
                    }
                }
                if (empty($error)) {
                    $serviceModel->create([
                        'title' => $title,
                        'subtitle' => $subtitle ?: null,
                        'icon' => $icon ?: null,
                        'description' => $description ?: null,
                        'duration' => $duration ?: null,
                        'price' => $price ?: null,
                        'availability' => $availability ?: null,
                        'image' => $imagePath,
                        'created_by' => $user['id'],
                    ]);
                    header('Location: services.php');
                    exit;
                }
            }
        }

        $this->render('service-add', [
            'pageTitle' => 'Shto Shërbim',
            'pageDescription' => 'Shto shërbim të ri',
            'currentPage' => 'services',
            'user' => $user,
            'error' => $error,
            'success' => $success,
        ], 'admin');
    }

    public function edit()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $serviceModel = new Product();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: services.php');
            exit;
        }
        $service = $serviceModel->findById($id);
        if (!$service) {
            header('Location: services.php');
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $subtitle = trim($_POST['subtitle'] ?? '');
            $icon = trim($_POST['icon'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $duration = trim($_POST['duration'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $availability = trim($_POST['availability'] ?? '');
            $imagePath = $service['image'];
            $uploadDir = $this->uploadDir();

            if (empty($title)) {
                $error = 'Titulli është i detyrueshëm';
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $fileName = uniqid('service_') . '.' . $ext;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                            if ($imagePath && file_exists($uploadDir . $imagePath)) {
                                unlink($uploadDir . $imagePath);
                            }
                            $imagePath = $fileName;
                        } else {
                            $error = 'Gabim gjatë ngarkimit të imazhit';
                        }
                    } else {
                        $error = 'Formati i imazhit nuk është i lejuar';
                    }
                }
                if (empty($error)) {
                    $serviceModel->update($id, [
                        'title' => $title,
                        'subtitle' => $subtitle ?: null,
                        'icon' => $icon ?: null,
                        'description' => $description ?: null,
                        'duration' => $duration ?: null,
                        'price' => $price ?: null,
                        'availability' => $availability ?: null,
                        'image' => $imagePath,
                        'created_by' => $user['id'],
                    ]);
                    header('Location: services.php');
                    exit;
                }
            }
            $service = $serviceModel->findById($id);
        }

        $this->render('service-edit', [
            'pageTitle' => 'Ndrysho Shërbim',
            'pageDescription' => 'Ndrysho shërbimin',
            'currentPage' => 'services',
            'user' => $user,
            'error' => $error,
            'service' => $service,
        ], 'admin');
    }

    public function delete()
    {
        Middleware::requireAdmin();
        $serviceModel = new Product();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: services.php');
            exit;
        }
        $service = $serviceModel->findById($id);
        if ($service) {
            $uploadDir = $this->uploadDir();
            if (!empty($service['image']) && file_exists($uploadDir . $service['image'])) {
                unlink($uploadDir . $service['image']);
            }
            $serviceModel->delete($id);
        }
        header('Location: services.php');
        exit;
    }
}
