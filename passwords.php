<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$users = $client->mini_x->users;
$password= password_hash('password',PASSWORD_DEFAULT);
$users->updateMany([],['$set' =>['password'=>$password]]);
// $users->updateMany([],['$unset' =>['password'=>1]]);
echo'passwords ok';



