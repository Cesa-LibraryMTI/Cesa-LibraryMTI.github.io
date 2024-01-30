<?php
  $name = $_POST['uname'];
  $passw = $_POST['pass'];
  $sql = "select username,password from users where username = '$name' and password = '$passw'";
  $result = $conn->query($sql);
  if($result != false and $result->num_rows == 1){
    session_start();
    $_SESSION['name'] = $name;
    header("Location: test.php");
  }else{
    echo "<h1>Wrong Credentials</h1>";
  }
?>
