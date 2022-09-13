
<?php

if (isset($_SESSION["email"]) and isset($_SESSION["mdp"])) {
    include _CTRL_ . 'connexion.php';
} else {
    include _CTRL_ . 'connexion.php';
}
