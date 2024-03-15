<?php
    
    //used to update the heldlog status
    include 'database/dbconnect.php';
    $sql="UPDATE heldlog
    SET status = 0
    WHERE held_date < DATE_SUB(NOW(), INTERVAL 1 WEEK);";
    $conn->query($sql);
?>


<html>
    <head><title>Book Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php
session_start();
include '../database/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        echo "<h1>Book Details</h1>";
        echo "<p>ID: $bid <br>Name: $bname <br>Category: $bcategory <br>Author: $bauthor<br>";

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

        echo "<p>Status: ";
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
                echo "<form method='POST' action='InsertHeldbook.php' onsubmit='return confirm(\"Do you want to hold this book?\");'>
                <input type='hidden' value='$bid' name='bid'>
                <input type='hidden' value='$tid' name='tid'>
                <input type='submit' value='Hold Book'>
                </form>";

                
                
           } else {
                echo "Not Available";
            }
        }
        echo "</p>";
    }

    // Query to get feedback
    $sql_feedback = "SELECT b1.uid, COALESCE(u.username, 'Unknown') AS username, b1.feedback
                     FROM booklog b1
                     LEFT JOIN members u ON b1.uid = u.uid
                     WHERE b1.bid = ? AND b1.feedback IS NOT NULL";

    $stmt_feedback = $conn->prepare($sql_feedback);
    $stmt_feedback->bind_param("i", $bid);
    $stmt_feedback->execute();
    $result_feedback = $stmt_feedback->get_result();
    
    if ($result_feedback->num_rows > 0) {
        echo "<h2>Feedback</h2>";
        while ($row_feedback = $result_feedback->fetch_assoc()) {
            $feedback = $row_feedback['feedback'];
            $username = $row_feedback['username'];
            echo "<p>UID: $uid, Username: $username, Feedback: $feedback</p>";
        }
    } else {
        echo "<p>No feedback</p>";
    }

    $stmt_book->close();
    $stmt_feedback->close();
    $stmt_available->close();
}
?>






</body>
</html>