<html>
<head>

  <script src = 'js/category.js'></script>
  <link rel="stylesheet" href="styles/pages.css">
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
              include 'dbconnect.php'; // Corrected the file name
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
        $conn->close();
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
    include 'dbconnect.php';
    $bname=$_POST['bname'];
    $bauthor=$_POST['bauthor'];
    $bprice=$_POST['bprice'];
    $category=$_POST['bcategory'];
    if($category==='other')
      $category=$_POST['new_category'];
    $sql = "insert into books (bname,bauthor,bprice,bcategory) values('$bname','$bauthor','$bprice','$category')";
    $insresult = $conn->query($sql);
    if($insresult){
      echo "<div class = 'successfull'><p>Inserted successfully</p></div>";
    }else{
      echo "<div class = 'failed'><p>Insert failed</p></div>";
    }
  }
?>
    </form>
    </div>
</body>
</html>
