<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/members.css">
    <link rel="stylesheet" href="../styles/search.css">
    <script src = "../js/search.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<header>
        <h1>HELD BOOK</h1>
    </header>

    <main>
        <div>

            <form method="POST">
            <div class="search">
            <input type="text" class="search__input" id = "myInput" placeholder="Type your text" onkeyup="searchTable()">
            </form></div>
        </div>

        <table id="myTable">
            <thead>
            <tr>
                <th>SI NO</th>
                <th>BOOK NAME</th>
                <th>AUTHOR</th>
                <th>PRICE</th>
                <th>CATEGORY</th>
                <th>Held Book</th>
                
            </tr>
            </thead>
            <tbody>
            <?php    
            include '../database/dbconnect.php';
          
    session_start();
    
    $uid=$_SESSION['id'];


// Select relevant data from the members table
    $sql="SELECT * FROM books WHERE bid IN (SELECT bid FROM copies WHERE available = 0)";
    $result = $conn->query($sql);
    if ($result !== false && $result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $bid = $row['bid'];            
            $bname = $row['bname'];
            $bauthor = $row['bauthor'];
            $bprice = $row['bprice'];
            $bcategory = $row['bcategory'];
            echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bprice</td><td>$bcategory</td><td><form method='POST'><input type='hidden' name ='bid' value ='$bid'><input type='hidden' name ='bname' value ='$bname'><input type='submit'></form></td><tr>";
        }

    } 
    else
    {
        echo "<br><h1><font color='blue'><i>No records found</i></font></h1><br>";
    }
?>
    </tbody>
    </table>
    </main>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $bid = $_POST['bid'];
    $uid = $_SESSION['id'];
    $bname=$_POST['bname'];
    // Using prepared statement to prevent SQL injection
    $sqlCheck = "SELECT COUNT(uid) as cn FROM heldlog WHERE uid = ? AND status = 1";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("i", $uid); // Assuming $uid is an integer, adjust the type accordingly
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();
    $stmtCheck->close();
    

    if ($count != 0) {
        echo "<script>alert('Only one book can be held by a person');</script>";
        
    } else {
        // Continue with your logic to generate heldid and insert into the database
        do {
            $heldid = rand(1, 100000000);
            $sqlCount = "SELECT COUNT(heldid) as cn FROM heldlog WHERE heldid = ?";
            $stmtCount = $conn->prepare($sqlCount);
            $stmtCount->bind_param("i", $heldid);
            $stmtCount->execute();
            $stmtCount->bind_result($c);
            $stmtCount->fetch();
            $stmtCount->close();
        } while ($c != 0);

        $currentDate = date("Y-m-d");
        $sqlInsert = "INSERT INTO heldlog (heldid, bid, uid, held_date) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("iiis", $heldid, $bid, $uid, $currentDate);
        $stmtInsert->execute();
        $stmtInsert->close();
        echo "<script>alert('held book $bname succesfully ');</script>";
    }
}

// Close the database connection
$conn->close();
?>
