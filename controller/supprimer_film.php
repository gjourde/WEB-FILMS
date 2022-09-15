<?php


if (isset($_SESSION['email'])) {
    if (isset($_POST['id'])) {
        $filmsDao = new FilmsDAO();
        $idFilm = $_POST['id'];
        $status = $filmsDao->deleteOne($idFilm);
        if ($status) {
            echo $twig->render('supprimer_film.html.twig', ['status' => "Suppression OK", 'films' => $idFilm]);
        } else {
            echo $twig->render('supprimer_film.html.twig', ['status' => "Erreur Suppression"]);
        }
    } else {
        echo $twig->render('liste_film.html.twig');
    }
} else {
    header('location:connexion');
}
