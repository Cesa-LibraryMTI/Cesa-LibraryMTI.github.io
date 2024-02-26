<?php
// Include your database connection code here
include '../dbconnect.php';

// Query to get book counts by category
$sql = "SELECT bcategory, COUNT(*) AS book_count FROM books GROUP BY bcategory";
$result = $conn->query($sql);

// Fetch data
$labels = [];
$values = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['bcategory'];
    $values[] = $row['book_count'];
}

// Return data as JSON
echo json_encode(['labels' => $labels, 'values' => $values]);

// Close the database connection
$conn->close();
?>
