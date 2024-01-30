<?php
$totalcount = 1;
date_default_timezone_set("Asia/kolkata");
if(isset($_COOKIE['count'])){
  $totalcount = $_COOKIE['count'];
  $totalcount++;
}
if(isset($_COOKIE['last_visit'])){
  $last_visit = $_COOKIE['last_visit'];
}
setcookie('count',$totalcount);
setcookie('last_visit',date("h:i:s"));
if($totalcount == 1){
  echo "<p>Welcome! we are glad to see you here</p>";
}else{
  echo "<p>This is your visit count: $totalcount</p><hr>";
  echo "<p>last time you were on ".date("d:m:y")." at $last_visit</p>";
}
if(isset($_COOKIE['lastloggedin'])&& isset($_COOKIE['loggedname'])){
  $lastlogged = $_COOKIE['lastloggedin'];
  $lname = $_COOKIE['loggedname'];
  echo "<p>last logged in on this computer: $lastlogged as $lname</p>";
}
if(isset($_SESSION['name'])){
  setcookie('loggedname',$_SESSION['name']);
  setcookie('lastloggedin',date("h:i:s"));
}

?>
