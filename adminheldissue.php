<?php
    include 'database/dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
       do{
            $tid = rand(1,100000000);
            $sql="SELECT COUNT(tid) AS cn FROM booklog WHERE tid = $tid "; 
            $r1=$conn->query($sql);
            $c=$r1->fetch_assoc()['cn'];
        }while($c != 0);

        $bid=$_POST['bid'];
        $uid=$_POST['uid'];
        $heldid=$_POST['heldid'];
        echo "$tid $bid $uid $heldid";
        $sql_update="UPDATE heldlog SET status = 0 WHERE heldid = $heldid";
        $res=$conn->query($sql_update);
        if($res == true)
        {
            $sql_insert = "INSERT INTO booklog (tid, uid, bid, issue_date) VALUES ($tid, $uid, $bid, NOW())";
            $conn->query($sql_insert);
            header("Location: index.php");
        }
        
        
        
    }

?>