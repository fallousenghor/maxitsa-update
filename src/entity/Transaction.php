<?php

use Maxitsa\Abstract\AbstractEntity;

class Transaction extends AbstractEntity {
    private string $id;
    private float $montant;
    private Compte $compte;
    private string $type; // depot, retrait, paiement
    private \DateTime $date;

    public function getCompte() { /* ... */ }
    public function addCompte(Compte $compte) { /* ... */ }
}