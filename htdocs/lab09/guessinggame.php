<html>
<h1> Guessing Game! </h1>
<?php


session_start();


if (!isset($_SESSION["guess_count"])) {
    $_SESSION["guess_count"] = 0;
}


if (!isset($_SESSION["random_number"])) {
    $_SESSION["random_number"] = rand(1, 100);
}

$random_number = $_SESSION["random_number"];
$guess_count = $_SESSION["guess_count"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["guess"]) && is_numeric($_POST["guess"])) {
        $user_guess = intval($_POST["guess"]);
        $guess_count++;

        if ($user_guess == $random_number) {
            echo "Congratulations! You guessed the correct number: $random_number<br>";
            echo "Total guesses: $guess_count";
            session_unset();
        } elseif ($user_guess < $random_number) {
            echo "Your guess is too low.<br>";
        } else {
            echo "Your guess is too high.<br>";
        }
    } else {
        echo "Please enter a valid numeric guess.<br>";
    }
}

?>

<form method="post">
    Enter your guess (1-100): <input type="text" name="guess">
    <input type="submit" value="Submit">
</form>

<a href="giveup.php">Give Up</a> | <a href="startover.php">Start Over</a>

</html>