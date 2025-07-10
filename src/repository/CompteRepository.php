<?php

use Maxitsa\Abstract\AbstractRepository;
 class CompteRepository extends AbstractRepository{

     public function insert($compte = null){
         $db = \App::getDependency('core', 'Database')->getConnection();
         $stmt = $db->prepare("INSERT INTO compte (id, telephone, solde, personne_id, type_compte) VALUES (:id, :telephone, :solde, :personne_id, :type_compte)");
         return $stmt->execute([
             'id' => $compte->getId(),
             'telephone' => $compte->getTelephone(),
             'solde' => $compte->getSolde(),
             'personne_id' => $compte->getPersonne()->getId(),
             'type_compte' => $compte->getTypeCompte()
         ]);
     }
     public function update(){}
  
 }