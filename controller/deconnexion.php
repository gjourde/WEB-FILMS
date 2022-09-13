<?php

session_destroy();
echo $twig->render('deconnexion.html.twig');
