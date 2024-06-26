<?php
session_start();
include 'config.php';

if(isset($_POST['message'])){
    $userName = $_SESSION['username'];
    $message = $_POST['message'];
    $collection->insertOne([
        'user' => $userName,
        'message' => $message,
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);
    header('location:accueil.php');
}