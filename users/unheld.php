<?php
    session_start();
    if(isset($_SESSION['logged']) && ($_SERVER['REQUEST_METHOD'] == 'POST'))
    {
        include '../database/dbconnect.php';
        $uid=$_SESSION['id'];
        $sql="UPDATE heldlog SET status = 0 where uid = $uid ";
        $conn->query($sql);
        
        header("Location: profile.php");       
        exit(); 
    }
?>