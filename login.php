<html>
<head>
    <script src = "js/login.js"></script>
    <link rel = "stylesheet" href = "styles/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <i class="bi bi-person-circle icon mb-2 text-blue-500" style="font-size: 3em;"></i>


    <form method="POST">
      <label>EMAIL:</label>
      <input type="email" name="email" placeholder="Email" required>
      <label>PASSWORD:</label>
      <input type="password" name="password" id = "password" placeholder="Password" required>
      <a href="/forgot-password">Forgot password?</a><br><br>
      <input type="submit" class = "button" value = "Login" onclick="return check()">
    </form>
    <p>Don't have an account? <a href="/register.html">Register</a></p>
  </div>
</body>
<?php
  include 'dbconnect.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $uname = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT username,password FROM details WHERE username = '$uname' and password = '$pass'";
    $result = $conn->query($sql);

    if (($result !== false)&&($result->num_rows == 1)) {
      echo 'found';
      header("Location: index.html");
    }else{
      print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
    }
    $conn->close();
  }
?>
</html>