
<?php
if (isset($_SESSION['email'])) {
    if (isset($_GET['id'])) {
        session_destroy();
        header('location:connexion');
    } else {
        echo $twig->render('connexion.html.twig', ['status' => 'dejaCo']);
    }
    echo "déjà connecter";
} else {
    if (isset($_POST["email"]) and isset($_POST["mdp"])) {
        $userDao = new UserDAO();
        $user = $userDao->getUser($_POST["email"]);
        if ($user != null) {
            $userName = $user->getUserName();
            $email = $user->getEmail();
            $mdp = $user->getPassword();
            $id = $user->getIdUser();

            echo $email . " " . $mdp . "<br>";
            echo $_POST["email"] . " " . $_POST["mdp"] . "<br>";

            if (($email == $_POST["email"]) && ($mdp == $_POST["mdp"])) {
                echo "ok";
                $_SESSION['email'] = $email;
                $_SESSION['userName'] = $userName;
                $_SESSION['idUser'] = $id;
                if (isset($_POST["remember"])) {
                    setcookie("cookieEmail", $email);
                }
                header('location:affichageFilms');
            } else {
                echo $twig->render('connexion.html.twig', ['mdp' => 'true']);
                echo "pas ok";
            }
        } else {
            echo $twig->render('connexion.html.twig', ['mdp' => 'true']);
            echo "pas ok";
        }
    } else {
        if (isset($_COOKIE["cookieEmail"])) {
            echo $twig->render('connexion.html.twig', ['email' => $_COOKIE["cookieEmail"]]);
        } else {
            echo $twig->render('connexion.html.twig');
        }
        echo "connexion";
    }
}
