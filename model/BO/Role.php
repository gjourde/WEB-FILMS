<?php

// Creation de la Classe Role // 

class Role
{
    private $acteur;
    private $idRole;
    private $personnage;
    private $idFilm;


    public function __construct($acteur, $idFilm, string $personnage, $idRole = null)
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
