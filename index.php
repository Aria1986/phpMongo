<?php
require_once 'config.php';

use MongoDB\BSON\UTCDateTime;

if($_POST){
    $userName=$_POST['username'];
    $message=$_POST['message'];
    $collection->insertOne([
        'user' => $userName,
        'message' => $message,
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);
}

$tweets = $collection->find([], [
    'sort' => ['timestamp' => -1], // Tri par date décroissante
]);






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- lien fontawesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- lien bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Tweets</title>
</head>
<body>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">nom utilisateur</th>
            <th scope="col">tweet</th>
            <th scope="col">date</th>
            <th scope="col" colspan="2">Modifications</th>
        </tr>
        <?php foreach ($tweets as $tweet):?>
        <tr>
                    <th scope="row"><?= $tweet['user']; ?></th>
                    <td class="messages"><p><?= $tweet['message']; ?></p>
                    <div id="tweet<?= $tweet['_id'] ?>" style="display:none;"> 
                        <form action="update_tweet" method="POST">
                            <input type="hidden" name="id" value="<?=$tweet['_id'] ?>">
                            <input  value="<?= $tweet['message']; ?>" name="nouveauTweet">
                            <button type="submit">valider modif</button>
                        </form>
                    </div>
                    </td>

                    <td><?= $tweet['timestamp']->toDateTime()->format('Y-m-d H:i:s'); ?></td>
                    <td class='border px-2 py-1'>
                        <form action='delete_tweet.php' method='post'>
                            <input type="hidden" name="deleteTweetId" value="<?= $tweet['_id'] ?>">
                            <button class="btn btn-light" type="submit"> <i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    <td class='border px-2 py-1'>
                        <form action='form_update_tweet.php' method='post'>
                            <input type="hidden" name="updateTweetId" value="<?= $tweet['_id'] ?>">
                            <button class="btn btn-light" type="submit"><i class="fa-solid fa-pen"></i></button>
                        </form>
                    </td>
        </tr>
        <?php endforeach ?>  
    </thead>
    <tbody>
     </table>
    <form action="#" class="py-4" method="POST" >
        <div>
            <label class="form-label mb-3" for="username">entrez votre nom</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div>
            <label class="form-label mb-3" for="message">entrez votre message</label>
            <textarea type="text" name="message" class="form-control"></textarea>
        </div>
        <button type="submit">Envoyer tweet</button>
    </form>
    <script src="index.js"></script>
</body>
</html>