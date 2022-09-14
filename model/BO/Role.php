<?php

// Creation de la Classe Role // 

class Role
{
    private $idRole;
    private $personnage;
    private $acteur;


    public function __construct($idRole = null, string $personnage, $acteur)
    {

        $this->idRole = $idRole;
        $this->personnage = $personnage;
        $this->acteur = $acteur;
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
    public function getActeur()
    {
        return $this->acteur;
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


    /**
     * Set the value of acteur
     */
    public function setActeur($acteur)
    {
        $this->acteur = $acteur;
    }
}
