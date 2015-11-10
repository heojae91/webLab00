<!DOCTYPE html>
<?php
require_once("timeline.php");
$timeline = new TimeLine();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Simple Timeline</title>
        <link rel="stylesheet" href="timeline.css">
    </head>
    <body>
        <div>
            <a href="index.php"><h1>Simple Timeline</h1></a>
            <div class="search">
                <!-- Ex 3: Modify forms -->
                <form method="GET" class="search-form" action="index.php">
                    <input type="submit" value="search">
                    <input type="text" placeholder="Search" name="contents">
                    <select name="type">
                        <option>Author</option>
                        <option>Content</option>
                    </select>
                </form>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <!-- Ex 3: Modify forms -->
                    <form method="POST" class="write-form" action="add.php">
                        <input type="text" placeholder="Author" name="author">
                        <div>
                           <input type="text" placeholder="Content" name="content">
                        </div>
                        <input type="submit" value="write">
                    </form>
                </div>
                <!-- Ex 3: Modify forms & Load tweets -->
                <?php
                if (isset($_GET['contents']) && !$_GET['contents']=="") {
                    $_GET['contents'] = htmlspecialchars($_GET['contents']);
                    $_GET['contents'] = preg_replace("/'/", "&#39", $_GET['contents']);
                    $rows = $timeline->searchTweets($_GET['type'], $_GET['contents']);
                } else {
                    $rows = $timeline->loadTweets();
                }
                foreach($rows as $row) { ?>
                <div class="tweet">
                    <form method="POST" class="delete-form" action="delete.php">
                        <input type="submit" value="delete">
                        <?php
                        print("<input type=\"hidden\" name=\"no\" value=\"$row[no]\">"); ?>
                    </form>
                    <div class="tweet-info">
                    <?php
                        print ("<span> $row[author] </span>");
                        print ("<span>".date('H:i:s Y/m/d', strtotime($row['time']))."</span>");
                    ?>
                    </div>
                    <div class="tweet-content">
                    <?php
                        $row= preg_replace("/#([ㄱ-ㅎ가-힣A-Za-z0-9\/\_]*)/", "<a href=\"/index.php?contents=%23$1&type=Content\">#$1</a>", $row['contents']);
                        print $row;
                    ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>
