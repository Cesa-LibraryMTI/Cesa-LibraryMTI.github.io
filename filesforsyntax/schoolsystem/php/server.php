<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];
  $sql = "select checker('$uname','$pass') as exist";
  $result = $conn->query($sql);
  if($result != null){
    $row = $result->fetch_assoc();
    if($row['exist']){
      session_start();
      $_SESSION['name'] = $uname;
      header('Location: ../index.html');
    }
    else echo "<div class = 'wrongcredentials'><p>wrong credentials</p></div>";
  }else{
    echo "nothing in base";
  }
}
?>
