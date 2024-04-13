<?php
require_once("hitcounter.php");
$connectionDetails = require_once("/home/students/accounts/s104348322/cos30020/www/data/lab10/mykeys.inc.php");

$Counter = new HitCounter($connectionDetails['host'], $connectionDetails['user'], $connectionDetails['pswd'], $connectionDetails['dbnm'], "hitcounter");

$Counter->startOver();

$Counter->closeConnection();
?>

<html>
<h1>Reset Done!</h1>

<a href="countvisits.php">Back to Hit Counter Page</a>

</html>
