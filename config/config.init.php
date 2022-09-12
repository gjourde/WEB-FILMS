<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Initialisation de la session
session_start();
header("Cache-Control: no-cache");

// Chargement Smarty et Defines
require 'config/' . 'defines.inc.php';
// Load Our autoloader
require 'Autoload.php';
require_once './view/web/tools/vendor/autoload.php';
// Specify our Twig templates location
$loader = new \Twig\Loader\FilesystemLoader('view');

// Instantiate our Twig
$twig = new \Twig\Environment(
    $loader
    //,[
    //     'cache' => '/path/to/compilation_cache',
    //]
);

Autoloader::register();
