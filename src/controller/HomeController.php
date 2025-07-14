<?php
namespace Maxitsa\Controller;

use Maxitsa\Core\App;
require_once dirname(__DIR__,2) . '/app/config/helpers.php';

use Maxitsa\Abstract\AbstractController;

class HomeController extends AbstractController {
    
    public function toutHistorique()
    {
        session_start();
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            header('Location: /login');
            exit;
        }
        $transactions = [];
        if (isset($_SESSION['compte']['id'])) {
            $db = App::getDependency('core', 'Database')->getConnection();
            $stmt = $db->prepare("SELECT * FROM transaction WHERE compte_id = :compte_id ORDER BY date DESC");
            $stmt->execute(['compte_id' => $_SESSION['compte']['id']]);
            $transactions = $stmt->fetchAll();
        }
        ob_start();
        extract(['transactions' => $transactions]);
        require __DIR__ . "/../../templates/layout/tout.historique.web.php";
        $content = ob_get_clean();
        $title = 'Tout l\'historique';
        require __DIR__ . "/../../templates/layout/layout.php";
    }
    public function index()
    {
        session_start();
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            redirect('login');
        }
       
        $compte_courant = $_SESSION['compte'] ?? null;
        $comptes = $this->getComptesByPersonneId($user['id']);
        $message = null;
        if ($compte_courant) {
            $user_telephone = $compte_courant['telephone'];
            $user_solde = $compte_courant['solde'];
        } elseif ($comptes && count($comptes) > 0) {
            $user_telephone = $comptes[0]['telephone'];
            $user_solde = $comptes[0]['solde'];
            $_SESSION['compte'] = $comptes[0]; 
        } else {
            $user_telephone = $user['telephone'] ?? '';
            $user_solde = null;
            $message = "Aucun compte trouvé pour cet utilisateur.";
        }
       
        $transactions = [];
        if (isset($_SESSION['compte']['id'])) {
            $db = App::getDependency('core', 'Database')->getConnection();
            $stmt = $db->prepare("SELECT * FROM transaction WHERE compte_id = :compte_id");
            $stmt->execute(['compte_id' => $_SESSION['compte']['id']]);
            $transactions = $stmt->fetchAll();
        }
        ob_start();
        extract([
            'user_telephone' => $user_telephone,
            'user_solde' => $user_solde,
            'message' => $message,
            'user_comptes' => $comptes,
            'transactions' => $transactions
        ]);
        require __DIR__ . "/../../templates/layout/accueil.html.php";
        $content = ob_get_clean();
        $title = 'Accueil';
        require __DIR__ . "/../../templates/layout/layout.php";
    }

    private function getComptesByPersonneId($personne_id) {
        $db = App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare("SELECT * FROM compte WHERE personne_id = :personne_id");
        $stmt->execute(['personne_id' => $personne_id]);
        return $stmt->fetchAll();
    }

    public function create(){}

    public function transactions()
    {
        session_start();
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            header('Location: /login');
            exit;
        }
        $transactions = [];
        if (isset($_SESSION['compte']['id'])) {
            $db = App::getDependency('core', 'Database')->getConnection();
            $stmt = $db->prepare("SELECT * FROM transaction WHERE compte_id = :compte_id");
            $stmt->execute(['compte_id' => $_SESSION['compte']['id']]);
            $transactions = $stmt->fetchAll();
        }
        ob_start();
        extract(['transactions' => $transactions]);
        require __DIR__ . "/../../templates/layout/transction.web.php";
        $content = ob_get_clean();
        $title = 'Transactions';
        require __DIR__ . "/../../templates/layout/layout.php";
    }

    public function changerCompte()
    {
        session_start();
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            redirect('login');
        }
        $compte_id = $_POST['compte_id'] ?? null;
        if ($compte_id) {
            $db = App::getDependency('core', 'Database')->getConnection();
            $stmt = $db->prepare("SELECT * FROM compte WHERE id = :id AND personne_id = :personne_id");
            $stmt->execute(['id' => $compte_id, 'personne_id' => $user['id']]);
            $compte = $stmt->fetch();
            if ($compte) {
              
                $_SESSION['compte'] = $compte;
               
                $_SESSION['user_solde'] = $compte['solde'];
                redirect('accueil');
                exit;
            }
        }
       
        redirect('accueil');
        exit;
    }
}
