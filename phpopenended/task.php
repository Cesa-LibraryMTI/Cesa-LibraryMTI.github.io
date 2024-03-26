<?php
    session_start();
    if(!(isset($_SESSION['uid'])))
    {
        header('Location: tasklogin.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 600px) {
            form {
                width: 80%;
            }

            input[type="text"] {
                width: 60%;
            }
        }
    </style>
</head>
<body>
    <center>
        <form method="POST">
            <input type="text" name="newtask" placeholder="Enter a new task">
            <input type="submit" value="Add Task">
        </form>
    </center>
</body>
</html>
<?php

    include 'dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $newtask=$_POST['newtask'];
        do
        {
            $tid=rand(1, 1000);
            $sql="SELECT tid FROM todolist where tid = $tid";
            $result=mysqli_query($conn,$sql);
            
        }while(mysqli_num_rows($result) > 0);
        $uid=$_SESSION['uid'];
        $sql="INSERT INTO todolist VALUES($tid,$uid,'$newtask',1)";
        mysqli_query($conn,$sql);
    }
?> 