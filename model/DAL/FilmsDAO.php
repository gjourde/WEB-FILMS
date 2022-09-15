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
            $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films WHERE titre LIKE :titre");
            $query->execute(array(':titre' => $titre.'%'));
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

    public function getActeurBy($nom, $prenom)
    {
        $query = $this->_bdd->prepare('SELECT * FROM acteurs 
        WHERE nom = :nom AND prenom = :prenom');
        $query->execute(array(':nom' => $nom, ':prenom' => $prenom));
        $data = $query->fetch();
        if ($data) {
            $acteur = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        } else {
            $acteur = null;
        }
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
        // $acteur = $this->getActeur($data->getIdActeur()); //
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
        $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films WHERE idFilm = :idFilm");
        $query->execute(array(':idFilm' => $idFilm));
        $films = array();
        while ($data = $query->fetch()) {
            $roles = $this->getRole(($data['idFilm']));
            $films = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], $roles);
        }
        return ($films);
    }
    // Fonction pour delete un Film  //
    public function deleteOne($idFilm): int
    // A coder //
    {
        $data = $this->getOne($idFilm);
        $roles = $data->getTabRole();
        foreach ($roles as $role) {
            $idRole = $role->getIdRole();
            $this->deleteRole($idRole);
        }
        $query = $this->_bdd->prepare('DELETE FROM films WHERE films.idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        return ($query->rowCount());
    }

    public function deleteActeur($idActeur): int
    {
        $query = $this->_bdd->prepare('DELETE FROM acteurs WHERE acteurs.idActeur = :idActeur');
        $query->execute(array(':idActeur' => $idActeur));
        return ($query->rowCount());
    }

    public function deleteRole($idRole): int
    {
        $query = $this->_bdd->prepare('DELETE FROM role WHERE role.idRole = :idRole');
        $query->execute(array(':idRole' => $idRole));
        return ($query->rowCount());
    }
}
