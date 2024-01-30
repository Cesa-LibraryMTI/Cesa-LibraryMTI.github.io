<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <link rel = "stylesheet" href = "../styles/login.css">

  </head>
  <body>
    <div class = "loginform">  
      <form name = "signin.html" method = "POST">
        <div class = "loginhead">
          <h3>SIGN UP</h3>
        </div>
        <table>
          <tr>
            <td><input type="email" name="email" placeholder="email"></td>
          </tr>
          <tr>
            <td><input type="text" name="uid" placeholder="username"></td>
          </tr>
          <tr>
            <td><input type="password" name="pass" placeholder="password"></td>
          </tr>
          <tr>
            <td><input type="password" name="cpass" placeholder="confirm password"></td>
          </tr>
          <tr><td><select name = "type"><option value = 'S'>STUDENT</option><option value = 'S'>TESCHER</option><option value = 'S'>ADMIN</option></select></td></tr> 
          <tr>
            <td><input type="submit" value="sign up" id = "loginbutton"></td>
          </tr>
        </table>
<?php
  include 'dbconnectup.php';
?>
      </form>
    </div>
  </body>
</html>
