<?php
include 'config.php';

function verifierPseudo($users){
    if (isset($_POST['pseudo'])){
        $users=
        $userBdd= $users->findOne(['username'=>$_POST['pseudo']]);
        $_SESSION['username'] = $_POST['pseudo'];
        $_SESSION['connect'] = true;
        echo"pseudo ok";
        header('location:accueil.php');
        exit();
    }
    else if (!isset($_POST['pseudo']) && isset($_POST['validerUser'])){echo "Veuillez saisir un pseudo";}
}

function verifConnection(){
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
}


function verifTweet($collection){
    if(isset($_POST['message'])){
        $userName = $_SESSION['username'];
        $message = $_POST['message'];
        $collection->insertOne([
            'user' => $userName,
            'message' => $message,
            'timestamp' => new MongoDB\BSON\UTCDateTime()
        ]);
    }
}