
<?php

if (isset($_POST["email"]) and isset($_POST["mdp"])) {
    $UserDao = new UserDAO();
    $User = $UserDAO->getUser($_POST["email"]);
} else {
    # code...
}
