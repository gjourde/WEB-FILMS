
<?php

if (isset($_POST["email"]) and isset($_POST["mdp"])) {
    $UserDao = new UserDAO();
    $User = $UserDAO->getUser($_POST["email"]);
    if ($User != null) {
        $_SESSION['email'] = $User->getEmail();
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
