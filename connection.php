<?php


$servername= "localhost";
$username= "root";
$password= "Hemal@123";
$dbname= "andon";


$conn= mysqli_connect($servername,$username,$password,$dbname);

if($conn){
	echo "";
}
else{
	die("Connection failed ".mysql_connect_error());
}

?>