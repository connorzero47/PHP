<?php
require_once("hitcounter.php");
$connectionDetails = require_once("/home/students/accounts/s104348322/cos30020/www/data/lab10/mykeys.inc.php");

$Counter = new HitCounter($connectionDetails['host'], $connectionDetails['user'], $connectionDetails['pswd'], $connectionDetails['dbnm'], "hitcounter");

$hits = $Counter->getHits();
$Counter->setHits();

echo "Total Hits: {$hits}";

$Counter->closeConnection();
?>

<html>
<br><br>
<a href="startover.php">Reset</a>

</html>