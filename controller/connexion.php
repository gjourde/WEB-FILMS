
<?php

if (isset($_POST["email"]) and isset($_POST["mdp"])) {
    $userDao = new UserDAO();
    $user = $userDao->getUser($_POST["email"]);
    if ($user != null) {
        $_SESSION['email'] = $user->getEmail();
        //include _CTRL_ . 'index.php';
    } else {
        //erreur
    }
} else {
    if (isset($_SESSION["remember"])) {
        echo $twig->render('connexion.html.twig', ['email' => $_SESSION['email']]);
    } else {
        echo $twig->render('connexion.html.twig');
    }
}
