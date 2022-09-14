<?php

if (isset($_POST['email']) and isset($_POST['userName']) and isset($_POST['mdp1']) and isset($_POST['mdp2'])) {
    $userDao = new UserDAO();
    $user = $userDao->getUser($_POST["email"]);
    if ($user->getEmail() == $_POST["email"]) {
        echo $twig->render('creer_compte.html.twig', ['status' => "true"]);
    } else {
        //test mdp1 = mdp2
        if ($_POST['mdp1'] != $_POST['mdp2']) {
            //erreur mdp1 != mdp2
        } else {
            //creation
            $newUser = new User(null, $_POST['userName'], $_POST['email'], $_POST['mdp1']);
            $userDao->add($newUser);
            //render-> add user ok
        }
    }
} else {
    //render-> form
}
