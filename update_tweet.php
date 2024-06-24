<?php
require_once 'config.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tweetId = $_POST['id'];
    $newMessage= $_POST['nouveauTweet'];
    try {
        $updateResult =$collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($tweetId)],
        ['$set' => ['message' => $newMessage]]);

        if ($updateResult->getModifiedCount() === 1) {
            echo "tweet updated!";
            header('location: index.php');
        }
        else{
            echo "aucun tweet correspondant n'a été trouvé";
        }
    }
    catch(MongoDB\Exception\UnsupportedException $e) {
        echo "Error: Unsupported MongoDB operation: " . $e->getMessage() . "\n";
    }
    
}

