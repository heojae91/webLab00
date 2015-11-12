<?php
    # Ex 4 : Write a tweet
    require_once("timeline.php");
    $timeline = new TimeLine();
    try {
        $content = htmlspecialchars($_POST['content']);
        $regex = "/^([a-zA-Z] |[a-zA-Z]-|[a-zA-Z]){0,19}[a-zA-Z]$/";
        $contentRegex = "/^ +/";
        $quote = "/'/";
        $content = preg_replace($quote, "", $content); // quote를 없애버림 
        if (preg_match($regex, $_POST['author']) && $content != "" && !preg_match($contentRegex, $content)) { //validate author & content
            $tweet = array();
            array_push($tweet, $_POST['author']);
            array_push($tweet, $content);
            $timeline->add($tweet);
            header("Location:index.php"); // redirect to index.php
        } else {
            header("Location:error.php");
        }
    } catch(Exception $e) {
        header("Location:error.php");
    }
?>
