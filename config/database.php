<?php
$host="lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
$db_name="ngdwfln1lelgs57z";
$username="xzvyv581cnwz1gos";
$password="s29pct7acdhufn40";
try{
	$con=new PDO("mysql:host={$host};dbname={$db_name}",$username,$password);
}
catch(PDOException $exception){
	echo "Connection error:".$exception->getMessage();
}