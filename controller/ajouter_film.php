<?php

// Controller pour l'ajout d'un nouveau film //
if (isset($_SESSION['email'])) {
    if (isset($_POST['titre']) and isset($_POST['realisateur']) and isset($_POST['affiche']) and isset($_POST['annee'])) {
        $filmsDao = new FilmsDAO();
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
} else {
    header('location:connexion');
}
