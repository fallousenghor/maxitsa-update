<?php
namespace Maxitsa\Service;
use Maxista\Enum\TypePersonne;
use Maxitsa\Repository\PersonneRepository;
use Maxitsa\Entity\Personne;
use Maxitsa\Core\TwilioService;




class PersonneService {
    private static ?PersonneService $instance = null;
    private PersonneRepository $personneRepository;

    private function __construct() {
        $this->personneRepository = PersonneRepository::getInstance();
    }

    public static function getInstance(): PersonneService {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function inscrire(array $data): bool {
        $db = \Maxitsa\Core\App::getDependency('core', 'Database')->getConnection();
        try {
            $db->beginTransaction();

            
            $personne = new Personne();
            $personne->id = $data['id'];
            $personne->telephone = $data['telephone'];
            $personne->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $personne->num_identite = $data['num_identite'];
            $personne->photo_recto = $data['photo_recto'];
            $personne->photo_verso = $data['photo_verso'];
            $personne->prenom = $data['prenom'];
            $personne->nom = $data['nom'];
            $personne->adresse = $data['adresse'];
            $personne->typePersonne = 'client';
            $okPersonne = $this->personneRepository->insert($personne);

           
            if ($okPersonne) {
                $compteData = [
                    'id' => uniqid(),
                    'telephone' => $data['telephone'],
                    'solde' => 0,
                    'personne' => $personne,
                    'type_compte' => 'principal'
                ];
                $compteService = \Maxitsa\Service\CompteService::getInstance();
                $okCompte = $compteService->creerCompte($compteData);
                if ($okCompte) {
                    
                    try {
                        $twilio = new Maxitsa\Core\TwilioService();
                        $message = "Bienvenue sur Maxitsa, ".$personne->prenom."! Votre inscription est confirmée.";
                        $twilio->sendSms($personne->telephone, $message);
                    } catch (\Exception $e) {
                       
                        error_log('Erreur Twilio: ' . $e->getMessage());
                    }
                    $db->commit();
                    return true;
                }
            }
            $db->rollBack();
            return false;
        } catch (\Exception $e) {
            $db->rollBack();
            return false;
        }
    }

    public function connecter($telephone, $password): bool {
        session_start();
        $personne = $this->personneRepository->findByTelephone($telephone);
        if ($personne && password_verify($password, $personne['password'])) {
            $_SESSION['user'] = $personne;
            return true;
        }
        return false;
    }
}
