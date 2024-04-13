<!DOCTYPE html>

<h1>Days Array</h1>
<body>


<?php
$days = array ("Sunday ", ", Monday ", ", Tuesday ", ", Wednesday ", ", Thursday ", ", Friday", ", Saturday");

echo "The Days of the week in English are: <br><br>";


foreach($days as $value){
    echo $value ;
}
?>

<h1></h1>

<?php
$days = array ("Dimanche ", ", Lundi ", ", Mardi ", ", Mercredi ", ", Jeudi", ", Vendredi ", ", Samedi");

echo "The Days of the week in French are: <br><br>";


foreach($days as $value){
    echo $value ;
}
?>

</body>
</html>