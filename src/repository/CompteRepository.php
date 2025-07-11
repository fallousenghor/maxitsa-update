<?php
namespace Maxitsa\Repository;

use Maxitsa\Abstract\AbstractRepository;
use Maxitsa\Core\App;

class CompteRepository extends AbstractRepository{
    private static ?CompteRepository $instance = null;

    private function __construct() {
        
    }

    public static function getInstance(): CompteRepository {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

     public function insert($compte = null){
         $db = App::getDependency('core', 'Database')->getConnection();
         $stmt = $db->prepare("INSERT INTO compte (id, telephone, solde, personne_id, type_compte) VALUES (:id, :telephone, :solde, :personne_id, :type_compte)");
         return $stmt->execute([
             'id' => $compte->getId(),
             'telephone' => $compte->getTelephone(),
             'solde' => $compte->getSolde(),
             'personne_id' => $compte->getPersonne()->id,
             'type_compte' => $compte->getTypeCompte()
         ]);
     }
     public function update(){}
  
 }