<?php
session_start();
if(isset($_SESSION['logged'])){
    if($_SESSION['logged'] == 0){
        header("Location: about.html");
        exit();
    }
    if($_SESSION['logged']==-1){
        header("Location: login.php");
        exit();
    }
}else{
    header("Location: login.php");
    exit();
}
include 'dbconnect.php';
$sql="SELECT * FROM announce";
$result = $conn->query($sql);

if (($result !== false)&&($result->num_rows > 0)) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $message = $row['message'];
        $date = $row['date'];
        
        echo "<div class='msg outgoing'><div class='admin'><p>@$name<p></div>$message<div class='msg-time'>$date</div></div>";
    }
}