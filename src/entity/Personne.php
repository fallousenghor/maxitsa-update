<?php
namespace Maxitsa\Entity;
use Maxista\Enum\TypePersonne;
use Maxitsa\Abstract\AbstractEntity;


class Personne extends AbstractEntity {
    protected string $id;
    protected string $telephone;
    protected string $password;
    protected string $num_identite;
    protected string $photo_recto;
    protected string $photo_verso;
    protected string $prenom;
    protected string $nom;
    protected string $adresse;
    protected array $compte = [];
    protected string $typePersonne;

    // public function addCompte(Compte $compte): void { }
    // public function getTypePersonne(): ?TypePersonne {  }
    // public function setTypePersonne(TypePersonne $type): void { }
}