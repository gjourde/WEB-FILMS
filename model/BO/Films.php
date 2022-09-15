<?php

// Creation classe Film //
class Films
{

    private $idFilm;
    private $titre;
    private $realisateur;
    private $affiche;
    private $annee;
    private $tabRole;

    public function __construct($idFilm = null, string $titre = null, string $realisateur = null, $affiche = null, int $annee = null, $tabRole = [])
    {
        $this->idFilm = $idFilm;
        $this->titre = $titre;
        $this->realisateur = $realisateur;
        $this->affiche = $affiche;
        $this->annee = $annee;
        $this->tabRole = $tabRole;
    }

    // GETTER //
    public function getIdFilm()
    {
        return $this->idFilm;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getRealisateur()
    {
        return $this->realisateur;
    }

    public function getAffiche()
    {
        return $this->affiche;
    }

    public function getAnnee()
    {
        return $this->annee;
    }
    public function getTabRole()
    {
        return $this->tabRole;
    }

    // SETTER //

    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setRealisateur($realisateur)
    {

        $this->realisateur = $realisateur;
    }

    public function setAffiche($affiche)
    {
        // Fonction affichage d'une image par defaut si $affiche = " NULL " //
        if ($affiche == null) {
            $this->affiche = 'https://www.wallpaperuse.com/vifr/iimhow/';
        } else
            $this->affiche = $affiche;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    public function setTabRole($tabRole)
    {
        $this->tabRole = $tabRole;
    }
}
