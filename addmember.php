<html>
<head>
    <style>

.container {
  height: 350px;    
  width: 200px;
  margin: 20px auto;
  padding: 10px;
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
            <td><label>AD NO:</label></td>
            <td><input type="text" name="adno"></td>  
        </tr>
        <tr>
            <td><label> USERNAME:</label></td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td><label>PASSWORD:</label></td>
            <td><input type="PASSWORD" name="password"></td>
        </tr>
        <tr>
            <td><label>USER TYPE:</label></td>
            <td><select name="membtype" id="">
              <option value="0">user</option>
              <option value="1">admin</option>
            </select></td>
        </tr>
        
    </table>
      <button type="submit">confirm</button>
    </form>
    </div>
</body>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $bsino=$_POST['adno'];
    $bname=$_POST['name'];
    $bauthor=$_POST['password'];
    $bprice=$_POST['membtype'];
    $sql = "insert into books values('$adno','$name','$password','$membtype')";
    $conn->query($sql);
  }
?>
</html>
