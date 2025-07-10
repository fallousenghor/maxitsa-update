<?php

class PersonneService {
    private PersonneRepository $personneRepository;

    public function __construct(PersonneRepository $personneRepository) {
        $this->personneRepository = $personneRepository;
    }

    public function inscrire(array $data): bool {
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
        $personne->typePersonne = isset($data['type_personne']) ? TypePersonne::from($data['type_personne']) : null;
        return $this->personneRepository->insert($personne);
    }

    public function connecter($telephone, $password): bool {
        $personne = $this->personneRepository->findByTelephone($telephone);
        if ($personne && password_verify($password, $personne->password)) {
            
            $_SESSION['user'] = $personne;
            return true;
        }
        return false;
    }
}
