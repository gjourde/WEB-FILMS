<?php

// Creation de la Classe Role // 

class Role
{
    private $personnage;
    private $idRole;

    public function __construct(string $personnage, int $idRole)
    {
        $this->personnage = $personnage;
        $this->idRole = $idRole;
    }

    // GETTER //

    public function getPersonnage()
    {
        return $this->personnage;
    }


    public function getIdRole()
    {
        return $this->idRole;
    }

    // SETTER // 

    public function setPersonnage($personnage)
    {
        $this->personnage = $personnage;
    }

    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;
    }
}
