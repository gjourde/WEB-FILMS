<?php

// Creation de la Classe Role // 

class Role
{
    private $idRole;
    private $personnage;


    public function __construct($idRole = null, string $personnage)
    {
        $this->idRole = $idRole;
        $this->personnage = $personnage;
    }

    // GETTER //

    public function getIdRole()
    {
        return $this->idRole;
    }

    public function getPersonnage()
    {
        return $this->personnage;
    }

    // SETTER // 

    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;
    }

    public function setPersonnage($personnage)
    {
        $this->personnage = $personnage;
    }
}
