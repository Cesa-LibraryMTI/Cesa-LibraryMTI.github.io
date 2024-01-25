<?php
session_start();
if(isset($_SESSION['name'])){  
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
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'dbconnect.php';
  include 'server.php'; 
}
include 'cookies.php';
?>
  </body>
</html>
