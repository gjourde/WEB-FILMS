<?php
// Commentaire pour la demo GUILLAUME //
// Controller pour afficher la liste des Films si session Ouverte //
if (isset($_SESSION['email'])) {
    //On appelle la fonction getAll()
    $filmsDao = new FilmsDAO();
    // /* @var $alloffers type */
    $allFilms = $filmsDao->getAll();

    echo $twig->render('liste_film.html.twig', ['allFilms' => $allFilms]);
} else {
    header('location:connexion');
}
