<?php
session_start();
if (isset($_SESSION["random_number"])) {
    echo "The random number was: " . $_SESSION["random_number"];
} else {
    echo "No game in progress.";
}
?>
<a href="guessinggame.php"><br>Back to Guessing Game</a>
