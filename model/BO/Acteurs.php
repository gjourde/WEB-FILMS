<?php
// Creation de la classe Acteurs //


class Acteurs
{
    private $idActeur;
    private $nom;
    private $prenom;

    public function __construct($idActeur = null,  $prenom = null,  $nom = null)
    {
        $this->idActeur = $idActeur;
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    // GETTER //

    public function getIdActeur()
    {
        return $this->idActeur;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }



    // SETTER // 

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setIdActeur($idActeur)
    {
        $this->idActeur = $idActeur;
    }
}
