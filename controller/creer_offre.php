<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$offresDao = new OffresDAO();
if (isset($_POST['title']) and isset($_POST['description'])) {
    //On affiche le template Twig correspondant
    $offre = new Offres(null, $_POST['title'], $_POST['description']);
    $status = $offresDao->add($offre);
    if ($status) {
        echo $twig->render('creer_offre.html.twig', ['status' => "Ajout OK", 'offre' => $offre]);
    } else {
        echo $twig->render('creer_offre.html.twig', ['status' => "Erreur Ajout"]);
    }
} else {
    echo $twig->render('creer_offre.html.twig');
}
