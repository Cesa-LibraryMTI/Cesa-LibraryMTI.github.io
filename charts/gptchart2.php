<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
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

<body class="bg-gray-100">
    <?php
    include '../database/dbconnect.php';

   
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

    <div class="card-container text-black rounded-lg p-6 w-full max-w-xs">
        <h1 class="text-lg font-bold">BOOK COUNT'S THIS WEEK</h1><br>

        <div class="flex justify-between items-end mb-4 space-x-2">
            
            <?php 
            
            foreach ($dayCounts as $day => $count) : ?>
                <div class="relative w-1/12 flex flex-col items-center">
                    <div class="chart-bar bar-<?php echo strtolower(substr($day, 0, 3)); ?> h-<?php echo $count * 10; ?> "></div>
                    <span class="text-xs text-center block mt-2"><?php echo $count; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-between">
            <?php 
            
            foreach ($dayCounts as $day => $count) : ?>
                <span class="text-xs w-1/12 text-center"><?php echo substr($day, 0, 3); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
