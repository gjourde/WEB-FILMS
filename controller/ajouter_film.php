<?php

// Controller pour l'ajout d'un nouveau film //

$filmsDao = new FilmsDAO();
if (isset($_POST['titre']) and isset($_POST['realisateur']) and isset($_POST['affiche']) and isset($_POST['annee'])) {
    //On affiche le template Twig correspondant
    $film = new Films($_POST['idFilm'], $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);
    $status = $filmsDao->add($film);
    if ($status) {
        echo $twig->render('ajouter_film.html.twig', ['status' => "Ajout du Film confirmé ", 'films' => $film]);
    } else {
        echo $twig->render('ajouter_film.html.twig', ['status' => "Erreur Dans l'ajout du Film"]);
    }
} else {
    echo $twig->render('ajouter_film.html.twig');
}
