<?php

/**
 * Description of Films
 *
 * @author Kris
 */
class FilmsDAO extends Dao
{

    // Récupérer le film grace a son titre dans la recherche, ou si pas de titre, ressort tous les film de la BDD //

    public function getAll($titre = null)
    {
        // Si pas de titre //
        if ($titre == null) {
            $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films");
            $query->execute();
            // avec titre //
        } else {
            $query = $this->_bdd->prepare("SELECT films.idFilm, titre, realisateur, affiche, annee FROM films WHERE LOWER(titre) LIKE LOWER(:titre)");
            $query->execute(array(':titre' => $titre . '%'));
        }
        $films = array();
        while ($data = $query->fetch()) {
            $roles = $this->getRole(($data['idFilm']));
            $films[] = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], $roles);
        }
        return ($films);
    }

    // Derniere Ligne Film dans la BDD //

    public function lastRowFilm()
    {
        $query = $this->_bdd->prepare("SELECT * FROM films ORDER BY idFilm DESC LIMIT 1");
        $query->execute();
        $data = $query->fetch();
        $films = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($films);
    }

    // Derniere Ligne Acteur dans la BDD //

    public function lastRowActeur()
    {
        $query = $this->_bdd->prepare("SELECT * FROM acteurs ORDER BY idActeur DESC LIMIT 1");
        $query->execute();
        $data = $query->fetch();
        $acteur = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        return ($acteur);
    }

    // Recuperation des roles avec iDFilm //

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

    // Recuperation des acteurs avec idActeur //

    public function getActeur($idActeur)
    {
        $query = $this->_bdd->prepare('SELECT * FROM acteurs 
        WHERE idActeur = :idActeur');
        $query->execute(array(':idActeur' => $idActeur));
        $data = $query->fetch();
        $acteur = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        return $acteur;
    }

    // Recuperation des acteurs avec le nom et le prenom //

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

    //Récupérer un film avec role et acteurs associé //

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

    // Supprimer un film //

    public function deleteOne($idFilm): int
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

    // Supprimer un acteur // 

    public function deleteActeur($idActeur): int
    {
        $query = $this->_bdd->prepare('DELETE FROM acteurs WHERE acteurs.idActeur = :idActeur');
        $query->execute(array(':idActeur' => $idActeur));
        return ($query->rowCount());
    }

    // Supprimer un role //

    public function deleteRole($idRole): int
    {
        $query = $this->_bdd->prepare('DELETE FROM role WHERE role.idRole = :idRole');
        $query->execute(array(':idRole' => $idRole));
        return ($query->rowCount());
    }
}
