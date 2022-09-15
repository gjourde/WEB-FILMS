<?php

//On appelle la fonction getAll()
$filmsDao = new FilmsDAO();
// /* @var $alloffers type */
if (isset($_POST["search"])) {
    $allFilms = $filmsDao->getAll($_POST["search"]);
    print_r($allFilms);
} else {
    $allFilms = $filmsDao->getAll();
}
//On affiche le template Twig correspondant
echo $twig->render('affichageFilms.html.twig', ['allFilms' => $allFilms]);
