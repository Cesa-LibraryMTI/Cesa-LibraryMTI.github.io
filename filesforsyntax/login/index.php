<?php
session_start();
?>
<html>
  <head>
    <title>Test php page</title>
  </head>
  <body>
    <h1>Welome</h1>
<?php 
$str = "SIGN IN";
if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  echo "<h2>Welcome $name</h2>";
  $str = "LOG OUT";
}
echo "<a href = 'logout.php'>$str</a>";
?>
  </body>
</html>     
