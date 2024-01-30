<?php
session_start();
if((isset($_SESSION['logged']))&&($_SESSION['logged'] == 1)){
  header('Location: index.php');
  exit();
}
if((isset($_SESSION['name']))&&($_SESSION['logged'] == 0)){  
  session_unset();
  session_destroy();
}
?>
<html>
  <head>
    <title>Login</title>
  </head>
  <body>
    <h1>Enter your details</h1>
    <form name = "login" method = "POST">
      <label>Username</label>
      <input type="text" name="uname"><br>
      <label>Password</label>
      <input type="password" name="pass"><br>
      <input type="submit" value="login">
    </form> 
<?php
include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'server.php';
}
include 'cookies.php';
?>
  </body>
</html>
