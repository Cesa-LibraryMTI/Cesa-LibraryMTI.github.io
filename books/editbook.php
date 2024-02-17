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
        <input type="hidden" name = 'chupdate' value = 'update'>
        <input type="hidden" name = 'bookid' id = 'bookid'>
        <input type="hidden" name = 'oldcopies' id = 'oldcopies'>
    <div class="formhead">
      <h3>EDIT BOOK</h3>
    </div>
    <table>
        <tr>
            <td><label>BOOK NAME:</label></td>
            <td><input type="text" name="bname" id = "bname"></td>
        </tr>
        <tr>
            <td><label>AUTHOR:</label></td>
            <td><input type="text" name="bauthor" id="bauthor"></td>
        </tr>
        <tr>
            <td><label>COPIES:</label></td>
            <td><input type="number" name="copy" id="copy" min=1></td>
        </tr>
        <tr>
            <td><label>CATEGORY:</label></td>
            <td><select name="bcategory" id="myDropdown" onchange="showInputBox()">
            <option value = '' disabled>select a category</option>

            <?php
              include '../database/dbconnect.php';
              include '../database/checker.php';
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
            <td><input type="text" name="bprice" id = "bprice"></td>
        </tr>
    </table>
      <button type="submit" id = "submitbutton">confirm</button>
      <?php
        include '../database/checker.php';
        if(isset($_POST['sent'])){
            $bid = $_POST['book'];
            $bname = $_POST['bookname'];
            $bauth = $_POST['bauthor'];
            $bcat = $_POST['bcategory'];
            $bcp = $_POST['bcopy'];
            $bav = $_POST['bavailable'];
            $bp = $_POST['bprice'];
            echo "<script>";
            echo "document.getElementById('bookid').value = $bid;";
            echo "document.getElementById('oldcopies').value = $bcp;";
            echo "document.getElementById('bname').placeholder = '$bname';";
            echo "document.getElementById('bname').value = '$bname';";
            echo "document.getElementById('bauthor').placeholder = '$bauth';";
            echo "document.getElementById('bauthor').value = '$bauth';";
            echo "document.getElementById('inputBox').placeholder = '$bcat';";
            echo "document.getElementById('inputBox').value = '$bcat';";
            echo "document.getElementById('copy').placeholder = '$bcp';";
            echo "document.getElementById('copy').value = '$bcp';";
            echo "document.getElementById('bprice').placeholder = $bp;";
            echo "document.getElementById('bprice').value = $bp;";
            if($bcp != $bav){
            echo "document.getElementById('copy').min = $bcp";
            }
            echo "</script>";
        }
        if(isset($_POST['chupdate'])){
            include '../database/dbconnect.php';
            $bookid=$_POST['bookid'];
            $bname=$_POST['bname'];
            $bauthor=$_POST['bauthor'];
            $bprice=$_POST['bprice'];
            $category=$_POST['bcategory'];
            $copy = $_POST['copy'];
            $ocopy = $_POST['oldcopies'];
            if($category==='other') $category=$_POST['new_category'];
            echo "update books set bname = '$bname',bauthor = '$bauthor',bprice = $bprice,bcategory = '$category' where bid = $bookid";
            $sql = "update books set bname = '$bname',bauthor = '$bauthor',bprice = $bprice,bcategory = '$category' where bid = $bookid";
            $sql2 = "update copies set copies = $copy,available = available+($copy-$ocopy) where bid = $bookid";
            $r1 = $conn->query($sql);
            $r2 = $conn->query($sql2);
            echo "<div class = 'successfull'></div>";
            if($r1 && $r2){
              echo "<div class = 'successfull'><p>Updated successfully</p></div>";
            }else{
              echo "<div class = 'failed'><p>Update failed</p></div>";
            }
            $conn->close();
            header("Location: index.php");
        }
    ?>
    </form>
    </div>
   
</body>
</html>
