
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOT RETURNED</title>
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/search.css">
    <script src="js/search.js"></script>
    <style>
        .mbuttons{
            border: 2px solid white;
            border-radius: 30px;
        }
        .mbuttons:hover{
            border: 2px solid red;
        }
    </style>
     <script>
        function valid(){
            var result = confirm("Are you sure you want to proceed?");
            if (result) {
                alert("User deleted");
                return true;
            } else {
                alert("User not deleted");
                return false;
            }
        }
    </script>
</head>
<body>

    <header>
        <h1>NOT RETURNED</h1>
    </header>

    <main>
        <div>

            <form action="membsearch.php" method="POST">
            <div class="search">
            <input type="text" class="search__input" id ="myInput" placeholder="Type your text" onkeyup="searchTable()">
            </form></div>
        </div>

        <table id="myTable">
            <thead>
                <tr>
                <th>admisson no:</th>
                <th>name:</th>
                <th>ISSUE DATE:</th>
                <th>DAYS:</th>
                <th>FINE:</th>
                <th>RETURN</th>                    
                </tr>
            </thead>
            <tbody>
                
            <?php
include 'dbconnect.php';

// Get the current date
$sql = "SELECT CURDATE() AS currentdate";
$result = $conn->query($sql);
$currentdate = $result->fetch_assoc()['currentdate'];

// Select relevant data from the members table
$sql = "SELECT uid, username FROM members WHERE uid IN (SELECT uid FROM booklog WHERE return_date is NULL)";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uid = $row['uid'];
        $name = $row['username'];

        // Fetch the issue_date from the booklog table
        $sql = "SELECT tid,issue_date FROM booklog WHERE uid=$uid AND return_date is NULL";
        $res = $conn->query($sql);
        
        if ($res !== false && $res->num_rows > 0) {
            $rows = $res->fetch_assoc();
            $tid = $rows['tid'];
            $issue_date = $rows['issue_date'];

            // Calculate the difference in days between the current date and issue_date
            $sql = "SELECT DATEDIFF('$currentdate', '$issue_date') AS day";
            $res = $conn->query($sql);
            $days = $res->fetch_assoc()['day'];

            // Calculate the fine (assuming a fine of $10 per day for days > 15 and $30 for days > 30)
            $fine = ($days > 15) ? (($days > 30) ?15*10+($days-30)*20:($days-15)*10) : 0;

            // Perform actions with the data (e.g., display or process)
            echo "<tr><td>$uid</td><td>$name</td><td>$issue_date</td><td>$days</td><td>$fine</td><td>";
            echo "<form method='post' action = 'return_book.php'><input type = 'hidden' name = 'tid' value = $tid><button class = 'mbuttons' name = 'returned' onclick = 'return valid()'><i class='bi bi-arrow-return-left icon mb-2'></i></button></form></td></tr>";
        }
    }
} else {
    echo "<br><h1><font color='blue'><i>No records found</i></font></h1><br>";
}

// Close the database connection
$conn->close();
?>
            </tbody>
        </table>

       
    </main>
</body>
</html>
