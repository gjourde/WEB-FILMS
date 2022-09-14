<?php

// Creation de la Classe Role // 

class Role
{
    private $idRole;
    private $personnage;
    private $nom;
    private $prenom;
    private $idFilm;


    public function __construct($idRole = null, string $personnage, $nom, $prenom, $idFilm = null)
    {

        $this->idRole = $idRole;
        $this->personnage = $personnage;
        $this->nom = $nom;
        $this->prenom = $prenom;
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
    public function getNom()
    {
        return $this->nom;
    }
    public function getPreom()
    {
        return $this->prenom;
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

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;
    }
}
