<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 0){
            header("Location: ../users/");
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
include '../database/dbconnect.php';
include '../database/checker.php';

$uname= $_SESSION['name'];
$sql="SELECT * FROM announce";
$result = $conn->query($sql);

if (($result !== false)&&($result->num_rows > 0)) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $message = $row['message'];
        $date = $row['date'];
        
        if($uname != $name){
            echo "<div class='msg incoming'><div class='username'><p>~$name</p></div><p>$message</p><div class='msg-time'>$date</div></div>";   
        }
        else{
            echo "<div class='msg outgoing'><div class='username'><p>~$name</p></div><p>$message</p><div class='msg-time'>$date</div></div>";
        }
    }
}