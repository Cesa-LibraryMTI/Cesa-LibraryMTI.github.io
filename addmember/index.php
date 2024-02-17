<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 0){
            header("Location: ../about.html");
            exit();
        }
        if($_SESSION['logged']==-1){
            header("Location: ../login/");
            exit();
        }
    }else{
        header("Location: ../login/");
        exit();
    }
?>
<html>
<head>
  <link rel="stylesheet" href="../styles/pages.css">
</head>
<body>
<div class="container">
    <form method='POST'>
      <div class="formhead">
        <h3>ADD MEMBERS</h3>
      </div>
    <table id = 'logintable'>
        <tr>
            <td><label> USERNAME:</label></td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td><label>PASSWORD:</label></td>
            <td><input type="PASSWORD" name="password"></td>
        </tr>
        <tr>
            <td><label>CONFIRM PASSWORD:</label></td>
            <td><input type="PASSWORD" name="cpassword"></td>
        </tr>
        <tr>
            <td><label>USER TYPE:</label></td>
            <td><select name="membtype" id="">
              <option value="0">user</option>
              <option value="1">admin</option>
            </select></td>
        </tr>
        
    </table>
      <button type="submit" id='submitbutton'>confirm</button>
      <?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include '../database/dbconnect.php';
    include '../database/checker.php';
    $name=$_POST['name'];
    $password=$_POST['password'];
    $membtype=$_POST['membtype'];
    $sql = "select inserter('$membtype','$name','$password') as illegal";
    $result = $conn->query($sql);
    if($result !== false){
      $illegal = $result->fetch_assoc()['illegal'];
      if($illegal){
        echo "<div class='failed'><p>Failed to create</p></div>";
      }else{
        echo "<div class='successfull'><p>Created user</p></div>";
      }
    }
    $conn->close();
  }
?>
    </form>
    </div>
</body>

</html>
