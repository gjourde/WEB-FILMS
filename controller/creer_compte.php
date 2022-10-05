<?php
//Contrôle la présence des champ du formulaire
if (isset($_POST['email']) and isset($_POST['userName']) and isset($_POST['mdp1']) and isset($_POST['mdp2'])) {
    $userDao = new UserDAO();
    $user = $userDao->getUser($_POST["email"]);
    //Si l'utilisateur n'existe pas déjà on test les champ mdp1 == mdp2
    if ($user == null) {
        //test mdp1 = mdp2
        if ($_POST['mdp1'] != $_POST['mdp2']) {
            //Render avec le message champ mdp pas identique
            echo $twig->render('creer_compte.html.twig', ['status' => "mdp"]);
        } else {
            //Creation du nouveau compte et ajout en bdd
            $newUser = new User(null, $_POST['userName'], $_POST['email'], password_hash($_POST['mdp1'], PASSWORD_DEFAULT));
            $userDao->add($newUser);
            //Render avec le message compte créer
            echo $twig->render('creer_compte.html.twig', ['query' => "ok"]);
        }
    } else {
        //Render avec le message compte existe déjà
        echo $twig->render('creer_compte.html.twig', ['status' => "deja"]);
    }
} else {
    //Render avec le formulaire
    echo $twig->render('creer_compte.html.twig');
}
