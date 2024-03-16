<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Issued Book</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-800 min-h-screen flex items-center justify-center">

    <?php
    // Assuming you have a database connection
    include '../database/dbconnect.php';

    // Fetch data from the books table
    $result = $conn->query("SELECT b.bname, COUNT(*) AS book_count 
                            FROM booklog bl
                            JOIN books b ON bl.bid = b.bid
                            GROUP BY bl.bid 
                            ORDER BY COUNT(bl.bid) DESC LIMIT 5");

    if ($result->num_rows > 0) {
        // Calculate the maximum count
        $maxCount = maxCount($result);
        ?>

        <div class="text-black rounded-lg p-6 w-full max-w-xs">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg font-bold">MOST ISSUED BOOK</h1>
                
            </div>

            <ul>
                <?php
                // Reset the result pointer to the beginning of the result set
                $result->data_seek(0);

                while ($row = $result->fetch_assoc()) {
                    // Calculate the percentage width based on the count
                    $percentageWidth = ($row['book_count'] / $maxCount * 100);
                    ?>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-shield-alt text-red-500 mr-2"></i>
                        <span class="flex-1"><?php echo $row['bname']; ?></span>
                        <span class="font-bold"><?php echo $row['book_count']; ?></span>
                        <div class="w-24 h-2 bg-gray-700 rounded-full ml-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: <?php echo $percentageWidth; ?>%;"></div>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>

        <?php
    } else {
        echo "No data available";
    }

    $conn->close();

    function maxCount($result)
    {
        $max = 0;
        while ($row = $result->fetch_assoc()) {
            $max = max($max, $row['book_count']);
        }
        return $max;
    }
    ?>

</body>

</html>
