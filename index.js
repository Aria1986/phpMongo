let tweets = document.querySelectorAll('.messages');
console.log("hello");
tweets.forEach(tweet => {
    tweet.addEventListener("click", (e) => {
        divTweet=tweet.querySelector('div');
        if(divTweet.style.display == 'none'){
            divTweet.style.display = 'block'
        }
        else{
             divTweet.style.display = 'none';
        }

    })
});
