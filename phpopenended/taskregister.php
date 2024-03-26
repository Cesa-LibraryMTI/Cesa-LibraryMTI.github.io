<!DOCTYPE html>
<?php
session_start();
    if(isset($_SESSION['name']){
        header("Location: webproject.php");
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
       
    </style>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var name = document.getElementById("name").value;
            if (name.length < 3) {
                alert("name must be at least 3 characters long");
                return false;
            }
            else if (password.length < 5) {
                alert("Password must be at least 5 characters long");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST" onsubmit="return validateForm()">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" value="Register">

        </form>
        <?php
    include 'dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $name=$_POST['name'];
        $sql="SELECT name FROM users where name = '$name'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 0)
        {
        
        $password=$_POST['password'];
        do{
            $uid=rand(1,1000);
            $sql="SELECT uid FROM users where uid = $uid";
            $result=mysqli_query($conn,$sql);
        }while(mysqli_num_rows($result) != 0);
        
        $sql="INSERT INTO users VALUES($uid,'$name','$password')";
        mysqli_query($conn,$sql);
        echo "<script> alert('user added successfully');</script>";
        header('Location: tasklogin.php');
        exit();
        }
        else
            echo "<div>user name already exist</div>";
        
    }

?>

        
        
    </div>
</body>
</html>

