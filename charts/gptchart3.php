<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Taken This Year</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .chart-bar {
            width: 8px;
            border-radius: 20px;
        }

        /* Custom bar colors and heights */
        .bar-jan {
            background: linear-gradient(to top, #60A5FA, #3B82F6);
        }

        .bar-feb {
            background: linear-gradient(to top, #F472B6, #EC4899);
        }

        .bar-mar {
            background: linear-gradient(to top, #FBBF24, #F59E0B);
        }

        .bar-apr {
            background: linear-gradient(to top, #818CF8, #6366F1);
        }

        .bar-may {
            background: linear-gradient(to top, #34D399, #10B981);
        }

        .bar-jun {
            background: linear-gradient(to top, #A78BFA, #8B5CF6);
        }

        .bar-jul {
            background: linear-gradient(to top, #F87171, #EF4444);
        }

        .bar-aug {
            background: linear-gradient(to top, #60A5FA, #3B82F6);
        }

        .bar-sep {
            background: linear-gradient(to top, #F472B6, #EC4899);
        }

        .bar-oct {
            background: linear-gradient(to top, #FBBF24, #F59E0B);
        }

        .bar-nov {
            background: linear-gradient(to top, #818CF8, #6366F1);
        }

        .bar-dec {
            background: linear-gradient(to top, #34D399, #10B981);
        }
    </style>
</head>

<body>
    <?php
    // Assuming you have a database connection
    include '../database/dbconnect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the current year's start and end dates
    $startOfYear = date('Y-01-01');
    $endOfYear = date('Y-12-t');

    // Fetch data from the booklog table for the current year
    $result = $conn->query("SELECT MONTHNAME(issue_date) AS month_name, COUNT(*) AS book_count
                            FROM booklog
                            WHERE issue_date BETWEEN '$startOfYear' AND '$endOfYear'
                            GROUP BY MONTH(issue_date)");

    $monthCounts = array_fill_keys(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], 0);

    // Fill the $monthCounts array with the fetched data
    while ($row = $result->fetch_assoc()) {
        $monthCounts[$row['month_name']] = $row['book_count'];
    }

    $conn->close();
    ?>

    <div class="card-container bg-gray-900 text-white rounded-lg p-6 w-full max-w-xs">
        <h1 class="text-2xl font-bold mb-2">Books Taken This Year</h1>
        <div class="flex justify-between items-end mb-4 space-x-2">
            <?php foreach ($monthCounts as $month => $count) : ?>
                <div class="chart-bar bar-<?php echo strtolower(substr($month, 0, 3)); ?> w-1/12 h-<?php echo $count * 10; ?>"></div>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-between">
            <?php foreach ($monthCounts as $month => $count) : ?>
                <span class="text-xs w-1/12 text-center"><?php echo substr($month, 0, 3); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
