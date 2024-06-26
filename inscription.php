<?php

if(isset($_POST['password'])&& isset($_POST['pseudo'])){
    $userName = $_POST['pseudo'];
    $mdp = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $verifPseudo= strlen($userName) <= 20
        && preg_match("^[A-Za-z '-]+$",$userName);
    if($mdp ==='false'){
        echo "erreur mot de passe, veuillez  resaisir";
    }
    if($verifPseudo === 'false'){
        echo'erreur pseudo veuillez saisir un pseudo inférieur à 20 caractères et ne pas utiliser de caractères spéciaux';
    }
    else{$users->insertOne([
        'user' => $userName,
        'password' => $mdp,
    ]);
    }
    header ("location:accueil.php");
}
else{
    echo'Veuillez saisir votre pseudo et mot de passe';
    header ("location:accueil.php");
}
