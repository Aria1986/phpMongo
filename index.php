<?php
// $_SESSION['connect']=false;
session_start();
require 'verifications.php';

// function verifierPseudo(){
//     if (isset($_POST['pseudo'])){
//         $_SESSION['username'] = $_POST['pseudo'];
//         $_SESSION['connect'] = true;
//         echo"pseudo ok";
//         header('location:accueil.php');
//         exit();
//     }
//     else if (!isset($_POST['pseudo']) && isset($_POST['validerPseudo'])){echo "Veuillez saisir un pseudo";}
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <input type="text" id="pseudo" class ="champ_form" name="pseudo" required placeholder="Écrivez votre pseudo ici" > <br>
    <input type="submit"class="bg-primary p-2 col-xl-3 col-sm-6 rounded text-uppercase" name="validerPseudo" value=Entrer></a>
</form>
<?php verifierPseudo(); ?>
    
</body>
</html>