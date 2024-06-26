
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo "<p class='alert alert-primary'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']); // Clear the message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container col-10 col-sm-5 m-auto p-5 text-center">
    <form action="inscription.php" method="POST">
        <div>
            <h2>Inscription</h2>
            <label class="form-label" for="pseudo">Pseudo</label>
            <input type="text" id="pseudo"  class ="form-control" name="pseudo" required placeholder="Écrivez votre pseudo ici" > 
        </div>
        <div>
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" id="password" class ="form-control" name="password" required placeholder="XXXX" > 
        </div>
        <input type="submit" class="bg-primary px-2 rounded text-uppercase m-2" name="validerUser" value=Valider></a>
    </form>
</div>
</body>
</html>