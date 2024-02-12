<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['msg'];
    include 'dbconnect.php';
    date_default_timezone_set("Asia/Kolkata");

    $sql = "INSERT INTO announce VALUES ('$message', '" . date('Y-m-d') . "')";
    $result = $conn->query($sql);

    if ($result) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
