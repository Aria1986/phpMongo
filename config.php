<?php
require 'vendor/autoload.php';
// connection à la bdd mongodb
$client = new MongoDB\Client("mongodb://localhost:27017");

// recherche de la collection tweets dans la bdd mini_x
$collection = $client->mini_x->tweets;
if(!$collection){
    throw new Exception ('failed to retrieve tweets from mini_x');
}
// recherche de la collection users dans la bdd mini_x
$users = $client->mini_x->users;
if (!$users) {
    throw new Exception('Failed to retrieve users from mini_x');
}