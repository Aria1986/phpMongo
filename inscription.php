<?php

if(isset($_POST['password'])&& isset($_POST['pseudo'])){
    $userName = $_POST['pseudo'];
    $mdp = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $verifPseudo= strlen($userName) <= 20
        && preg_match("^[A-Za-z '-]+$",$userName);
    $verifPseudoExiste = $users->findOne(['username'=> $userName]);
    // si problème avec mot de passe envoyer message    
    if($mdp ==='false'){
        echo "erreur mot de passe, veuillez  resaisir";
        header ("location:form_inscription.php");
    }
    //si problème avec pseudo
    if($verifPseudo === 'false' || $verifPseudoExiste === 'true' ){
        echo'erreur pseudo veuillez saisir un pseudo inférieur à 20 caractères et ne pas utiliser de caractères spéciaux';
        header ("location:form_inscription.php");
    }
    //création d'un user dans la bdd
    else{$users->insertOne([
        'user' => $userName,
        'password' => $mdp,
    ]);
    header ("location:accueil.php");
    }
    
}
else{
    echo'Veuillez saisir votre pseudo et mot de passe';
    header ("location:form_inscription.php");
}
