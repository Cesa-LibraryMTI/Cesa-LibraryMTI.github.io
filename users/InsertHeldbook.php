
<?php
    include '../database/dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        session_start();
        $bid=$_POST['bid'];
        $tid=$_POST['tid'];
        $uid=$_SESSION['id'];
        $date=date("Y-m-d");
        
        do{
            $heldid = rand(1,100000000);
            $sq1 = "select count(heldid) as cn from heldlog where heldid = $heldid";
            $r1 = $conn->query($sq1);
            $c = $r1->fetch_assoc()['cn'];
        }while($c != 0);
        $sql = "insert into heldlog values ($heldid,$bid,$uid,'$date',1,$tid)";
        $conn->query($sql);
        header("Location: index.php");
    }

    
?>