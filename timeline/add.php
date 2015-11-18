<?php
    # Ex 4 : Write a tweet
    require_once("timeline.php");
    $timeline = new TimeLine();
    try {
        $content = htmlspecialchars($_POST['content']);
        $regex = "/^([a-zA-Zㄱ-ㅎ가-힣] |[a-zA-Zㄱ-ㅎ가-힣]-|[a-zA-Zㄱ-ㅎ가-힣]){0,19}[a-zA-Zㄱ-ㅎ가-힣]$/";
        if (preg_match($regex, $_POST['author'])){
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
