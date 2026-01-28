<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Message;

class ContactController extends Controller
{
    public function index()
    {
        $messageModel = new Message();

        $error = '';
        $success = '';
        $errors = [];
        $name = '';
        $email = '';
        $phone = '';
        $subject = '';
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            $valid = true;

            if ($name === '') {
                $errors['name'] = 'Emri është i detyrueshëm';
                $valid = false;
            } elseif (mb_strlen($name) < 2 || !preg_match('/^[\p{L}\s]+$/u', $name)) {
                $errors['name'] = 'Emri duhet të ketë të paktën 2 karaktere dhe vetëm shkronja';
                $valid = false;
            }

            if ($email === '') {
                $errors['email'] = 'Email është i detyrueshëm';
                $valid = false;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email nuk është i vlefshëm';
                $valid = false;
            }

            if ($phone !== '' && !preg_match('/^(\+383|0)[4-9]\d{7,8}$/', preg_replace('/\s/', '', $phone))) {
                $errors['phone'] = 'Numri i telefonit nuk është i vlefshëm';
                $valid = false;
            }

            if ($message === '') {
                $errors['message'] = 'Mesazhi është i detyrueshëm';
                $valid = false;
            } elseif (mb_strlen($message) < 10) {
                $errors['message'] = 'Mesazhi duhet të ketë të paktën 10 karaktere';
                $valid = false;
            }

            if ($valid) {
                $messageModel->create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone ?: null,
                    'subject' => $subject ?: null,
                    'message' => $message,
                ]);
                $success = 'Mesazhi juaj u dërgua me sukses. Do të ju kontaktojmë së shpejti.';
                $name = $email = $phone = $subject = $message = '';
                $errors = [];
            } else {
                $error = implode(' ', $errors);
            }
        }

        $this->render('contact', [
            'pageTitle' => 'Kontakti - Klinika Medina',
            'pageDescription' => 'Na kontaktoni për informacione dhe termine',
            'currentPage' => 'contact',
            'additionalScripts' => ['/js/validation.js'],
            'error' => $error,
            'success' => $success,
            'errors' => $errors ?? [],
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
        ]);
    }
}
