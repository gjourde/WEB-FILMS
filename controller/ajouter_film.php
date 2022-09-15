<?php

// Controller pour l'ajout d'un nouveau film //
if (isset($_SESSION['email'])) {
    if (isset($_POST['titre']) and isset($_POST['realisateur']) and isset($_POST['affiche']) and isset($_POST['annee'])) {
        $filmsDao = new FilmsDAO();
        $film = new Films(null, $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);
        $status = $filmsDao->add($film);
        if ($status) {
            $film = $filmsDao->lastRowFilm();
            //On affiche le template Twig correspondant
            for ($i = 1; $i < $_POST['nbRole']; $i++) {
                $acteur = $filmsDao->getActeurBy($_POST['saisieNom' . $i], $_POST['saisiePrenom' . $i]);
                if ($acteur == null) {
                    $acteur = new Acteurs(null, $_POST['saisieNom' . $i], $_POST['saisiePrenom' . $i]);
                    $id = $filmsDao->addActeur($acteur);
                    $acteur->setIdActeur($id);
                }
                $roles[] = new Role($acteur, $film->getIdFilm(), $_POST['saisiePersonnage' . $i], null);
            }
            foreach ($roles as  $role) {
                $filmsDao->addRole($role);
            }
            echo $twig->render('ajouter_film.html.twig', ['status' => "Ajout du Film confirmé ", 'films' => $film]);
        } else {
            echo $twig->render('ajouter_film.html.twig', ['status' => "Erreur Dans l'ajout du Film"]);
        }
    } else {
        echo $twig->render('ajouter_film.html.twig');
    }
} else {
    header('location:connexion');
}
