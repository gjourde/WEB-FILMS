
<?php

//ATTENTION RIEN N'EST FAIT JUSTE DE LA RECOPIE DE FILMDAO
//ATTENTION RIEN N'EST FAIT JUSTE DE LA RECOPIE DE FILMDAO
//ATTENTION RIEN N'EST FAIT JUSTE DE LA RECOPIE DE FILMDAO

class UserDAO extends Dao
{
    //Récupérer tous les films //
    public function getAll()
    {
        //On définit la bdd pour la fonction

        $query = $this->_bdd->prepare("SELECT idFilm, titre, realisateur, affiche, annee FROM films");
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

        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisteur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $requete = 'INSERT INTO films (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur , :affiche , :annee)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            //print_r($insert->errorInfo());
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur 1 Film
    public function getOne($idFilm)
    {

        $query = $this->_bdd->prepare('SELECT * FROM films WHERE films.id = :idFilm')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':idFilm' => $idFilm));
        $data = $query->fetch();
        $films = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($films);
    }

    // Fonction pour delete une offre //
    public function deleteOne($idFilm): int
    {
        $query = $this->_bdd->prepare('DELETE FROM offers WHERE offers.id = :idOffer');
        $query->execute(array(':idFilm' => $idFilm));
        return ($query->rowCount());
    }
}
