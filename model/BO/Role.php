<?php

// Creation de la Classe Role // 

class Role
{
    private $idRole;
    private $personnage;
    private $acteur;
    private $idFilm;


    public function __construct($idRole = null, string $personnage, $acteur, $idFilm = null)
    {

        $this->idRole = $idRole;
        $this->personnage = $personnage;
        $this->acteur = $acteur;
        $this->idFilm = $idFilm;
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

    public function getIdFilm()
    {
        return $this->idFilm;
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

    public function setActeur($acteur)
    {
        $this->acteur = $acteur;
    }

    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;
    }
}
