<?php
session_start();
include 'config.php';
if(isset($_POST['password'])&& isset($_POST['pseudo'])){
    $userName = $_POST['pseudo'];
    //verification de la validité du mot de passe
    if(!strlen($_POST['password'])>=8 || !preg_match("/^[A-Za-zÀ-Öà-ö' -]+$/",$_POST['password']) ){
        $isValid = false;
        $_SESSION['message']="mot de passe incorrect, veuillez resaisir un mdp de 8caractères minimum ";
        
    }
    if (!preg_match("/[0-9]+/", $password)) {
        $isValid = false;
        $_SESSION['message'] = "Le mot de passe doit contenir au moins un chiffre.";
    }

    // Check for at least one uppercase letter
    if (!preg_match("/[A-Z]+/", $password)) {
        $isValid = false;
        $_SESSION['message'] = "Le mot de passe doit contenir au moins une lettre majuscule.";
    }

    // Check for at least one lowercase letter
    if (!preg_match("/[a-z]+/", $password)) {
        $isValid = false;
        $_SESSION['message'] = "Le mot de passe doit contenir au moins une lettre minuscule.";
    }

    // Check for special characters (optional)
    // $pattern = "/^[A-Za-zÀ-Öà-ö' -@#$%^&*()_+{}|:\";'<>\[\]\/?]+/";
    // if (!preg_match($pattern, $password)) {
    //     $isValid = false;
    //     $errorMessage[] = "Le mot de passe doit contenir au moins un caractère spécial.";
    // }

    if (!$isValid) {
        echo "Le mot de passe n'est pas valide. Veuillez en choisir un autre.\n";
        echo implode("\n", $errorMessage);
        header('location:form_inscription.php');
    } else {
        $mdp = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }



    $verifPseudo= strlen($userName) <= 20
        && preg_match("/^[A-Za-zÀ-Öà-ö' -]+$/",$userName);
    $verifPseudoExiste = $users->findOne(['username'=> $userName]);
    // si problème avec mot de passe envoyer message    
    if(! isset($mdp)){
        header ("location:form_inscription.php");
         $_SESSION['message']="erreur mot de passe, veuillez resaisir un mdp de plus de 8 caractères et contenir que des lettres, des apostrophes et des tirets.";
        }
    //si problème avec pseudo
    elseif(isset($verifPseudoExiste) || $verifPseudo == false ){  
        // header ("location:form_inscription.php");
        $_SESSION['message']= "erreur pseudo déjà utilisé ou incorrect veuillez saisir un autre pseudo (sans caractères spéciaux et <20 caractères).";
        header ("location:form_inscription.php");
    }
    //création d'un user dans la bdd
    elseif(isset($mdp) && $verifPseudo == true){
        $users->insertOne([
        'username' => $userName,
        'password' => $mdp,
    ]);
    header ("location:index.php");
    $_SESSION['message']="inscription réussi!";  
    }
    else{
        $_SESSION['message']= (string)$verifPseudo.' pseudo existe: '.isset($verifPseudoExiste).'mdp hasshe'.$mdp;
        header ("location:form_inscription.php");
       
    }
}
else{
    echo'Veuillez saisir votre pseudo et mot de passe';
    header ("location:form_inscription.php");
}
