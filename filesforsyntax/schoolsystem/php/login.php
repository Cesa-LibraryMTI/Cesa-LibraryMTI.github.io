<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel = "stylesheet" href = "../styles/login.css">
  </head>
  <body>
    <div class = "loginform">  
      <form name = "login.html" method = "POST">

        <div class = "loginhead">
          <h3>LOGIN</h3>
        </div>
        <table>
          <tr>
            <td><input type="text" name="uname" placeholder="username"></td>
          </tr>
          <tr>
            <td><input type="password" name="pass" placeholder="password"></td>
          </tr>
          <tr>
            <td><input type="submit" value="Log in" id = "loginbutton"></td>
          </tr>
          <tr>
            <td>Dont have an account? <a href = "signup.php">SIGN UP</a></td>
          </tr>
        </table>
<?php
  include 'dbconnect.php';
?>
      </form>
    </div>
  </body>
</html>
