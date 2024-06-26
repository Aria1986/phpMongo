<?php
session_start();
include_once ('config.php');


if($_SERVER["REQUEST_METHOD"] == "POST"){
    var_dump($_POST);
    $userFollowed = $_POST['userFollowed'];
    $userId = $_POST['userId'];
    try {
        $updateResult=$collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($userId)],
            ['$push' => ['follows' => 
                ['user' => $userFollowed]
            ]]
            );
        if($updateResult->getModifiedCount() === 1){
            echo $userFollowed.'add to user followed';
            header('location:accueil.php');
            exit();
        }
        else{
            echo "aucun utilisateur correspondant n'a été trouvé";
        }
    }
    catch(MongoDB\Exception\UnsupportedException $e){
        echo "Error: Unsupported MongoDB operation:". $e->getMessage()."\n";
    }
}