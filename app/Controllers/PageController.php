<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PageContent;

class PageController extends Controller
{
    public function about()
    {
        $contentModel = new PageContent();
        $aboutContent = $contentModel->findBySection('about');

        $this->render('about', [
            'pageTitle' => 'Rreth Nesh - Klinika Medina',
            'pageDescription' => 'Mëso më shumë rreth Klinikës Medina',
            'currentPage' => 'about',
            'additionalScripts' => [],
            'aboutContent' => $aboutContent,
        ]);
    }
}
