
<?php

if (isset($_COOKIE["cookieEmail"])) {
    echo $twig->render('connexion.html.twig', ['email' => $_COOKIE["cookieEmail"]]);
} else {
    echo $twig->render('connexion.html.twig');
}
