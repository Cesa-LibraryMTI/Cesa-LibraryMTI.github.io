<?php
    //there is no checking given at in this code to 
    // chek whether there is session or not 
    // correct it 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <h1>
    <?php
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

        echo "id: $bid <br>name: $bname <br>category: $bcategory <br>Author: $bauthor<br>";

        for ($count = 0; $count < 5; $count++) {
            if($count < $avgstars) echo "<i class='bi bi-star-fill'></i>";
            else echo "<i class='bi bi-star'></i>";
        }
    }


    $sql_available = "SELECT available
                 FROM copies
                 WHERE bid = ? ";

    $stmt_available = $conn->prepare($sql_available);
    $stmt_available->bind_param("i", $bid);
    $stmt_available->execute();
    $result_available = $stmt_available->get_result();

        $row_available = $result_available->fetch_assoc();
        $available = $row_available['available'];
        if($available > 0) echo "<br>Status: Available ";
        else 
        {
            echo "reached else of status available";
            $uid=$_SESSION['id'];
            echo "<br>Status: Not Available <br>";
            $sqlCheck = "SELECT COUNT(uid) as cn FROM heldlog WHERE uid = ? AND status = 1";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("i", $uid); // Assuming $uid is an integer, adjust the type accordingly
            $stmtCheck->execute();
            $stmtCheck->bind_result($count);
            $stmtCheck->fetch();
            $stmtCheck->close();
    

    if ($count == 0) {
        //echo "<script>alert('Only one book can be held by a person');</script>";
        $sqlCheck = "SELECT COUNT(bid) as countbid FROM heldlog WHERE bid = ? AND status = 1";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $bid); // Assuming $uid is an integer, adjust the type accordingly
        $stmtCheck->execute();
        $stmtCheck->bind_result($countbid);
        $stmtCheck->fetch();
        $stmtCheck->close();
        if($countbid < $available)
        {
            //echo "<form method='POST' action='test'><input type='button' value='held book'>";
            echo "you can held this book";
        }
        
    } 
}

    // Query to get feedback
    $sql_feedback = "SELECT u.username, b1.feedback
                     FROM booklog b1
                     LEFT JOIN members u ON b1.uid = u.uid
                     WHERE b1.bid = ? AND b1.feedback IS NOT NULL";

    $stmt_feedback = $conn->prepare($sql_feedback);
    $stmt_feedback->bind_param("i", $bid);
    $stmt_feedback->execute();
    $result_feedback = $stmt_feedback->get_result();
    
    if ($result_feedback->num_rows > 0) {
        echo "<br><br>feedback";
        while ($row_feedback = $result_feedback->fetch_assoc()) {
            $feedback = $row_feedback['feedback'];
            $username = $row_feedback['username'];
            echo "<h3>$username : $feedback </h3><br>";
        }
    } else {
        echo "<br><br>No feedback";
    }


    $stmt_book->close();
    $stmt_feedback->close();
    $stmt_available->close();
}

?>
    
    </h1>
</body>
</html>