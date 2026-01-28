<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\Auth;
use App\Models\News;

class NewsController extends Controller
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
        $newsModel = new News();

        $news = $newsModel->findAll();

        $this->render('news', [
            'pageTitle' => 'Lajmet',
            'pageDescription' => 'Menaxho lajmet dhe artikujt',
            'currentPage' => 'news',
            'user' => $user,
            'news' => $news,
        ], 'admin');
    }

    public function add()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $newsModel = new News();

        $error = '';
        $uploadDir = $this->uploadDir();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $imagePath = null;
            $pdfPath = null;

            if (empty($title)) {
                $error = 'Titulli është i detyrueshëm';
            } elseif (empty($content)) {
                $error = 'Përmbajtja është e detyrueshme';
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $fileName = uniqid('news_img_') . '.' . $ext;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                            $imagePath = $fileName;
                        } else {
                            $error = 'Gabim gjatë ngarkimit të imazhit';
                        }
                    } else {
                        $error = 'Formati i imazhit nuk është i lejuar (JPG, PNG, GIF, WEBP)';
                    }
                }
                if (empty($error) && isset($_FILES['pdf_document']) && $_FILES['pdf_document']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['pdf_document']['name'], PATHINFO_EXTENSION));
                    if ($ext === 'pdf') {
                        $fileName = uniqid('news_pdf_') . '.pdf';
                        if (move_uploaded_file($_FILES['pdf_document']['tmp_name'], $uploadDir . $fileName)) {
                            $pdfPath = $fileName;
                        } else {
                            $error = 'Gabim gjatë ngarkimit të dokumentit PDF';
                        }
                    } else {
                        $error = 'Vetëm format PDF është i lejuar për dokumentin';
                    }
                }
                if (empty($error)) {
                    $newsModel->create([
                        'title' => $title,
                        'content' => $content,
                        'image' => $imagePath,
                        'pdf_document' => $pdfPath,
                        'created_by' => $user['id'],
                    ]);
                    header('Location: news.php');
                    exit;
                }
            }
        }

        $this->render('news-add', [
            'pageTitle' => 'Shto Lajm',
            'pageDescription' => 'Shto lajm të ri',
            'currentPage' => 'news',
            'user' => $user,
            'error' => $error,
        ], 'admin');
    }

    public function edit()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $newsModel = new News();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: news.php');
            exit;
        }
        $newsItem = $newsModel->findById($id);
        if (!$newsItem) {
            header('Location: news.php');
            exit;
        }

        $error = '';
        $uploadDir = $this->uploadDir();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $imagePath = $newsItem['image'];
            $pdfPath = $newsItem['pdf_document'];

            if (empty($title)) {
                $error = 'Titulli është i detyrueshëm';
            } elseif (empty($content)) {
                $error = 'Përmbajtja është e detyrueshme';
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $fileName = uniqid('news_img_') . '.' . $ext;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                            if ($imagePath && file_exists($uploadDir . $imagePath)) {
                                unlink($uploadDir . $imagePath);
                            }
                            $imagePath = $fileName;
                        } else {
                            $error = 'Gabim gjatë ngarkimit të imazhit';
                        }
                    } else {
                        $error = 'Formati i imazhit nuk është i lejuar (JPG, PNG, GIF, WEBP)';
                    }
                }
                if (empty($error) && isset($_FILES['pdf_document']) && $_FILES['pdf_document']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['pdf_document']['name'], PATHINFO_EXTENSION));
                    if ($ext === 'pdf') {
                        $fileName = uniqid('news_pdf_') . '.pdf';
                        if (move_uploaded_file($_FILES['pdf_document']['tmp_name'], $uploadDir . $fileName)) {
                            if ($pdfPath && file_exists($uploadDir . $pdfPath)) {
                                unlink($uploadDir . $pdfPath);
                            }
                            $pdfPath = $fileName;
                        } else {
                            $error = 'Gabim gjatë ngarkimit të dokumentit PDF';
                        }
                    } else {
                        $error = 'Vetëm format PDF është i lejuar për dokumentin';
                    }
                }
                if (empty($error)) {
                    $newsModel->update($id, [
                        'title' => $title,
                        'content' => $content,
                        'image' => $imagePath,
                        'pdf_document' => $pdfPath,
                        'created_by' => $user['id'],
                    ]);
                    header('Location: news.php');
                    exit;
                }
            }
            $newsItem = $newsModel->findById($id);
        }

        $this->render('news-edit', [
            'pageTitle' => 'Ndrysho Lajm',
            'pageDescription' => 'Ndrysho lajmin',
            'currentPage' => 'news',
            'user' => $user,
            'error' => $error,
            'newsItem' => $newsItem,
        ], 'admin');
    }

    public function delete()
    {
        Middleware::requireAdmin();
        $newsModel = new News();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: news.php');
            exit;
        }
        $news = $newsModel->findById($id);
        if ($news) {
            $uploadDir = $this->uploadDir();
            if (!empty($news['image']) && file_exists($uploadDir . $news['image'])) {
                unlink($uploadDir . $news['image']);
            }
            if (!empty($news['pdf_document']) && file_exists($uploadDir . $news['pdf_document'])) {
                unlink($uploadDir . $news['pdf_document']);
            }
            $newsModel->delete($id);
        }
        header('Location: news.php');
        exit;
    }
}
