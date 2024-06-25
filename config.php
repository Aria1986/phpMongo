<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->mini_x->tweets;

 //  Si la personne n'est pas connectée, on la renvoie sur la page d'authentification.
 if (!$_SESSION['connect']) {
    header("location:index.php");
    exit();
    }
    // On vérifie si on a cliqué sur le bouton "Se Déconnecter" :
    if (isset($_POST['sortir'])) {
    // Si oui, on supprime la session :
    session_destroy();
        echo "session destroy";
    // Puis on redirige vers la page d'authentification
    header("location:index.php");
    exit();
    }