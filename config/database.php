<?php
$host="localhost";
$db_name="php_beginner";
$username="root";
$password="";
try{
	$con=new PDO("mysql:host={$host};dbname={$db_name}",$username,$password);
}
catch(PDOException $exception){
	echo "Connection error:".$exception->getMessage();
}