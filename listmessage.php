<?php
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