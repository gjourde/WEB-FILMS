<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Films
 *
 * @author Kris
 */
class FilmsDAO extends Dao
{

    // Récupérer tous les films avec les Jointure affichées //
    public function getAll()
    {
        //On définit la bdd pour la fonction //
        // Probleme de doublon de Film //
        $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films");
        $query->execute();
        $films = array();

        while ($data = $query->fetch()) {
            $films[] = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return ($films);
    }

    //Ajouter un Film ICI //

    public function add($data)
    {

        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $requete = 'INSERT INTO films (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur , :affiche , :annee)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            //print_r($insert->errorInfo());
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur 1 Film //

    public function getOne($idFilm)
    {

        $query = $this->_bdd->prepare('SELECT * FROM films WHERE films.id = :idFilm')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':idFilm' => $idFilm));
        $data = $query->fetch();
        $films = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($films);
    }
    // Fonction pour delete un Film  //
    public function deleteOne($idFilm): int
    // A coder //
    {
        $query = $this->_bdd->prepare('DELETE FROM films WHERE films.idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        return ($query->rowCount());
    }
    // Requete pour afficher les acteurs et leurs role par rapport a l'idFilm //

    public function acteurFilm($idFilm)
    {
        $listeActeur = [];
        $query = $this->_bdd->prepare('SELECT idFilm, nom, prenom, acteurs.idActeur, personnage, idRole FROM role 
        INNER JOIN acteurs ON role.idActeur = acteurs.idActeur
        WHERE idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        while ($data = $query->fetch()) {
            $listeActeur[] = new Role($data['idRole'], $data['personnage'], $data['nom'], $data['prenom'], $data['idFilm']);
        }
        return ($listeActeur);
    }
}
