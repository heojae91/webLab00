<?php
# Ex 5 : Delete a tweet
require_once("timeline.php");
$timeline = new TimeLine();
try {
	$timeline->delete($_POST['no']);
    header("Location:index.php");
} catch(Exception $e) {
    header("Loaction:error.php");
}
?>
