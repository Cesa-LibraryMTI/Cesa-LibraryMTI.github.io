<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .chart-bar {
            width: 8px;
            border-radius: 20px;
        }

        /* Custom bar colors and heights */
        .bar-mon {
            background: linear-gradient(to top, #60A5FA, #3B82F6);
        }

        .bar-tue {
            background: linear-gradient(to top, #F472B6, #EC4899);
        }

        .bar-wed {
            background: linear-gradient(to top, #FBBF24, #F59E0B);
        }

        .bar-thu {
            background: linear-gradient(to top, #818CF8, #6366F1);
        }

        .bar-fri {
            background: linear-gradient(to top, #34D399, #10B981);
        }

        .bar-sat {
            background: linear-gradient(to top, #A78BFA, #8B5CF6);
        }

        .bar-sun {
            background: linear-gradient(to top, #F87171, #EF4444);
        }
    </style>
</head>

<body>
    <?php
    // Assuming you have a database connection
    include '../dbconnect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the current week's start and end dates
    $startOfWeek = date('Y-m-d', strtotime('monday this week'));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

    // Fetch data from the booklog table for the current week
    $result = $conn->query("SELECT DAYNAME(issue_date) AS day_name, COUNT(*) AS bid_count
                            FROM booklog
                            WHERE issue_date BETWEEN '$startOfWeek' AND '$endOfWeek'
                            GROUP BY day_name");

    $dayCounts = array_fill_keys(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'], 0);

    // Fill the $dayCounts array with the fetched data
    while ($row = $result->fetch_assoc()) {
        $dayCounts[$row['day_name']] = $row['bid_count'];
    }

    $conn->close();
    ?>

    <div class="card-container bg-gray-900 text-white rounded-lg p-6 w-full max-w-xs">
        <h1 class="text-2xl font-bold mb-2">Book Counts This Week</h1>
        <div class="flex justify-between items-end mb-4 space-x-2">
            <?php foreach ($dayCounts as $day => $count) : ?>
                <div class="chart-bar bar-<?php echo strtolower(substr($day, 0, 3)); ?> w-1/12 h-<?php echo $count * 10; ?>"></div>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-between">
            <?php foreach ($dayCounts as $day => $count) : ?>
                <span class="text-xs w-1/12 text-center"><?php echo substr($day, 0, 3); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
