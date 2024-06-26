<?php
session_start();
include_once ('config.php');


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $commentMessage = $_POST['commentaire'];
    $tweetId= $_POST['commentTweetId'];

    try {
        $updateResult =$collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($tweetId)],
        ['$push' => ['comments' => [
            'user' => $_SESSION['username'],
            'message' => $commentMessage,
            'timestamp' => new MongoDB\BSON\UTCDateTime()
        ]]]
        );
        if ($updateResult->getModifiedCount() === 1) {
            echo "comment upload!";
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