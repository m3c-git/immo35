<?php

// charge l'autoload de composer

use Symfony\Component\VarDumper\Cloner\Data;

require "vendor/autoload.php";

// charge le contenu du .env dans $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router = $router->handleRequest($_GET);


$User = new User("Ayyoub", "FRAIR", "10 rue de Rennes", "06 00 00 25 45", "test@test.com", "passpass");
$date = $User->getCreatedAt();
dump($date);
$User->setId(10);
dump($User);
