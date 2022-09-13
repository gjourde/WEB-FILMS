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
    // Requetage pour avoir tous les acteurs et leurs roles //
    public function getAllActeur()
    {

        $query = $this->_bdd->prepare("SELECT idFilm , personnage, nom, prenom FROM role INNER JOIN acteurs ON role.idActeur = acteurs.idActeur ");
        $query->execute();
        $acteurs = array();

        while ($data = $query->fetch()) {
            // a Confirmer //
            array_push($acteurs, array('idFilm' => $data['idFilm'], $data['nom'], $data['prenom'], $data['personnage']));
        }
        return ($acteurs);
    }

    public function getActeurFilm($idFilm)
    {
        //meme requete que getAllActeur renvoie requete avec idFilm where $idFilm = acteur.idFilm // 
        // a Confirmer //
        $query = $this->_bdd->prepare("SELECT idFilm , personnage, nom, prenom FROM role INNER JOIN acteurs ON role.idActeur = acteurs.idActeur WHERE $idFilm = acteurs.idFilm");
        $query->execute();
        $acteurs = array();

        while ($data = $query->fetch()) {
            // a Confirmer //
            array_push($acteurs, array('idFilm' => $data['idFilm'], $data['nom'], $data['prenom'], $data['personnage']));
        }
        return ($acteurs);
    }
}
