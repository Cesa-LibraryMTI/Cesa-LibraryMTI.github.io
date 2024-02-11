<?php
include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $userid = $_POST['user'];
    $sql = "delete from members where uid = $userid";
    $conn->query($sql);
}
header("Location: members.php");
