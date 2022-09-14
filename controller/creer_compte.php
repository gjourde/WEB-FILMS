<?php

if (isset($_POST['email']) and isset($_POST['userName']) and isset($_POST['mdp1']) and isset($_POST['mdp2'])) {
    $userDao = new UserDAO();
    $user = $userDao->getUser($_POST["email"]);
    if ($user->getEmail() == $_POST["email"]) {
        //Le compte existe déjà
    } else {
        //test mdp1 = mdp2
        if ($_POST['mdp1'] != $_POST['mdp2']) {
            //erreur mdp1 != mdp2
        } else {
            //creation
            $newUser = new User(null, $_POST['userName'], $_POST['email'], $_POST['mdp2']);
        }
    }
} else {
    # code...
}
