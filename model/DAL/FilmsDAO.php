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
    public function getAll($titre = null)
    {
        //On définit la bdd pour la fonction //
        // Probleme de doublon de Film //
        if ($titre == null) {
            $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films");
            $query->execute();
        } else {
            $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films WHERE titre = :titre");
            $query->execute(array(':titre' => $titre));
        }
        $films = array();
        while ($data = $query->fetch()) {
            $roles = $this->getRole(($data['idFilm']));
            $films[] = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], $roles);
        }
        return ($films);
    }


    public function lastRowFilm()
    {
        $query = $this->_bdd->prepare("SELECT * FROM films ORDER BY idFilm DESC LIMIT 1");
        $query->execute();
        $data = $query->fetch();
        $films = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($films);
    }

    public function lastRowActeur()
    {
        $query = $this->_bdd->prepare("SELECT * FROM acteurs ORDER BY idActeur DESC LIMIT 1");
        $query->execute();
        $data = $query->fetch();
        $acteur = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        return ($acteur);
    }

    // Recuperation des role avec l'acteur //
    public function getRole($idFilm)
    {
        $query = $this->_bdd->prepare('SELECT * FROM role 
        WHERE idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        $roles = array();
        while ($data = $query->fetch()) {
            $acteur = $this->getActeur($data['idActeur']);
            $roles[] = new Role($acteur, $data['idFilm'], $data['personnage'], $data['idRole']);
        }
        return ($roles);
    }

    public function getActeur($idActeur)
    {
        $query = $this->_bdd->prepare('SELECT * FROM acteurs 
        WHERE idActeur = :idActeur');
        $query->execute(array(':idActeur' => $idActeur));
        $data = $query->fetch();
        $acteur = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        return $acteur;
    }

    // Ajouter un Film a la BDD //

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

    // Ajouter un Acteur a la BDD //

    public function addActeur($data)
    {
        $valeurs = ['idActeur' => null, 'nom' => $data->getNom(), 'prenom' => $data->getPrenom()];
        $requete = 'INSERT INTO acteurs (idActeur, nom, prenom) VALUES (:idActeur, :nom, :prenom)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            $acteur = $this->lastRowActeur();
            $id = $acteur->getIdActeur();
            return $id;
        }
    }

    // Ajouter un Role a la BDD //
    public function addRole($data)
    {
        $acteur = $data->getActeur();
        $valeurs = ['idActeur' => $acteur->getIdActeur(), 'idFilm' => $data->getIdFilm(), 'personnage' => $data->getPersonnage(), 'idRole' => null, 'test' => 0];
        $requete = 'INSERT INTO role (idActeur, idFilm, personnage, idRole, test) VALUES (:idActeur, :idFilm, :personnage, :idRole, :test)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
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
        $query = $this->_bdd->prepare('DELETE films, role, acteurs FROM films INNER JOIN role INNER JOIN acteurs ON films.idFilm = role.idFilm AND role.idActeur = acteurs.idActeur  WHERE films.idFilm = :idFilm');
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
            $listeActeur[] = new Role($data['idRole'], $data['personnage'], $data['acteur'], $data['idFilm']);
        }
        return ($listeActeur);
    }
}
/*

public function deleteOne($idFilm): int
    // A coder //
    {
        $query = $this->_bdd->prepare('DELETE FROM films WHERE films.idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        return ($query->rowCount());
    } */