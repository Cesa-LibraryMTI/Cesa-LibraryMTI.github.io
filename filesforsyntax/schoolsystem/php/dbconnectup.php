<?php
$host = 'localhost:3306';
$user = 'schoollogger';
$pass = 'school123';
$db = 'schoolsystem';

try{
  $conn = new mysqli($host,$user,$pass,$db);

  if($conn->connect_error){
    throw new Exception("connection failed".$conn->connect_error);
  }
  echo "<div class = 'connected'><p>DataBase Connected</p></div>";
  include 'serverup.php';
}catch(Exception $e){
  echo "<div class = 'disconnected'><p>DataBase failure</p></div>";

}
?>
