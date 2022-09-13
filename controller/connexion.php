
<?php

if (isset($_SESSION["remember"])) {
    echo $twig->render('connexion.html.twig', ['email' => $_SESSION['email']]);
} else {
    echo $twig->render('connexion.html.twig');
}
