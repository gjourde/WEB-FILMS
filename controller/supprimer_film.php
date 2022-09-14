<?php



$filmsDao = new FilmsDAO();
if (isset($_POST['id'])) {
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
