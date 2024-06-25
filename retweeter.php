<?php
session_start();
include_once ('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $message = $_POST['tweetMsg'];
    $tweetUser = $_POST['tweetUser'];
    try {$updateResult = $collection->insertOne([
        'user' => $_SESSION['username'],
        'message' => $message,
        'original_user' => $tweetUser,
        'timestamp' => new MongoDB\BSON\UTCDateTime(),
        'retweet' => true  
    ],['w' => 1]);
        
    
        // 'writeConcern'=> { w: "majority"}
    
        if ($updateResult) {
            echo "tweet recreated!";
            header('location:accueil.php');
            exit();
        }  
        else{
            echo "aucun tweet correspondant n'a été trouvé";
        }
    }
    catch(MongoDB\Exception\UnsupportedException $e) {
        echo "Error: Unsupported MongoDB operation: " . $e->getMessage() . "\n";
    }
}