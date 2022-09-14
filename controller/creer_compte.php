<?php

if (isset($_POST['email']) and isset($_POST['mdp1']) and isset($_POST['mdp2'])) {
    $userDao = new UserDAO();
    $user = $userDao->getUser($_POST["email"]);
} else {
    # code...
}
