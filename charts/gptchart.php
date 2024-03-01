<?php
// Include your database connection code here
include '../database/dbconnect.php';

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

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System Chart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f3f3f3;
        }
        canvas {
            width: 300px;
            height: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
            display: block;
        }
        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Categories</h1>
    <canvas id="myChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Use the PHP variables directly in JavaScript
            var dataLabels = <?php echo json_encode($labels); ?>;
            var dataValues = <?php echo json_encode($values); ?>;

            // Create a pie chart using Chart.js
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: dataLabels,
                    datasets: [{
                        data: dataValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)',
                            'rgba(0, 123, 255, 0.7)',
                            'rgba(255, 0, 123, 0.7)',
                            'rgba(0, 255, 123, 0.7)',
                            'rgba(255, 123, 0, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false, // Disable responsiveness
                    maintainAspectRatio: false, // Disable aspect ratio
                    legend: {
                        position: 'bottom',
                        labels: {
                            fontColor: '#333'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
