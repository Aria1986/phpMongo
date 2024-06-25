<?php
session_start();
include_once ('config.php');
require 'verifications.php';

verifConnection();
use MongoDB\BSON\UTCDateTime;


$tweets = $collection->find([], [
    'sort' => ['timestamp' => -1], // Tri par date décroissante
]);


$user = $users->findOne(["username" => $_SESSION['username'] ]);

if (isset($user) && isset($user['userRole'])) echo $user['userRole'];
else echo"pas de role";

ob_start();
?>

    <table class="table">
    <thead>
        <tr>
            <th scope="col">nom utilisateur</th>
            <th scope="col">tweet</th>
            <th scope="col">date</th>
            <th scope="col">Supprimer</th>
            <th scope="col">like</th>
            <th scope="col">retweeter</th>
        </tr>
        <!-- affichage de la liste des tweets -->
        <?php foreach ($tweets as $tweet):?>
        <tr>
                    <th scope="row"><?= $tweet['user']; ?></th>
                    <td class="messages"><p><?= $tweet['message']; ?></p>
                    <!-- tweets modification possible seulement pour ses propres tweets -->
                    <div id="tweet <?= $tweet['_id'] ?>" style="display:none;"> 
                    <?php if ($tweet['user'] == $_SESSION['username']): ?>
                        <form action="update_tweet" method="POST">
                            <input type="hidden" name="id" value="<?=$tweet['_id'] ?>">
                            <input  value="<?= $tweet['message']; ?>" name="nouveauTweet">
                            <button type="submit">valider modif</button>
                        </form>
                    <?php endif ?>
                    </div>
                    </td>

                    <td><?= $tweet['timestamp']->toDateTime()->format('Y-m-d H:i:s'); ?></td>
                    <!-- suppression tweets -->
                    <?php if ($tweet['user'] == $_SESSION['username'] || $user['userRole'] == 'moderator') : ?>
                        <td class='border px-2 py-1'>
                            <form action='delete_tweet.php' method='post'>
                                <input type="hidden" name="deleteTweetId" value="<?= $tweet['_id'] ?>">
                                <button class="btn btn-light" type="submit"> <i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif ?>
                    <!-- likes -->
                    <td class='border px-2 py-1'>
                        <form action='like.php' method='post'>
                            <input type="hidden" name="likeTweetId" value="<?= $tweet['_id'] ?>">
                            <?= isset($tweet['likes']) ? $tweet['likes'] :0 ?>
                            <button class="btn btn-light" type="submit"><i class="fa-solid fa-heart"></i></button>
                        </form>
                    </td>    
                    <!-- retweet -->
                   <?php if($tweet['user'] != $_SESSION['username']) :?>
                    <td class='border px-2 py-1'>
                        <form action='retweeter.php' method='post'>
                            <input type="hidden" name="tweetUser" value="<?= $tweet['user'] ?>">
                            <input type="hidden" name="tweetMsg" value="<?= $tweet['message'] ?>">                   
                            <button class="btn btn-light" type="submit"><i class="fa-regular fa-copy"></i></button>
                        </form>
                    </td> 
                    <?php else:?>
                        <td></td>    
                    <?php endif ?>
                    <!-- commentaires -->
                    <td>
                        <?php 
                        if(isset($tweet['comments'])):
                            foreach($tweet['comments']as $comment): ?>
                                
                            <p><?= $comment['message']?></p>
                            <?php 
                            endforeach;
                        endif; ?>
                    <form action='commenter.php' method='post'>
                        <input type="hidden" name="commentTweetId" value="<?= $tweet['_id'] ?>">
                        <textarea type="text" name="commentaire"  ></textarea>           
                        <button class="btn btn-light" type="submit">valider commentaire</button>
                    </form>
                    </td>
        </tr>
        <?php endforeach ?>  
    </thead>
    <tbody>
     </table>
    <form action="#" class="py-4" method="POST" >
        <!-- <div>
            <label class="form-label mb-3" for="username">entrez votre nom</label>
            <input type="text" name="username" class="form-control">
        </div> -->
        <div>
            <label class="form-label mb-3" for="message">entrez votre message</label>
            <textarea type="text" name="message" class="form-control"></textarea>
        </div>
        <button type="submit">Envoyer tweet</button>
    </form>
<?php
verifTweet($collection);
$title = "Accueil";
$content = ob_get_clean();
include 'layout.php';