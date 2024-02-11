<?php
include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $uid = $_POST['user'];
    $bid = $_POST['book'];
    do{
        $tid = rand(1,100000000);
        $sq1 = "select count(tid) as cn from booklog where tid = $tid";
        $r1 = $conn->query($sq1);
        $c = $r1->fetch_assoc()['cn'];
    }while($c != 0);
    $sql = "insert into booklog values ($tid,$uid,$bid,now(),NULL)";
    $conn->query($sql);
}
header("Location: bookissue.php");
$conn->close();