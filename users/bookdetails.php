    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Details</Details></title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <style>
            .container{
                width: 100%;
                height: 100%;
                background-color: wheat;
            
            }
            .child{
                display: flex;
                flex-direction: row;
                background-color: grey;
                margin: 10px 10px auto 10px;
                height: auto;
                padding: 30px;
                border-radius: 20px;
            }
            #image{
                width: 130px;
                height: 130px;
                background-image: url('javaBook.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                border-radius: 10px;

            }
            .child > div{
                margin-right: 20px;            
            }
            .rating{
                width: 130px;
                height: 130px;
                
            }


            .msg {
            
                margin: 20px 10px 0.75rem;
                max-width: 75%;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                width: 100%;
            }

            .msg-time {
                font-size: 0.75rem;
                text-align: right;
                margin-top: 0.25rem;
            }
            .feedback{
                margin: 10px 10px auto 10px;
                padding: 10px;
                max-width: 100%;
                height: fit-content;
                background-color: grey;
                border-radius: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="child"><div id="image">image</div><div id="bdetails"> 
                    
<?php
session_start();
include '../database/dbconnect.php';


    $bid = $_POST['bid'];
    // Query to get book details
    $sql_book = "SELECT b.bname, b.bcategory, b.bauthor, COALESCE(ROUND(AVG(bl.stars), 0), 0) AS avgstars
                 FROM books b
                 LEFT JOIN booklog bl ON b.bid = bl.bid
                 WHERE b.bid = ?
                 GROUP BY b.bid";

    $stmt_book = $conn->prepare($sql_book);
    $stmt_book->bind_param("i", $bid);
    $stmt_book->execute();
    $result_book = $stmt_book->get_result();

    if ($result_book->num_rows > 0) {
        $row_book = $result_book->fetch_assoc();
        $bauthor = $row_book['bauthor'];
        $bname = $row_book['bname'];
        $bcategory = $row_book['bcategory'];
        $avgstars = $row_book['avgstars'];

        echo "<h1 class='text-lg font-bold'>Book Details</h1>";
        echo "<p> BOOK ID : $bid <br> NAME : $bname <br> CATEGORY : $bcategory <br>AUTHOR : $bauthor<br>";

        // Print stars
        for ($count = 0; $count < 5; $count++) {
            if ($count < $avgstars) {
                echo "<i class='bi bi-star-fill'></i>";
            } else {
                echo "<i class='bi bi-star'></i>";
            }
        }
        echo "</p>";
    }

    // Check book availability
    $sql_available = "SELECT available, copies FROM copies WHERE bid = ?";
    $stmt_available = $conn->prepare($sql_available);
    $stmt_available->bind_param("i", $bid);
    $stmt_available->execute();
    $result_available = $stmt_available->get_result();

    if ($result_available->num_rows > 0) {
        $row_available = $result_available->fetch_assoc();
        $available = $row_available['available'];
        $copies = $row_available['copies'];

        echo "<p>STATUS : ";
        if ($available > 0) {
            echo "Available";
        } else {
            // Check if the book is held by the user
            $uid = $_SESSION['id'];
            $sql_held = "SELECT COUNT(*) AS count FROM heldlog WHERE uid = ? AND bid = ? AND status = 1";
            $stmt_held = $conn->prepare($sql_held);
            $stmt_held->bind_param("ii", $uid, $bid);
            $stmt_held->execute();
            $result_held = $stmt_held->get_result();
            $row_held = $result_held->fetch_assoc();
            $count_held = $row_held['count'];

            //used to display the expected return date 
$sql_expected = "SELECT DATE_ADD(MIN(issue_date), INTERVAL 1 WEEK) AS lowest_return_date, tid
FROM booklog
WHERE bid = ? AND tid NOT IN (SELECT tid FROM heldlog WHERE status = 1)
GROUP BY tid";

$stmt_expected = $conn->prepare($sql_expected);
$stmt_expected->bind_param("i", $bid);
$stmt_expected->execute();
$result_expected = $stmt_expected->get_result();

if ($result_expected->num_rows > 0) {
echo "<h2>Status</h2>";
$row_expected = $result_expected->fetch_assoc();
$lowest_return_date = $row_expected['lowest_return_date'];
$tid = $row_expected['tid'];
echo "$tid Expected Return Date: $lowest_return_date <br>";
}


            if ($count_held == 0 && $copies > 0) {
                echo "Not Available <br>";
                if(isset($_SESSION['logged']))
                {
                echo "<form method='POST' action='InsertHeldbook.php' onsubmit='return confirm(\"Do you want to hold this book?\");'>
                <input type='hidden' value='$bid' name='bid'>
                <input type='hidden' value='$tid' name='tid'>
                <input type='submit' value='Hold Book'>
                </form>";
                }
                
                
           } else {
                echo "Not Available";
            }
        }
        echo "</p>";
    }



?>







            </div>
        </div>
<div class="child">




<?php
// Assuming you have a database connection

$bid = $_POST['bid'];
// Fetch data from the books table
$result = $conn->query("SELECT COUNT(*) AS book_count, stars
                        FROM booklog
                        WHERE bid = $bid AND stars != 0 AND stars IS NOT NULL
                        GROUP BY stars
                        ORDER BY COUNT(stars)");

// Initialize an array to hold star counts
$starCounts = [];

// Populate the array with the fetched star counts
while ($row = $result->fetch_assoc()) {
    $starCounts[$row['stars']] = $row['book_count'];
}



?>



    <div class="text-black rounded-lg p-6 w-full max-w-xs">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-lg font-bold">Customer reviews</h1>
        </div>

        <ul>
        <?php
$uid = $_SESSION['id'];  // Assuming $_SESSION['id'] contains the user ID

// Initialize $starCounts array
$starCounts = array();

// Fetch star counts data from the database or wherever you get it
// For example:
// $starCounts = array(1 => 10, 2 => 5, 3 => 8, 4 => 3, 5 => 12);

?>

<?php for ($i = 5; $i >= 1; $i--) : ?>
    <?php
    // If the current star count exists in the fetched data, use its count value
    // Otherwise, set the count to 0
    $count = isset($starCounts[$i]) ? $starCounts[$i] : 0;

    // Calculate the percentage width based on the count
    // Avoid division by zero error by checking if max($starCounts) is greater than 0
    $percentageWidth = ($count > 0 && max($starCounts) > 0) ? ($count / max($starCounts) * 100) : 0;
    ?>
    <li class="flex items-center mb-2">
        <i class="fas fa-shield-alt text-red-500 mr-2"></i>
        <span class="flex-1"><?php echo "$i stars"; ?></span>
        <span class="font-bold"><?php echo $count; ?></span>
        <div class="w-24 h-2 bg-gray-700 rounded-full ml-2">
            <div class="bg-yellow-500 h-2 rounded-full" style="width: <?php echo $percentageWidth; ?>%;"></div>
        </div>
    </li>
<?php endfor; ?>

        </ul>

    </div>
    </div>
    <div class="feedback"><h1 class="text-lg font-bold">Feedback</h1>
    <?php
$uid = $_SESSION['id'];
$bid = $_POST['bid'];

// Query to get feedback
$sql_feedback = "SELECT b1.uid, COALESCE(u.username, 'Unknown') AS username, b1.feedback
                 FROM booklog b1
                 LEFT JOIN members u ON b1.uid = u.uid
                 WHERE b1.bid = ? AND b1.feedback IS NOT NULL";

$stmt_feedback = $conn->prepare($sql_feedback);
if (!$stmt_feedback) {
    // Handle database error
    die("Error: " . $conn->error);
}

$stmt_feedback->bind_param("i", $bid);
$stmt_feedback->execute();
$result_feedback = $stmt_feedback->get_result();

if ($result_feedback) {
    if ($result_feedback->num_rows > 0) {
        echo "<h2>Feedback</h2>";
        while ($row_feedback = $result_feedback->fetch_assoc()) {
            $feedback = $row_feedback['feedback'];
            $username = $row_feedback['username'];
            $uid = $row_feedback['uid'];

            echo "<div class='msg'><p>UID: $uid  Username: $username</p><p>Feedback: $feedback</p><div class='msg-time'>$date</div></div>";
        }
    } else {
        echo "<p>No feedback</p>";
    }
} else {
    // Handle SQL execution error
    echo "Error executing SQL query: " . $stmt_feedback->error;
}

// Close prepared statement
$stmt_feedback->close();
?>

    </div>
</body>

</html>
