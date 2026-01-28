<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\Auth;
use App\Models\PageContent;

class ContentController extends Controller
{
    public function index()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $contentModel = new PageContent();

        $section = $_GET['section'] ?? 'home';
        if (!in_array($section, ['home', 'about'], true)) {
            $section = 'home';
        }

        $blocks = $contentModel->findBySection($section);

        $this->render('content', [
            'pageTitle' => 'Përmbajtja – ' . ($section === 'home' ? 'Faqja Kryesore' : 'Rreth Nesh'),
            'pageDescription' => 'Menaxho përmbajtjen e faqave',
            'currentPage' => 'content',
            'user' => $user,
            'section' => $section,
            'blocks' => $blocks,
        ], 'admin');
    }

    public function add()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $contentModel = new PageContent();

        $section = $_GET['section'] ?? 'home';
        if (!in_array($section, ['home', 'about'], true)) {
            $section = 'home';
        }

        $error = '';
        $title = '';
        $content = '';
        $image = '';
        $display_order = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $image = trim($_POST['image'] ?? '');
            $display_order = (int)($_POST['display_order'] ?? 0);
            $section = $_POST['section'] ?? $section;
            if (!in_array($section, ['home', 'about'], true)) {
                $section = 'home';
            }

            $contentModel->create([
                'section' => $section,
                'title' => $title ?: null,
                'content' => $content ?: null,
                'image' => $image ?: null,
                'display_order' => $display_order,
                'created_by' => $user['id'],
            ]);

            header('Location: content.php?section=' . urlencode($section));
            exit;
        }

        $this->render('content-add', [
            'pageTitle' => 'Shto bllok – ' . ($section === 'home' ? 'Faqja Kryesore' : 'Rreth Nesh'),
            'pageDescription' => 'Shto bllok përmbajtjeje',
            'currentPage' => 'content',
            'user' => $user,
            'section' => $section,
            'error' => $error,
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'display_order' => $display_order,
        ], 'admin');
    }

    public function edit()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $contentModel = new PageContent();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: content.php?section=home');
            exit;
        }

        $block = $contentModel->findById($id);
        if (!$block) {
            header('Location: content.php?section=home');
            exit;
        }

        $section = $block['section'];
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $image = trim($_POST['image'] ?? '');
            $display_order = (int)($_POST['display_order'] ?? 0);
            $section = $_POST['section'] ?? $section;
            if (!in_array($section, ['home', 'about'], true)) {
                $section = 'home';
            }

            $contentModel->update($id, [
                'section' => $section,
                'title' => $title ?: null,
                'content' => $content ?: null,
                'image' => $image ?: null,
                'display_order' => $display_order,
                'created_by' => $user['id'],
            ]);

            header('Location: content.php?section=' . urlencode($section));
            exit;
        }

        $this->render('content-edit', [
            'pageTitle' => 'Ndrysho bllok',
            'pageDescription' => 'Ndrysho përmbajtjen',
            'currentPage' => 'content',
            'user' => $user,
            'section' => $section,
            'error' => $error,
            'block' => $block,
        ], 'admin');
    }

    public function delete()
    {
        Middleware::requireAdmin();
        $contentModel = new PageContent();

        $id = $_GET['id'] ?? null;
        $section = $_GET['section'] ?? 'home';

        if (!$id) {
            header('Location: content.php?section=' . urlencode($section));
            exit;
        }

        $block = $contentModel->findById($id);
        if ($block) {
            $contentModel->delete($id);
        }

        header('Location: content.php?section=' . urlencode($section));
        exit;
    }
}
