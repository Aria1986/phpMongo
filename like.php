<?php
require_once 'config.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tweetId = $_POST['likeTweetId'];
    try {
        $updateResult =$collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($tweetId)],
            ['$inc' => ['likes' => 1]]
        );

        if ($updateResult->getModifiedCount() === 1) {
            echo "tweet updated!";
            header('location: accueil.php');
        }
        else{
            echo "aucun tweet correspondant n'a été trouvé";
        }
    }
    catch(MongoDB\Exception\UnsupportedException $e) {
        echo "Error: Unsupported MongoDB operation: " . $e->getMessage() . "\n";
    }
    
}





