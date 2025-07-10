<?php

namespace Maxitsa\Controller;
require_once __DIR__ . '/../../core/App.php';


use Maxitsa\Abstract\AbstractController;


class UserController extends AbstractController
{
    public function login()
    {
        require __DIR__ . "/../../templates/user/login.html.php";
    }
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => uniqid(),
                'telephone' => $_POST['telephone'] ?? '',
                'password' => $_POST['password'] ?? '',
                'num_identite' => $_POST['num_identite'] ?? '',
                'photo_recto' => $_POST['photo_recto'] ?? '',
                'photo_verso' => $_POST['photo_verso'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'nom' => $_POST['nom'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
               
                'type_personne' => 'client'
            ];
            $personneRepo = \App::getDependency('repository', 'PersonneRepository');
            if ($personneRepo) {
                $personneService = new \PersonneService($personneRepo);
                $ok = $personneService->inscrire($data);
            } else {
                $ok = false;
            }
            if ($ok) {
                header('Location: /login?signup=success');
                exit;
            } else {
                echo 'Erreur lors de l\'inscription.';
            }
        } else {
            require __DIR__ . "/../../templates/user/signup.html.php";
        }
    }

    public function signin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $telephone = $_POST['telephone'] ?? '';
            $password = $_POST['password'] ?? '';
            $personneRepo = \App::getDependency('repository', 'PersonneRepository');
            if ($personneRepo) {
                $personneService = new \PersonneService($personneRepo);
               
                $ok = $personneService->connecter($telephone, $password);
                if ($ok) {
                    header('Location: /accueil');
                    exit;
                }
            }
            echo 'Identifiants invalides.';
        } else {
            require __DIR__ . "/../../templates/user/login.html.php";
        }
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
            $compteRepo = \App::getDependency('repository', 'CompteRepository');
            if ($compteRepo) {
                $compteService = new \CompteService($compteRepo);
                $compteCree = $compteService->creerCompte($data);
                if ($compteCree) {
                    header('Location: /comptes?success=1');
                    exit;
                } else {
                    echo 'Erreur lors de la création du compte.';
                }
            } else {
                echo 'Erreur lors de la création du compte.';
            }
        }
        require __DIR__ . '/../../templates/compte/create.html.php';
    }
}
