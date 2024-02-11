<?php
include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $tid = $_POST['tid'];
    $sql = "update booklog set return_date = now() where tid = $tid";
    $conn->query($sql);
}
header("Location: notreturned.php");
$conn->close();
exit();