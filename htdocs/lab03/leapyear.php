<!DOCTYPE html>

<?php

if(is_numeric($_GET['year']) == 1){
	if((0 == $_GET['year'] % 4) & (0 != $_GET['year'] % 100) | (0 == $_GET['year'] % 400)){
		echo $_GET['year'] . " is a Leap Year."; 
	} else{
		echo $_GET['year'] . " is not a Leap Year."; 	
	}

} else {
	echo "Please enter a valid year"; 
}

?>

</html>