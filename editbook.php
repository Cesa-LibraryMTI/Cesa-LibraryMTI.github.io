<html>
<head>

  <script src = 'js/category.js'></script>
  <link rel="stylesheet" href="styles/pages.css">
    <?php
        $bid = $_POST['book'];
        $edit = $_POST['editable'];
        $bname = $_POST['bookname'];
        $bauth = $_POST['bauthor'];
        $bcat = $_POST['bcategory'];
        $bcp = $_POST['bcopy'];
        $bav = $_POST['bavailable'];
        $bp = $_POST['bprice'];
        echo "<script>";
        echo "document.getElementByID('bname').placeholder = $bname;";
        echo "document.getElementByID('bname').value = $bname;";
        echo "document.getElementByID('bauthor').placeholder = $bauth;";
        echo "document.getElementByID('bauthor').value = $bauth;";
        echo "document.getElementByID('inputBox').placeholder = $bcat;";
        echo "document.getElementByID('inputBox').value = $bcat;";
        echo "document.getElementByID('copy').placeholder = $bcp;";
        echo "document.getElementByID('copy').value = $bcp;";
        echo "document.getElementByID('bprice').placeholder = $bp;";
        echo "document.getElementByID('bprice').value = $bp;";
        if($bcp != $bav){
            echo "document.getElementByID('copy').min = $bcp";
        }
        echo "</script>";
    ?>
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
              include 'dbconnect.php';
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
      
    </form>
    </div>
</body>
</html>
