<?php
// Creation de la classe Acteurs //


class Acteurs
{
    private $idActeur;
    private $nom;
    private $prenom;

    public function __construct($idActeur = null, string $nom, string $prenom)
    {
        $this->idActeur = $idActeur;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    // GETTER //

    public function getIdActeur()
    {
        return $this->idActeur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    // SETTER // 

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setIdActeur($idActeur)
    {
        $this->idActeur = $idActeur;
    }
}
