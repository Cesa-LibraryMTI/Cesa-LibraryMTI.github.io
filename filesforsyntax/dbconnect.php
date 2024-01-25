<?php
$host = 'localhost:3306';
$user = 'nabeel';
$pass = 'nabeel123';
$db = 'testbase';

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
  die("connection failure: ".$conn->connect_error);
}
echo "Connection succesfull!!!";
?>
