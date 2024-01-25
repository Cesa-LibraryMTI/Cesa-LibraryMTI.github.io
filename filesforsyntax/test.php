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
if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  echo "<h2>Welcome $name</h2>";
}
?>
  <a href = 'login.php'>LOG OUT</a>
  </body>
</html>     
