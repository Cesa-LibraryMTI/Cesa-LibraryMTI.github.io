<?php
    if(isset($_SESSION('logged'))==1)
    {
        $name=$_SESSION['name'];
        $sql="SELECT username from members where username='$name'";
        $result=$conn->query($sql);
        if($result->num_rows > 0)
        {
            session_unset();
            session_destroy();
            header(
                "Location: ../login/"
            );
            exit();
        }

    }
    

?>   