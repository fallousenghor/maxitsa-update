<?php
namespace Maxitsa\Controller;

use Maxitsa\Abstract\AbstractController;
use Maxitsa\Core\FileUploade;
use Maxitsa\Core\Session;
use Maxitsa\Core\Validator;

use Maxitsa\Service\PersonneService;

require_once dirname(__DIR__,2) . '/app/core/App.php';
require_once dirname(__DIR__,2) . '/app/config/helpers.php';

class UserController extends AbstractController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST, EXTR_SKIP);
            Validator::reset();
            array_map(function($k,$v){if(Validator::isEmpty($v))Validator::addError($k,Session::getErrorMessage($k));},array_keys(['telephone'=>$telephone??'','password'=>$password??'']),['telephone'=>$telephone??'','password'=>$password??'']);
            $errors=Validator::getErrors();
            $old=['telephone'=>$telephone??''];
            if(empty($errors)&&PersonneService::getInstance()->connecter($telephone??'', $password??''))redirect('accueil');
            if(empty($errors))Validator::addError('global','Identifiants invalides.');
            Session::getInstance()->set('errors',Validator::getErrors());
            Session::getInstance()->set('old',$old);
            redirect('login');
            exit;
        }
        require __DIR__ . "/../../templates/user/login.html.php";
    }
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST, EXTR_SKIP);
            $photoRectoPath = (isset($_FILES['photo_recto']) && $_FILES['photo_recto']['error'] === UPLOAD_ERR_OK) ? FileUploade::upload($_FILES['photo_recto'], __DIR__ . '/../../../public/images/uploads/') : '';
            $photoVersoPath = (isset($_FILES['photo_verso']) && $_FILES['photo_verso']['error'] === UPLOAD_ERR_OK) ? FileUploade::upload($_FILES['photo_verso'], __DIR__ . '/../../../public/images/uploads/') : '';
            $data = [
                'id' => uniqid(),
                'telephone' => $telephone ?? '',
                'password' => $password ?? '',
                'password_confirm' => $password_confirm ?? '',
                'num_identite' => $num_identite ?? '',
                'photo_recto' => $photoRectoPath,
                'photo_verso' => $photoVersoPath,
                'prenom' => $prenom ?? '',
                'nom' => $nom ?? '',
                'adresse' => $adresse ?? '',
                'type_personne' => 'client'
            ];
            $old = $data;
            Validator::reset();
            array_map(function($k,$v){if(Validator::isEmpty($v))Validator::addError($k,Session::getErrorMessage($k));},array_keys(['prenom'=>$data['prenom'],'nom'=>$data['nom'],'telephone'=>$data['telephone'],'adresse'=>$data['adresse'],'num_identite'=>$data['num_identite'],'password'=>$data['password']]),['prenom'=>$data['prenom'],'nom'=>$data['nom'],'telephone'=>$data['telephone'],'adresse'=>$data['adresse'],'num_identite'=>$data['num_identite'],'password'=>$data['password']]);
            if($data['password']!==$data['password_confirm'])Validator::addError('password_confirm',Session::getErrorMessage('password_confirm'));
            Validator::validatePersonneData($data['telephone'],$data['num_identite']);
            $errors=Validator::getErrors();
            if(empty($errors)&&PersonneService::getInstance()->inscrire($data))redirect('login?signup');
            if(empty($errors))Validator::addError('global','Erreur lors de l\'inscription.');
            Session::getInstance()->set('errors',Validator::getErrors());
            Session::getInstance()->set('old',$old);
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
            Validator::reset();
            $fields = [
                'telephone' => $telephone,
                'password' => $password
            ];
            foreach ($fields as $key => $value) {
                if (Validator::isEmpty($value)) {
                    Validator::addError($key, Session::getErrorMessage($key));
                }
            }
            $errors = Validator::getErrors();
            if (empty($errors)) {
                $personneService = PersonneService::getInstance();
                $ok = $personneService->connecter($telephone, $password);
                if ($ok) {
                    redirect('accueil');
                    exit;
                } else {
                    Validator::addError('global', 'Identifiants invalides.');
                    $errors = Validator::getErrors();
                }
            }
            Session::getInstance()->set('errors', $errors);
            Session::getInstance()->set('old', $old);
            redirect('login');
            exit;
        }
        require __DIR__ . "/../../templates/user/login.html.php";
    }


  public function create(){}

  
}
