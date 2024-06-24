<?php
require_once 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tweetId= $_POST['deleteTweetId'];
   try {
        $deleteResult =$collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($tweetId)]);
        if ($deleteResult->getDeletedCount() === 1)  {
            echo "Quizz deleted!";
            header('location: index.php');
        }
        else {
            echo "aucun tweet correspondant n'a été trouvé";
        }
    } 
    catch (MongoDB\Exception\UnsupportedException $e) {
        echo "Error: Unsupported MongoDB operation: " . $e->getMessage() . "\n";
    }
}