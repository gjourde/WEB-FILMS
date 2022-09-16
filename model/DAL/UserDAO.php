
<?php

class UserDAO extends Dao
{
    //Récupérer tous les Users //
    public function getAll()
    {
        $query = $this->_bdd->prepare("SELECT idUser, userName, email, password FROM user");
        $query->execute();
        $user = array();

        while ($data = $query->fetch()) {
            $user[] = new User($data['idUser'], $data['userName'], $data['email'], $data['password']);
        }
        return ($user);
    }

    //Ajouter un User //

    public function add($data)
    {

        $valeurs = ['idUser' => $data->getIdUser(), 'userName' => $data->getUserName(), 'email' => $data->getEmail(), 'password' => $data->getPassword()];
        $requete = 'INSERT INTO user (idUser, userName, email, password) VALUES (:idUser , :userName , :email , :password)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur un User //

    public function getOne($idUser)
    {

        $query = $this->_bdd->prepare('SELECT * FROM user WHERE user.idUser = :idUser')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':idUser' => $idUser));
        $data = $query->fetch();
        $user = new User($data['idUser'], $data['userName'], $data['email'], $data['password']);
        return ($user);
    }
    // Fonction pour tester si un Utilisateur a bien un email //

    public function getUser($email)
    {
        $query = $this->_bdd->prepare('SELECT * FROM user WHERE user.email = :email');
        $query->execute(array(':email' => $email));
        $data = $query->fetch();
        if ($data) {
            $user = new User($data['idUser'], $data['userName'], $data['email'], $data['password']);
        } else {
            $user = null;
        }
        return ($user);
    }
}
