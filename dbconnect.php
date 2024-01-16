<?php
$servername = "192.168.0.179";
$username = "root";
$password = "mtitsr123";
$dbname = "Library";
            
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
                
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>           
                