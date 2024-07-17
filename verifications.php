<?php


function verifierIdentification($users){
    //les champs pseudo et passord sont remplis
    if (isset($_POST['pseudo']) && isset($_POST['password'])){
        //filtrer les inputs pour éviter script malveillant
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        //verif si le pseudo est d'un format valide dans ce cas le chercher dans la bdd
        if(strlen($pseudo) <= 20 && preg_match("/^[A-Za-zÀ-Öà-ö' -]+$/",$pseudo)){
            $userBdd= $users->findOne(['username'=>$_POST['pseudo']]);
            //si il est present dans la bdd et le mot de passe bon, l'utilisateur est redirigé à la page d'accueil
                if($userBdd){
                    $password_match = password_verify($password, $userBdd['password']);
                    if($password_match){
                        $_SESSION['username'] = $_POST['pseudo'];
                        $_SESSION['connect'] = true;
                        header('location:accueil.php');
                        exit();
                    }
                    else $_SESSION['message'] = 'mot de passe incorrect';
                    
                }
                else $_SESSION['message'] = "pseudo non existant veuillez le vérifier ou vous inscrire si vous ne l'êtes pas.";
            
        }
        else $_SESSION['message'] = 'pseudo non valide';
    }
    else if (!isset($_POST['pseudo']) && isset($_POST['validerUser'])){$_SESSION['message']= "Veuillez saisir un pseudo";}
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