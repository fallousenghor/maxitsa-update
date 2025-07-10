<?php



class CompteService {
    private CompteRepository $compteRepository;

    public function __construct(CompteRepository $compteRepository) {
        $this->compteRepository = $compteRepository;
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
