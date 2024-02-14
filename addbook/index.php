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

  <script src = '../js/category.js'></script>
  <link rel="stylesheet" href="../styles/pages.css">
</head>
<body>
<div  class = 'container'>
    
    <form method='POST'>
    <div class="formhead">
      <h3>ADD BOOK</h3>
    </div>
    <table>
        <tr>
            <td><label>BOOK NAME:</label></td>
            <td><input type="text" name="bname"></td>
        </tr>
        <tr>
            <td><label>AUTHOR:</label></td>
            <td><input type="text" name="bauthor"></td>
        </tr>
        <tr>
            <td><label>COPIES:</label></td>
            <td><input type="number" name="copy" min=1></td>
        </tr>
        <tr>
            <td><label>CATEGORY:</label></td>
            <td><select name="bcategory" id="myDropdown" onchange="showInputBox()">
            <option value = '' disabled>select a category</option>

            <?php
              include '../database/dbconnect.php';
              echo "<option value='other'>new category</option>";
              $sql = "SELECT DISTINCT bcategory FROM books";
              $result = $conn->query($sql);

              if (($result !== false) && ($result->num_rows > 0)) {
                while ($row = $result->fetch_assoc()) {
                $category = $row['bcategory'];
                echo "<option value='$category'>$category</option>";
                }
              } else {
              echo "<h1>wrong credentials</h1>";
              }
              echo "</select></td></tr>";
        ?>
        
        <tr id="inputBoxContainer">
        <td><label for="inputBox">New Category:</label></td>
        <td><input type="text" id="inputBox" name="new_category" placeholder="category name"></td>
        </tr>  
        <tr>
            <td><label>price:</label></td>
            <td><input type="text" name="bprice"></td>
        </tr>
    </table>
      <button type="submit" id = "submitbutton">confirm</button>
      <?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include '../database/dbconnect.php';
    $bname=$_POST['bname'];
    $bauthor=$_POST['bauthor'];
    $bprice=$_POST['bprice'];
    $category=$_POST['bcategory'];
    $copy = $_POST['copy'];
    if($category==='other')
      $category=$_POST['new_category'];
    do{
      $bid = rand(1,100000000);
      $sq1 = "select count(bid) as cn from books where bid = $bid";
      $rt1 = $conn->query($sq1);
      $c = $rt1->fetch_assoc()['cn'];
    }while($c != 0);
    $sql = "insert into books values($bid,'$bname','$bauthor','$bprice','$category')";
    $sql2 = "insert into copies values($bid,$copy,$copy)";
    $r1 = $conn->query($sql);
    $r2 = $conn->query($sql2);
    echo "<div class = 'successfull'></div>";
    if($r1 && $r2){
      echo "<div class = 'successfull'><p>Inserted successfully</p></div>";
    }else{
      echo "<div class = 'failed'><p>Insert failed</p></div>";
    }
    $conn->close();
  }
?>
    </form>
    </div>
</body>
</html>
