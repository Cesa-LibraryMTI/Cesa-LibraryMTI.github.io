<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: #1a1c2c;
            border-radius: 1rem;
            padding: 2rem;
            color: white;
            max-width: 300px;
            text-align: center;
            margin: 20px auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .circular-chart {
        display: block;
        margin: 10px auto;
        max-width: 80%;
        max-height: 250px;
        filter: drop-shadow(0 0 10px rgba(255, 159, 0, 0.8)); /* Add glow effect */
    }


        .circle-bg {
            fill: none;
            stroke: #eeeeee;
            stroke-width: 3.8;
        }

        .circle {
            fill: none;
            stroke-width: 2.8;
            stroke-linecap: round;
            animation: progress 1s ease-out forwards;
        }

        @keyframes progress {
            0% {
                stroke-dasharray: 0 100;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Function to animate the progress circle
            const animateProgress = (id, value) => {
                const circle = document.getElementById(id);
                const radius = circle.r.baseVal.value;
                const circumference = radius * 2 * Math.PI;

                circle.style.strokeDasharray = `${circumference} ${circumference}`;
                circle.style.strokeDashoffset = `${circumference}`;

                const offset = circumference - (value / 100) * circumference;
                circle.style.strokeDashoffset = offset;
            }

            // Assuming you have PHP variables $availableBooks and $totalBooks
            <?php
            $availableBooks = 20063;
            $totalBooks = 25004;
            ?>

            animateProgress('progress-circle', <?php echo ($availableBooks / $totalBooks) * 100; ?>);
        });
    </script>
</head>

<body class="bg-gray-800 min-h-screen flex items-center justify-center font-family: 'Roboto', sans-serif;">
    <div class="card">
        <h1 class="text-2xl text-white font-bold">Book Availability Rate</h1>
        <svg viewBox="0 0 36 36" class="circular-chart" width="100" height="100">
            <path class="circle-bg"
                d="M18 2.0845
              a 15.9155 15.9155 0 0 1 0 31.831
              a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path class="circle" stroke="#ff9f00" id="progress-circle"
                d="M18 2.0845
              a 15.9155 15.9155 0 0 1 0 31.831
              a 15.9155 15.9155 0 0 1 0 -31.831"
            />
        </svg>
        <h2 class="text-4xl font-bold text-orange-500 mt-2"><?php echo round(($availableBooks / $totalBooks) * 100); ?>%</h2>
        <div class="flex justify-between text-base text-gray-400 mt-4">
            <span><i class="fas fa-book"></i> <?php echo number_format($availableBooks); ?></span>
            <span><?php echo number_format($totalBooks); ?> <i class="fas fa-book"></i></span>
        </div>
    </div>
</body>

</html>