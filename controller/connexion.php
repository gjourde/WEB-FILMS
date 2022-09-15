
<?php
//Contrôle la presence d'un session ouverte
if (isset($_SESSION['email'])) {
    if (isset($_GET['id'])) {
        //Ferme le session si déconnection
        session_destroy();
        header('location:connexion');
    } else {
        //Render avec le message déja connecté
        echo $twig->render('connexion.html.twig', ['status' => 'dejaCo']);
    }
} else {
    //Contrôle la presence le login et le mdp
    if (isset($_POST["email"]) and isset($_POST["mdp"])) {
        $userDao = new UserDAO();
        $user = $userDao->getUser($_POST["email"]);
        // Si l'utilisateur n'existe pas on peut le créer
        if ($user != null) {
            $userName = $user->getUserName();
            $email = $user->getEmail();
            $mdp = $user->getPassword();
            $id = $user->getIdUser();

            //Vérification du login et mdp
            if (($email == $_POST["email"]) && ($mdp == $_POST["mdp"])) {
                //Création de la session
                $_SESSION['email'] = $email;
                $_SESSION['userName'] = $userName;
                $_SESSION['idUser'] = $id;
                //Création de cookie en fonction du [ ] remember me
                if (isset($_POST["remember"])) {
                    setcookie("cookieEmail", $email);
                }
                //Rafraichi le page pour la mise à jour du header
                header('location:affichageFilms');
            } else {
                //Render avec le message mot de passe incorrecte
                echo $twig->render('connexion.html.twig', ['mdp' => 'true']);
            }
        } else {
            //Render avec le message déja connecté
            echo $twig->render('connexion.html.twig', ['mdp' => 'true']);
        }
    } else {
        //Render du formulaire de connection en fonction du cookie
        if (isset($_COOKIE["cookieEmail"])) {
            echo $twig->render('connexion.html.twig', ['email' => $_COOKIE["cookieEmail"]]);
        } else {
            echo $twig->render('connexion.html.twig');
        }
    }
}
