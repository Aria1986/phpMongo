<?php
session_start();
ob_start();
?>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <h5 class="card-title">nom utilisateur</h5>
      <form action="follow.php" method="POST">
            <input type="hidden" name="userFollowed" >
            <input type="hidden" name="userId" >
            <button type="submit"><i class="fa-solid fa-user-plus"></i></button>
        </form> 
    </div>
    <h6 class="card-subtitle mb-2 text-muted">date</h6>
    <p class="card-text">tweet text nd make up the bulk of the card's content.</p>
    <form action="update_tweet.php" method="POST">
          <input type="hidden" name="id" >
          <input class="form-control"  name="nouveauTweet">
          <button class="btn bg-primary m-2" type="submit">valider modif</button>
    </form> 
    <div class="d-flex justify-content-between">
        <!-- likes -->
      <form action='like.php' method='post'>
                              <input type="hidden" name="likeTweetId" >  
                              <button class="btn btn-light" type="submit"><i class="fa-solid fa-heart"></i></button>
                          </form>
        <!-- delete                 -->
        <form action='delete_tweet.php' method='post'>
            <input type="hidden" name="deleteTweetId" >
            <button class="btn btn-light" type="submit"> <i class="fa-solid fa-trash"></i></button>
        </form>
          <!-- retweet -->
        <form action='retweeter.php' method='post'>
                              <input type="hidden" name="tweetUser" >
                              <input type="hidden" name="tweetMsg" >                   
                              <button class="btn btn-light" type="submit"><i class="fa-regular fa-copy"></i></button>
                          </form>
    </div>
  </div>
</div>


<!-- nom utilisateur</th>
            <th scope="col">tweet</th>
            <th scope="col">date</th>
            <th scope="col">Supprimer</th>
            <th scope="col">like</th>
            <th scope="col">retweeter</th>
            <th scope="col">Commentaires</th -->

<?php
$title = "View test";
$content = ob_get_clean();
include 'layout.php';