<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin: 0;
            background-color: #1e2125;
            color: white;
        }

        .msg {
            margin-top: 40px;
            margin-left: 10px;
            max-width: 75%;
            margin-bottom: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: #343a40;
        }

        .msg-time {
            font-size: 0.75rem;
            text-align: right;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>

<?php
include '../database/dbconnect.php';

$oneWeekBefore = date('Y-m-d', strtotime('-10 week'));
$currentDate = date('Y-m-d');
$sql = "SELECT message, date FROM announce WHERE date BETWEEN '$oneWeekBefore' AND '$currentDate' ORDER BY date ASC"; // Ensure messages are ordered by date ascending
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $message = $row['message'];
        $date = $row['date'];
        echo "<div class='msg'><p>@Admin</p><p>$message</p><div class='msg-time'>$date</div></div>";
    }
} else {
    echo "<h2>No Messages Available</h2>";
}
?>

<script>
    // Automatically scroll to the bottom of the page
    window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    };
</script>

</body>
</html>
