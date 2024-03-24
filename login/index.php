<?php
  session_start();
  if((isset($_SESSION['logged']))){
    if($_SESSION['logged'] == 1){
      header('Location: ../');
      exit();
    }else if($_SESSION['logged'] == 0){
      header('Location: ../users/');
      exit();
    }else if(($_SESSION['logged'] == -1)){  
      session_unset();
      session_destroy();
    }
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src = "../js/login.js"></script>
    <link rel = "stylesheet" href = "../styles/pages.css">
    <style>
    body{
      background: url('../users/library.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      

    }
    

  </style>
  
  </head>
  <body>

    <div class = "container">  
      <form name = "login.html" method = "POST">

        <div class = "formhead">
          <h3>LOGIN</h3>
        </div>
        <table id = 'logintable'>
          <tr>
            <td><input type="text" name="uname" placeholder="username" required></td>
          </tr>
          <tr>
            <td><input type="password" name="pass" placeholder="password" required></td>
          </tr>
          <tr>
            <td><input type="submit" value="Log in" id = "submitbutton" onclick="return check()"></td>
          </tr>
      
        </table>
<?php
  include '../database/dbconnect.php';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $sql = "select checker('$uname','$pass') as exist";
    $result = $conn->query($sql);
    if($result != null){
      $row = $result->fetch_assoc();
      if($row['exist'] == 1){
        $sql = "select uid from members where username = '$uname'";
        $uid = ($conn->query($sql))->fetch_assoc()['uid'];
        session_start();
        $_SESSION['name'] = $uname;
        $_SESSION['logged'] = 1;
        $_SESSION['id'] = $uid;

        header('Location: ../');
      }else if($row['exist'] == 0){
        $sql = "select uid from members where username = '$uname'";
        $uid = ($conn->query($sql))->fetch_assoc()['uid'];
        session_start();
        $_SESSION['name'] = $uname;
        $_SESSION['logged'] = 0;
        $_SESSION['id'] = $uid;
        header('Location: ../users/index.php');
      }else echo "<div class = 'failed'><p>wrong credentials</p></div>";
  }
  }
  $conn->close();
?>
      </form>
    </div>
  </body>
</html>
