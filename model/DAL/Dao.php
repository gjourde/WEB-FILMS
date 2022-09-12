<?php
// Instanciation de la Classe DAO --> BDD //
abstract class Dao
{

    protected $_bdd;

    public function __construct()
    {
        // Connexion Database
        // Connexion Database
        try {
            $this->set_bdd(SPDO::getInstance());
            $this->_bdd->query("SET NAMES UTF8");
        } catch (Exception $e) {
            echo "Problème de connexion à la base de donnée ...";
            die();
        }
    }

    //Récupérer toutes les items
    abstract public function getAll();

    //Récupérer plus d'info sur 1 item à l'aide de son id
    abstract public function getOne($idFilm);

    //Ajouter un item
    abstract public function add($data);

    public function set_bdd($_bdd)
    {
        $this->_bdd = $_bdd;
    }
}
