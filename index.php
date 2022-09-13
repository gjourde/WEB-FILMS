<?php

// Initialisation de l'environnement
include './config/config.init.php';

include _CTRL_ . 'header.php';

// Gestion de Routing
if (isset($_SESSION["email"])) {
    if (isset($_GET['action']) && file_exists(_CTRL_ . $_GET['action'] . '.php')) {
        include _CTRL_ . $_GET['action'] . '.php';
    } elseif (isset($_GET['action']) && !file_exists(_CTRL_ . $_GET['action'] . '.php')) {
        include _CTRL_ . 'erreur.php';
    } else {
        include _CTRL_ . 'affichageFilms.php';
    }
} else {
    if (isset($_POST["email"]) and isset($_POST["mdp"])) {
        $userDao = new UserDAO();
        $user = $userDao->getUser($_POST["email"]);
        $userName = $user->getUserName();
        $email = $user->getEmail();
        $mdp = $user->getPassword();

        echo $email . " " . $mdp . "<br>";
        echo $_POST["email"] . " " . $_POST["mdp"] . "<br>";

        if (($email == $_POST["email"]) && ($mdp == $_POST["mdp"])) {
            echo "ok";
            $_SESSION['email'] = $email;
            $_SESSION['userName'] = $userName;
            include _CTRL_ . 'affichageFilms.php';
        } else {
            include _CTRL_ . 'connexion.php';
            echo "pas ok";
        }
    } else {
        include _CTRL_ . 'connexion.php';
        echo "connexion";
    }
}
include _CTRL_ . 'footer.php';
