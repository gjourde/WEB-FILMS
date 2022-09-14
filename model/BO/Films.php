<?php

// Creation classe Film //
class Films
{

    private $idFilm;
    private $titre;
    private $realisateur;
    private $affiche;
    private $annee;

    public function __construct(int $idFilm = null, string $titre, string $realisateur, $affiche, int $annee)
    {
        $this->idFilm = $idFilm;
        $this->titre = $titre;
        $this->realisateur = $realisateur;
        $this->affiche = $affiche;
        $this->annee = $annee;
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
}
