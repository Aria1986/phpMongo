<?php
session_start();
include 'config.php';
require 'verifications.php';

verifConnection();
use MongoDB\BSON\UTCDateTime;


$tweets = $collection->find([], [
    'sort' => ['timestamp' => -1], // Tri par date décroissante
]);

if (isset($_SESSION['message'])) {
    echo "<p class='alert alert-primary'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']); // Clear the message after displaying
}

$user = $users->findOne([],["username" => $_SESSION['username'] ]);

// if (isset($user['follows'])){
//     foreach($user['follows'] as $userFollowed){
//     if($userFollowed == tweet['user']) $verifFollowable= false;
//     else $verifFollowable= true; 
//     }
// }
// $userIsFollowed=$users->find(
//     ['_id' => new MongoDB\BSON\ObjectId($user['_id']),
//     'follows.user' =>['$nin' => [$tweet['user']]]
//     ] 
// );

ob_start();
?>
<!-- Ecrire son tweet -->
 <form action="creerTweet.php" class="py-4" method="POST" >
    <div>
        <label class="form-label mb-3" for="message">entrez votre message</label>
        <textarea type="text" name="message" class="form-control"></textarea>
    </div>
     <button class="btn btn-success m-2" type="submit">Envoyer tweet</button>
</form>
<!-- <?php verifTweet($collection);?> -->
        <!-- affichage de la liste des tweets -->
    <div class="ms-2 ms-sm-5 row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">    
        <?php foreach ($tweets as $tweet):
        // Vérifier si le rédacteur du tweet est follow 
        if (isset($user['follows'])){
            foreach($user['follows'] as $userFollowed){
            if($userFollowed['user'] == $tweet['user']) $verifFollowable= false;
            else $verifFollowable= true; 
            }
        }
        ?>
            <div class="card m-3" style="width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title"><?= $tweet['user']; ?></h5>
                        <?php if ($tweet['user'] != $_SESSION['username'] && $verifFollowable) : ?> 
                            <form action="follow.php" method="POST">
                                <input type="hidden" name="userFollowed" value="<?=$tweet['user'] ?>">
                                <input type="hidden" name="userId" value="<?=$user['_id'] ?>">
                                <button type="submit"><i class="fa-solid fa-user-plus"></i></button>
                            </form>
                        <?php endif ?> 
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $tweet['timestamp']->toDateTime()->format('Y-m-d H:i:s') ?></h6>
                    <!-- tweets modification possible seulement pour ses propres tweets -->
                    <div class="messages"><p class="card-text"><?= $tweet['message']; ?></p>   
                    <?php if ($tweet['user'] == $_SESSION['username']): ?>
                        <div  style="display:none;">
                        <form action="update_tweet.php" method="POST">
                            <input type="hidden" name="id" value="<?=$tweet['_id'] ?>">
                            <input  value="<?= $tweet['message']; ?>" name="nouveauTweet">
                            <button class="btn btn-light" type="submit">valider modif</button>
                        </form>
                        </div>
                    <?php endif ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <!-- likes -->
                        <form action='like.php' method='post'>
                            <input type="hidden" name="likeTweetId" value="<?= $tweet['_id'] ?>">
                            <?= isset($tweet['likes']) ? $tweet['likes'] :0 ?>
                            <button class="btn btn-light" type="submit"><i class="fa-solid fa-heart"></i></button>
                        </form>
                        <!-- delete                 -->
                        <?php if ($tweet['user'] == $_SESSION['username'] ||  isset($user['userRole']) && $user['userRole'] == 'moderator') : ?>
                            <form action='delete_tweet.php' method='post'>
                                <input type="hidden" name="deleteTweetId" value="<?= $tweet['_id'] ?>">
                                <button type="submit"> <i class="fa-solid fa-trash"></i></button>
                            </form>
                        <?php endif ?>
                        <!-- retweeter -->
                        <?php if($tweet['user'] != $_SESSION['username']) :?>
                            <form action='retweeter.php' method='post'>
                                <input type="hidden" name="tweetUser" value="<?= $tweet['user'] ?>">
                                <input type="hidden" name="tweetMsg" value="<?= $tweet['message'] ?>">                   
                                <button class="btn btn-light" type="submit"><i class="fa-regular fa-copy"></i></button>
                            </form>
                        <?php endif ?>
                    </div>
                    <!-- commentaires -->
                     <h5>Commentaires</h5>
                    <?php 
                        if(isset($tweet['comments'])):
                            foreach($tweet['comments']as $comment): ?>
                             <div class="bg-light p-2 rounded mb-1">  
                                <p><b><?= $comment['user'].' </b>'. $comment['timestamp']->toDateTime()->format('Y-m-d H:i').'</p>
                                <p>'. $comment['message'].'</p>
                            </div> ';            
                            endforeach;
                        endif; ?>
                    <form action='commenter.php' method='post'>
                        <input type="hidden" name="commentTweetId" value="<?= $tweet['_id'] ?>">
                        <textarea type="text" name="commentaire"  ></textarea>           
                        <button class="btn btn-success" type="submit">valider commentaire</button>
                    </form>
                </div>
            </div>                 
        <?php endforeach ?>  
    </div> 
   
<?php

$title = "Accueil";
$content = ob_get_clean();
include 'layout.php';