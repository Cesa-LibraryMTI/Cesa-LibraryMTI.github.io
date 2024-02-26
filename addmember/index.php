<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 0){
            header("Location: ../users/");
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
<style>
    body {
      background-color: white; /* Set the overall background color */
      color: rgb(57, 49, 49); /* Set the text color */
      margin: 0;
    }

    header {
      background-color: rgb(52, 43, 43); /* Set the background color for the title */
      color: white; /* Set the text color for the title */
      padding: 10px;
      display: flex;
      justify-content: space-between;
    }
    header a{
        align-self: center;
        justify-self: flex-end;
    }
    
        .homebutton{
            color: #fff;
            padding: 8px 22px;
            border-radius: 6px;
            background: #7d2ae8;
            transition: all 0.2s ease;
        }
        .homebutton:active{
            transform: scale(0.96);
        }
  </style>
</head>
  <link rel="stylesheet" href="../styles/pages.css">
  <header>
<h1>Add member</h1>
        <a href="../index.php"><button class='homebutton'>HOME</button></a>
    </header>
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
