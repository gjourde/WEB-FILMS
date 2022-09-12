<?php

//On appelle la fonction getAll()
$offresDao = new OffresDAO();
if (isset($_POST["id"])) {
    $status = $offresDao->deleteOne($_POST["id"]);
    if ($status) {
        echo $twig->render('delete_offre.html.twig', ['status' => "suppression OK", 'offreId' => $_POST["id"]]);
    } else {
        echo $twig->render('delete_offre.html.twig', ['status' => "Erreur suppression"]);
    }
}
