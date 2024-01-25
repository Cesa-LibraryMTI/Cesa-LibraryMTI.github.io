<html>
<head>
    <style>

.container {
  height: 350px;    
  width: 200px;
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
    $bsino=$_POST['bsino'];
    $bname=$_POST['bname'];
    $bauthor=$_POST['bauthor'];
    $bprice=$_POST['bprice'];
    $sql = "insert into books values('$bsino','$bname','$bauthor','$bprice')";
  }
?>
</html>
