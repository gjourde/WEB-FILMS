<?php

//On appelle la fonction getAll()
$filmsDao = new FilmsDAO();
// /* @var $alloffers type */
$allFilms = $filmsDao->getAll();

echo $twig->render('liste_film.html.twig', ['allFilms' => $allFilms]);
