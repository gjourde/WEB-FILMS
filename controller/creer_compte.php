<?php

if (isset($_POST['email']) and isset($_POST['userName']) and isset($_POST['mdp1']) and isset($_POST['mdp2'])) {
    $userDao = new UserDAO();
    $user = $userDao->getUser($_POST["email"]);
    if ($user == null) {
        //test mdp1 = mdp2
        if ($_POST['mdp1'] != $_POST['mdp2']) {
            echo $twig->render('creer_compte.html.twig', ['status' => "mdp"]);
        } else {
            //creation
            $newUser = new User(null, $_POST['userName'], $_POST['email'], $_POST['mdp1']);
            $userDao->add($newUser);
            echo $twig->render('creer_compte.html.twig', ['query' => "ok"]);
        }
    } else {
        echo $twig->render('creer_compte.html.twig', ['status' => "deja"]);
    }
} else {
    echo $twig->render('creer_compte.html.twig');
}
