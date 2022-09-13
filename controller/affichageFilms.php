<?php

//On appelle la fonction getAll()
$filmsDao = new FilmsDAO();
/* @var $alloffers type */
$allFilms = $filmsDao->getAll();
//On affiche le template Twig correspondant
echo $twig->render('offres.html.twig', ['alloffers' => $alloffers]);
