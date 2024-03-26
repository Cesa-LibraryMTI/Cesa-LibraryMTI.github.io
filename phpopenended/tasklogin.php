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
        .register-link {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
        .register-link a {
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" value="Login">
        </form>
        <div class="register-link">
            New user? <a href="taskregister.php">Register</a>
        </div>
    </div>
</body>
</html>

<?php
    include 'dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $name=$_POST['name'];
        $password=$_POST['password'];
        $sql="SELECT * FROM users where name = '$name' AND password = '$password'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row=mysqli_fetch_assoc($result);
            $uid=$row['uid'];
            $name=$row['name'];
            $_SESSION['uid']=$uid;
            $_SESSION['name']=$name;
            header('Location: webProject.php');
        }
        else
        {
            echo "<h1>invalid username and password </h1>";
        }
    }

?>