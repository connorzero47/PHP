<?php
$a = "strgr";


if (is_numeric($a)) {
	echo $a . " after rounding up is " . round($a) ."<br>". "The variable " . round($a) ." is numeric" . "<br>";
	if(round($a) % 2 == 0){
        echo round($a). " is an Even number"; 
    }
    else{
        echo round($a). " is an Odd number";
    }
	
}else {
    echo  "The variable $a is NOT numeric";
}



?>