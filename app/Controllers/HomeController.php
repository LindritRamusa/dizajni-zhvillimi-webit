<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\PageContent;

class HomeController extends Controller
{
    public function index()
    {
        $serviceModel = new Product();
        $contentModel = new PageContent();

        $services = $serviceModel->findAll();
        $servicesPreview = array_slice($services, 0, 3);

        $homeContent = $contentModel->findBySection('home');
        $slides = array_filter($homeContent, function ($r) {
            return (int)$r['display_order'] <= 2;
        });
        usort($slides, function ($a, $b) {
            return (int)$a['display_order'] <=> (int)$b['display_order'];
        });
        $slides = array_slice($slides, 0, 3);
        $featuresTitleRow = null;
        $featureCards = [];
        foreach ($homeContent as $r) {
            $ord = (int)$r['display_order'];
            if ($ord === 10) {
                $featuresTitleRow = $r;
            } elseif ($ord >= 11 && $ord <= 14) {
                $featureCards[] = $r;
            }
        }
        usort($featureCards, function ($a, $b) {
            return (int)$a['display_order'] <=> (int)$b['display_order'];
        });
        $featureCards = array_slice($featureCards, 0, 4);

        $slideLinks = ['services.php', 'about.php', 'contact.php'];
        $slideLinkLabels = ['Shiko Shërbimet', 'Më Shumë', 'Kontaktoni'];

        $this->render('home', [
            'pageTitle' => 'Klinika Medina - Faqja Kryesore',
            'pageDescription' => 'Klinika Medina - Kujdesi mjekësor profesional dhe i sigurt',
            'currentPage' => 'home',
            'additionalScripts' => ['/js/slider.js'],
            'slides' => $slides,
            'featuresTitleRow' => $featuresTitleRow,
            'featureCards' => $featureCards,
            'slideLinks' => $slideLinks,
            'slideLinkLabels' => $slideLinkLabels,
            'servicesPreview' => $servicesPreview,
        ]);
    }
}
