<?php
$totalcount = 1;
date_default_timezone_set("Asia/kolkata");
if(isset($_COOKIE['count'])){
  $totalcount = $_COOKIE['count'];
  $totalcount++;
  $last_visit_time = $_COOKIE['last_visit_time'];
  $last_visit_date = $_COOKIE['last_visit_date'];
}
setcookie('count',$totalcount);
setcookie('last_visit_time',date("h:i:s"));
setcookie('last_visit_date',date("d-m-y"));
if($totalcount == 1){
  echo "<p>Welcome! we are glad to see you here</p>";
}else{
  echo "<p>This is your visit count: $totalcount</p><hr>";
  echo "<p>last time you were on $last_visit_date at $last_visit_time</p>";
}
if(isset($_COOKIE['lastloggedindate'])){
  $lastloggedtime = $_COOKIE['lastloggedintime'];
  $lastloggeddate = $_COOKIE['lastloggedindate'];
  $lname = $_COOKIE['loggedname'];
  echo "<p>last logged in on this computer: $lastloggeddate at $lastloggedtime as $lname</p>";
  $sql = "select d,t,name from logs";
  $result = $conn->query($sql);
  if($result != false){
    echo "<h3>Last logged in sessions</h3>";
    echo "<table>";
    while($row = $result->fetch_assoc()){
      $tdate = $row['d'];
      $ttime = $row['t'];
      $tname = $row['name'];
      echo "<tr><td>$tdate</td><td>$ttime</td><td>$tname</td></tr>";
    }
    echo "</table>";
  }
}
if(isset($_SESSION['name'])){
  setcookie('lastloggedindate',date("d-m-y"));
  setcookie('loggedname',$_SESSION['name']);
  setcookie('lastloggedintime',date("h:i:s"));
  $sql = "insert into logs values (current_date(),current_time(),'".$_SESSION['name']."')";
  $conn->query($sql);
}

?>
