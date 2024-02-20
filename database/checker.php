<?php
$name=$_SESSION['name'];
$sql="SELECT username from members where username='$name'";
$result=$conn->query($sql);
if($result->num_rows == 0)
{
    session_unset();
    session_destroy();
    exit();
}
  