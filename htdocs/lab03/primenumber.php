<!DOCTYPE html>

<?php

$num = $_GET['num'] ;

function primeCheck($num)
{
  if ($num == 1 || $num % 2 == 0) {
    return false;
  }

  for ($i = 3; $i <= sqrt($num); $i += 2) {
    if ($num % $i == 0) {
      return false;
    }
  }
  return true;
}



if (primeCheck($num)) {
  echo $num . " is a Prime";
} else {
  echo $num . " is not a Not Prime";
}

?>
</html>