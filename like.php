<?php

$collection->updateOne(
    ['_id' => new MongoDB\\BSON\\ObjectId($tweetId)],
    ['$inc' => ['likes' => 1]]
);