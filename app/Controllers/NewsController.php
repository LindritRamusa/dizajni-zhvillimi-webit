<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $newsModel = new News();
        $news = $newsModel->findAll();

        $this->render('news', [
            'pageTitle' => 'Lajmet - Klinika Medina',
            'pageDescription' => 'Lajmet dhe artikujt e Klinikës Medina',
            'currentPage' => 'news',
            'additionalScripts' => [],
            'news' => $news,
        ]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: news.php');
            exit;
        }

        $newsModel = new News();
        $news = $newsModel->findById($id);

        if (!$news) {
            header('Location: news.php');
            exit;
        }

        $this->render('news-details', [
            'pageTitle' => $news['title'] . ' - Klinika Medina',
            'pageDescription' => mb_substr(strip_tags($news['content']), 0, 160),
            'currentPage' => 'news',
            'additionalScripts' => [],
            'news' => $news,
        ]);
    }
}
