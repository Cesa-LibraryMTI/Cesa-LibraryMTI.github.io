<html>
<head>

<script>
    function showInputBox() {
      var dropdown = document.getElementById('myDropdown');
      var selectedOption = dropdown.options[dropdown.selectedIndex].value;

      // Check if the selected option requires displaying the input box
      if (selectedOption === 'other') {
        document.getElementById('inputBoxContainer').style.display = 'block';
      } else {
        document.getElementById('inputBoxContainer').style.display = 'none';
      }
    }
  </script>

    <style>

.container {
  height: 500px;    
  width: 300px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #ccc;
}

form {
  margin-bottom: 20px;
}

input,
button {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid rgb(0, 0, 0);
  border-radius: 3px;
}

button {
  background-color: green;
  color: white;
  cursor: pointer;
  border-radius: 20px;
}

.checkbox {
  display: flex;
  align-items: center;
}

input[type="checkbox"] {
  margin-right: 10px;
}

label {
  font-size: 14px;
}

    </style>
</head>
<body>
<div class="container">
    <h3 align="center">ADD BOOK</h3>
    <form method='POST'>
    <table>

        <tr>
            <td><label>SI NO:</label></td>
            <td><input type="text" name="bsino"></td>  
        </tr>
        <tr>
            <td><label>BOOK NAME:</label></td>
            <td><input type="text" name="bname"></td>
        </tr>
        <tr>
            <td><label>AUTHOR:</label></td>
            <td><input type="text" name="bauthor"></td>
        </tr>
        <tr>
            <td><label>number of copies:</label></td>
            <td><input type="number" name="copy"></td>
        </tr>
        <tr>
            <td><label>CAEGORY:</label></td>
            <td><select name="bcategory" id="myDropdown" onchange="showInputBox()">

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
        
        <div id="inputBoxContainer">
        <label for="inputBox">New Category:</label>
        <input type="text" id="inputBox" name="new_category" placeholder="category name">
        </div>  
    
        </tr>
        <tr>
            <td><label>price:</label></td>
            <td><input type="text" name="bprice"></td>
        </tr>
    </table>
      <button type="submit">confirm</button>
    </form>
    </div>
</body>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $bid=$_POST['bsino'];
    $bname=$_POST['bname'];
    $bauthor=$_POST['bauthor'];
    $bprice=$_POST['bprice'];
    $category=$_POST['bcategory'];
    if($category==='other')
      $category=$_POST['new_catgory'];
    $sql = "insert into books values('$bsino','$bname','$bauthor','$bprice',$category)";
    $conn->query($sql);
  }
?>
</html>
