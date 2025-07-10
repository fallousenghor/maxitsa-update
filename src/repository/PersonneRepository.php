<?php
use Maxitsa\Abstract\AbstractRepository;
require_once __DIR__ . '/../../core/App.php';


if (!class_exists('App') && class_exists('App', false) === false) {
    class_alias('App', 'App');
}



class PersonneRepository extends AbstractRepository {
    public function insert($entity = null) {
        $db = \App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare("INSERT INTO personne (id, telephone, password, num_identite, photo_recto, photo_verso, prenom, nom, adresse, type_personne) VALUES (:id, :telephone, :password, :num_identite, :photo_recto, :photo_verso, :prenom, :nom, :adresse, :type_personne)");
        return $stmt->execute([
            'id' => $entity->id,
            'telephone' => $entity->telephone,
            'password' => $entity->password,
            'num_identite' => $entity->num_identite,
            'photo_recto' => $entity->photo_recto,
            'photo_verso' => $entity->photo_verso,
            'prenom' => $entity->prenom,
            'nom' => $entity->nom,
            'adresse' => $entity->adresse,
            'type_personne' => $entity->typePersonne?->value ?? null
        ]);
    }

    public function findByTelephone($telephone) {
        $db = \App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare("SELECT * FROM personne WHERE telephone = :telephone");
        $stmt->execute(['telephone' => $telephone]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Personne');
        return $stmt->fetch();
    }
    public function update(){}
}
