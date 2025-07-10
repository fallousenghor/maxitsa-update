<?php
namespace Maxitsa\Controller;

use Maxitsa\Abstract\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        ob_start();
        require __DIR__ . "/../../templates/layout/accueil.html.php";
        $content = ob_get_clean();
        $title = 'Accueil';
        require __DIR__ . "/../../templates/layout/layout.php";
    }

    public function create(){}
}
