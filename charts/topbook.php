<?php
// Include your database connection code here
include '../database/dbconnect.php';

// Query to get book counts by category
$sql = "SELECT bid,,COUNT(bid) AS book_count FROM booklog GROUP BY bid order by COUNT(bid) desc";
$result = $conn->query($sql);

// Fetch data
$labels = [];
$values = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['bid'];
    $values[] = $row['book_count'];
}

// Return data as JSON
echo json_encode(['labels' => $labels, 'values' => $values]);

// Close the database connection
$conn->close();
?>
