<?php
    session_start();
    if(!isset($_SESSION['uid'])) {
        header('Location: tasklogin.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    color: #333;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #ddd;
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

.add-task-form {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.tasks-container {
    margin-top: 50px;
}

/* Header Styles */
header {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 24px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
}

nav ul li a:hover {
    text-decoration: underline;
}

@media screen and (max-width: 600px) {
    .add-task-form {
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
    <header>
        <div class="logo">To-Do List</div>
        <nav>
            <ul>
                <li><a href="#"><?php echo $_SESSION['name']; ?></a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="border">
    <table>
        <tr>
            <th>TASKS</th>
            <th>STATUS</th>
        </tr>
        <?php
            include 'database/dbconnect.php';
            $uid=$_SESSION['uid'];
            $sql="SELECT * FROM todoList where uid = $uid";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                while($row=mysqli_fetch_assoc($result)){
                    $tid=$row['tid'];
                    $tasks=$row['tasks'];
                    $status=$row['status'];
                    echo "<tr><td>$tasks</td>";
                    if($status==0)
                        echo "<td> COMPLETED </td></tr>";
                    else
                        echo "<td><form method='POST' name='myForm' >
                        <input type='hidden' name='donetask' value = 0>

                    <input type='hidden' name='tid' value=$tid>
                    <input type='submit' value='Mark as Completed'></form></td></tr>";
                }
            }
            else echo "<h3>NO DATA AVAILABLE</h3>";

            if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['donetask']))
            {
                $tid=$_POST['tid'];
                $sql="UPDATE todolist SET status = 0 where tid = $tid";
                mysqli_query($conn,$sql);
                header("Refresh:0");
            }
        ?>
    </table>
    <br>
        <form method="POST">
            <input type="hidden" name="addtask" value = 0>
            <input type="text" name="newtask" placeholder="Enter a new task">
            <input type="submit" value="Add Task">
        </form>
    </center>
    <?php

    if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['addtask']))
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
        header("Refresh:0");
    }
?> 
    
    </div>
</body>
</html>
