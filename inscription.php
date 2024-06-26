<?php
session_start();
include 'config.php';
if(isset($_POST['password'])&& isset($_POST['pseudo'])){
    $userName = $_POST['pseudo'];
    $mdp = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $verifPseudo= strlen($userName) <= 20
        && preg_match("^[A-Za-z '-]+$",$userName);
    $verifPseudoExiste = $users->findOne(['username'=> $userName]);
    // si problème avec mot de passe envoyer message    
    if($mdp ==='false'){
        header ("location:form_inscription.php");
         $_SESSION['message']="erreur mot de passe, veuillez resaisir.";
    }
    //si problème avec pseudo
    if($verifPseudo === 'false' || $verifPseudoExiste === 'true' ){  
        // header ("location:form_inscription.php");
         $_SESSION['message']="erreur pseudo déjà utilisé ou incorrect veuillez saisir un autre pseudo (sans caractères spéciaux et <20caaractères).";
    }
    //création d'un user dans la bdd
    else{$users->insertOne([
        'username' => $userName,
        'password' => $mdp,
    ]);
    header ("location:index.php");
    $_SESSION['message']="inscription réussi!";  
    }
    
}
else{
    echo'Veuillez saisir votre pseudo et mot de passe';
    header ("location:form_inscription.php");
}
