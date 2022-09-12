<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offres
 *
 * @author 1703728
 */
class OffresDAO extends Dao
{

    //Récupérer toutes les offres
    public function getAll()
    {
        //On définit la bdd pour la fonction
        $query = $this->_bdd->prepare("SELECT id, title, description FROM offers");
        $query->execute();
        $offers = array();

        while ($data = $query->fetch()) {
            $offers[] = new Offres($data['id'], $data['title'], $data['description']);
        }
        return ($offers);
    }

    //Ajouter une offre
    public function add($data)
    {
        $valeurs = ['title' => $data->get_title(), 'description' => $data->get_description()];
        $requete = 'INSERT INTO offers (title, description) VALUES (:title , :description)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            //print_r($insert->errorInfo());
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur 1 offre
    public function getOne($id_offer)
    {
        $query = $this->_bdd->prepare('SELECT * FROM offers WHERE offers.id = :id_offer')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':id_offer' => $id_offer));
        $data = $query->fetch();
        $offer = new Offres($data['id'], $data['title'], $data['description']);
        return ($offer);
    }

    public function deleteOne($id_Offer)
    {
        $query = $this->_bdd->prepare('DELETE FROM offers WHERE offers.id = :id_Offer');
        $query->execute(array(':id_Offer' => $id_Offer));
        return ($query->rowCount());
    }
}
