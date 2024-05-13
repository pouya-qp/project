<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "yogaproject";

$link = mysqli_connect($host,$user,$password,$db);

if (!$link) {
	echo "Connection failed!";
}

/*$sql = 'SELECT * FROM user ';

$result = mysqli_query($link,$sql) or mysqli_error($link);

//$row = mysqli_fetch_assoc($result);
while($row = mysqli_fetch_array($result)){

    echo "<pre>";
    print_r($row);
   
   // echo '<img src="data:image/jpeg;base64, '.base64_encode($row['img']).' "/>';
    echo "</pre>";
}*/

//$noOfrows = mysqli_num_rows($result);

?>