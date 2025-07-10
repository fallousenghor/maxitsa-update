<?php

use Maxitsa\Abstract\AbstractEntity;

class Compte extends AbstractEntity {
    private string $id;
    private string $telephone;
    private float $solde;
    private $personne; // Personne
    private array $transactions = [];
    private $typeCompte; // string

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTelephone() { return $this->telephone; }
    public function setTelephone($telephone) { $this->telephone = $telephone; }
    public function getSolde() { return $this->solde; }
    public function setSolde($solde) { $this->solde = $solde; }
    public function getPersonne() { return $this->personne; }
    public function setPersonne($personne) { $this->personne = $personne; }
    public function addTransaction($transaction) { $this->transactions[] = $transaction; }
    public function getTypeCompte() { return $this->typeCompte; }
    public function setTypeCompte($type) { $this->typeCompte = $type; }
}