<?php
namespace Maxitsa\Controller;
use Maxitsa\Core\App;
use Maxitsa\Abstract\AbstractController;
use Maxitsa\Core\Session;
use Maxitsa\Service\CompteService;
use Maxitsa\Service\PersonneService;

require_once dirname(__DIR__,2) . '/app/core/App.php';
require_once dirname(__DIR__,2) . '/app/config/helpers.php';

class UserController extends AbstractController
{
    public function login()
    {
        $errors = [];
        $old = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $telephone = $_POST['telephone'] ?? '';
            $password = $_POST['password'] ?? '';
            $old = ['telephone' => $telephone];
            \Maxitsa\Core\Validator::reset();
            $fields = [
                'telephone' => $telephone,
                'password' => $password
            ];
            foreach ($fields as $key => $value) {
                if (\Maxitsa\Core\Validator::isEmpty($value)) {
                    \Maxitsa\Core\Validator::addError($key, \Maxitsa\Core\Session::getErrorMessage($key));
                }
            }
            $errors = \Maxitsa\Core\Validator::getErrors();
            if (empty($errors)) {
                $personneService = PersonneService::getInstance();
                $ok = $personneService->connecter($telephone, $password);
                if ($ok) {
                    redirect('accueil');
                    exit;
                } else {
                    \Maxitsa\Core\Validator::addError('global', 'Identifiants invalides.');
                    $errors = \Maxitsa\Core\Validator::getErrors();
                }
            }
            Session::getInstance()->set('errors', $errors);
            Session::getInstance()->set('old', $old);
            redirect('login');
            exit;
        }
        require __DIR__ . "/../../templates/user/login.html.php";
    }
    public function signup()
    {
        $errors = [];
        $old = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $photoRectoPath = '';
            $photoVersoPath = '';
            try {
                if (isset($_FILES['photo_recto']) && $_FILES['photo_recto']['error'] === UPLOAD_ERR_OK) {
                    $photoRectoPath = \Maxitsa\Core\FileUploade::upload($_FILES['photo_recto'], __DIR__ . '/../../../public/images/uploads/');
                }
                if (isset($_FILES['photo_verso']) && $_FILES['photo_verso']['error'] === UPLOAD_ERR_OK) {
                    $photoVersoPath = \Maxitsa\Core\FileUploade::upload($_FILES['photo_verso'], __DIR__ . '/../../../public/images/uploads/');
                }
            } catch (\Exception $e) {
                \Maxitsa\Core\Validator::addError('global', 'Erreur lors de l\'upload des fichiers : ' . $e->getMessage());
            }
            $data = [
                'id' => uniqid(),
                'telephone' => $_POST['telephone'] ?? '',
                'password' => $_POST['password'] ?? '',
                'password_confirm' => $_POST['password_confirm'] ?? '',
                'num_identite' => $_POST['num_identite'] ?? '',
                'photo_recto' => $photoRectoPath,
                'photo_verso' => $photoVersoPath,
                'prenom' => $_POST['prenom'] ?? '',
                'nom' => $_POST['nom'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
                'type_personne' => 'client'
            ];
            $old = $data;
            \Maxitsa\Core\Validator::reset();
            $fields = [
                'prenom' => $data['prenom'],
                'nom' => $data['nom'],
                'telephone' => $data['telephone'],
                'adresse' => $data['adresse'],
                'num_identite' => $data['num_identite'],
                'password' => $data['password']
            ];
            foreach ($fields as $key => $value) {
                if (\Maxitsa\Core\Validator::isEmpty($value)) {
                    \Maxitsa\Core\Validator::addError($key, \Maxitsa\Core\Session::getErrorMessage($key));
                }
            }
            if ($data['password'] !== $data['password_confirm']) {
                \Maxitsa\Core\Validator::addError('password_confirm', \Maxitsa\Core\Session::getErrorMessage('password_confirm'));
            }
          
            \Maxitsa\Core\Validator::validatePersonneData($data['telephone'], $data['num_identite']);
            $errors = \Maxitsa\Core\Validator::getErrors();
            if (empty($errors)) {
                $personneService = \Maxitsa\Service\PersonneService::getInstance();
                $ok = $personneService->inscrire($data);
                if ($ok) {
                    redirect('login?signup');
                    exit;
                } else {
                    \Maxitsa\Core\Validator::addError('global', 'Erreur lors de l\'inscription.');
                    $errors = \Maxitsa\Core\Validator::getErrors();
                }
            }
            \Maxitsa\Core\Session::getInstance()->set('errors', $errors);
            \Maxitsa\Core\Session::getInstance()->set('old', $old);
            redirect('signup');
            exit;
        }
        require __DIR__ . "/../../templates/user/signup.html.php";
    }

    public function signin()
    {
        $errors = [];
        $old = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $telephone = $_POST['telephone'] ?? '';
            $password = $_POST['password'] ?? '';
            $old = ['telephone' => $telephone];
            \Maxitsa\Core\Validator::reset();
            $fields = [
                'telephone' => $telephone,
                'password' => $password
            ];
            foreach ($fields as $key => $value) {
                if (\Maxitsa\Core\Validator::isEmpty($value)) {
                    \Maxitsa\Core\Validator::addError($key, \Maxitsa\Core\Session::getErrorMessage($key));
                }
            }
            $errors = \Maxitsa\Core\Validator::getErrors();
            if (empty($errors)) {
                $personneService = PersonneService::getInstance();
                $ok = $personneService->connecter($telephone, $password);
                if ($ok) {
                    redirect('accueil');
                    exit;
                } else {
                    \Maxitsa\Core\Validator::addError('global', 'Identifiants invalides.');
                    $errors = \Maxitsa\Core\Validator::getErrors();
                }
            }
            \Maxitsa\Core\Session::getInstance()->set('errors', $errors);
            \Maxitsa\Core\Session::getInstance()->set('old', $old);
            redirect('login');
            exit;
        }
        require __DIR__ . "/../../templates/user/login.html.php";
    }




    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'telephone' => $_POST['telephone'],
                'solde' => $_POST['solde'],
                'personne' => $_POST['personne_id'],
                'type_compte' => $_POST['type_compte']
            ];
            $compteService = CompteService::getInstance();
            $compteCree = $compteService->creerCompte($data);
            if ($compteCree) {
                redirect('comptes?success=1');
                exit;
            } else {
                echo 'Erreur lors de la création du compte.';
            }
        }
        require __DIR__ . '/../../templates/compte/create.html.php';
    }
}
