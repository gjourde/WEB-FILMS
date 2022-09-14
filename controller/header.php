<?php
//On affiche le template Twig correspondant
if (isset($_SESSION['email'])) {
    echo $twig->render('header.html.twig', ['username' => $_SESSION['email']]);
} else {
    echo $twig->render('header.html.twig', ['username' => 'Pas de utilisateur']);
}
