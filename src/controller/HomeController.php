<?php
namespace Maxitsa\Controller;

use Maxitsa\Core\App;
require_once dirname(__DIR__,2) . '/app/config/helpers.php';

use Maxitsa\Abstract\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        session_start();
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            redirect('login');
        }
        $telephone = $user['telephone'] ?? '';
        $solde = null;
        $message = null;
        $comptes = $this->getComptesByPersonneId($user['id']);
        if ($comptes && isset($comptes[0]['solde'])) {
            $solde = $comptes[0]['solde'];
        } else {
            $message = "Aucun compte trouvé pour cet utilisateur.";
        }
        ob_start();
        extract([
            'user_telephone' => $telephone,
            'user_solde' => $solde,
            'message' => $message
        ]);
        require __DIR__ . "/../../templates/layout/accueil.html.php";
        $content = ob_get_clean();
        $title = 'Accueil';
        require __DIR__ . "/../../templates/layout/layout.php";
    }

    private function getComptesByPersonneId($personne_id) {
        $db = App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare("SELECT * FROM compte WHERE personne_id = :personne_id LIMIT 1");
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
        $db =App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare("SELECT * FROM transaction WHERE compte_id IN (SELECT id FROM compte WHERE personne_id = :personne_id)");
        $stmt->execute(['personne_id' => $user['id']]);
        $transactions = $stmt->fetchAll();
        ob_start();
        extract(['transactions' => $transactions]);
        require __DIR__ . "/../../templates/layout/transction.web.php";
        $content = ob_get_clean();
        $title = 'Transactions';
        require __DIR__ . "/../../templates/layout/layout.php";
    }
}
