<?php
namespace Maxitsa\Service; 

use Maxitsa\Entity\Compte;
use Maxitsa\Repository\CompteRepository;





class CompteService {
    private static ?CompteService $instance = null;
    private CompteRepository $compteRepository;

    private function __construct() {
        $this->compteRepository = CompteRepository::getInstance();
    }

    public static function getInstance(): CompteService {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function creerCompte(array $data): bool {
        $compte = new Compte();
        $compte->setId($data['id']);
        $compte->setTelephone($data['telephone']);
        $compte->setSolde($data['solde']);
        $compte->setPersonne($data['personne']);
        $compte->setTypeCompte($data['type_compte']);
        return $this->compteRepository->insert($compte);
    }
}
