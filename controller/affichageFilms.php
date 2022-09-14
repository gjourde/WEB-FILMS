<?php

//On appelle la fonction getAll()
$filmsDao = new FilmsDAO();
// /* @var $alloffers type */
$allFilms = $filmsDao->getAll();
$film->setTabRole($listeActeur);
//$allActeur = $filmsDao->getAllActeur();//

// print_r($allActeur);
//On affiche le template Twig correspondant
echo $twig->render('affichageFilms.html.twig', ['allFilms' => $allFilms]);
