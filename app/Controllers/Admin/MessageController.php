<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $messageModel = new Message();

        $messages = $messageModel->findAll();

        $this->render('messages', [
            'pageTitle' => 'Mesazhet',
            'pageDescription' => 'Shiko mesazhet e kontaktit',
            'currentPage' => 'messages',
            'user' => $user,
            'messages' => $messages,
        ], 'admin');
    }

    public function show()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $messageModel = new Message();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: messages.php');
            exit;
        }

        $msg = $messageModel->findById($id);
        if (!$msg) {
            header('Location: messages.php');
            exit;
        }

        $messageModel->markAsRead($id);
        $msg = $messageModel->findById($id);

        $this->render('message-detail', [
            'pageTitle' => 'Mesazhi - ' . htmlspecialchars($msg['name']),
            'pageDescription' => 'Shiko mesazhin e kontaktit',
            'currentPage' => 'messages',
            'user' => $user,
            'msg' => $msg,
        ], 'admin');
    }
}
