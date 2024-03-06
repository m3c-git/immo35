<?php

session_start();

// charge l'autoload de composer
use Symfony\Component\VarDumper\Cloner\Data;
require "vendor/autoload.php";


if(!isset($_SESSION["csrf-token"]))
{
    $tokenManager = new CSRFTokenManager();
    $token = $tokenManager->generateCSRFToken();
    $_SESSION["csrf-token"] = $token;
    dump($token);
}


// charge le contenu du .env dans $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

date_default_timezone_set('Europe/Paris');
$router = new Router();
$router = $router->handleRequest($_GET);


