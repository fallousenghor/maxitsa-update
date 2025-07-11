<?php
namespace Maxitsa\Entity;

use Maxitsa\Abstract\AbstractEntity;

class Transaction extends AbstractEntity {
    private string $id;
    private float $montant;
    private Compte $compte;
    private string $type; 
    private \DateTime $date;

    public function getMontant(): float {
        return $this->montant;
    }
    public function setMontant(float $montant): void {
        $this->montant = $montant;
    }

    public function getType(): string {
        return $this->type;
    }
    public function setType(string $type): void {
        $this->type = $type;
    }

    public function getDate(): \DateTime {
        return $this->date;
    }
    public function setDate(\DateTime $date): void {
        $this->date = $date;
    }

    public function getCompte() { }
    public function addCompte(Compte $compte) {  }
}