
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOT RETURNED</title>
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
      
        /*search*/
        .search {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: center;
          }
          
          .search__input {
            font-family: inherit;
            font-size: inherit;
            background-color: #f4f2f2;
            border: none;
            color: #646464;
            padding: 0.7rem 1rem;
            border-radius: 30px;
            width: 12em;
            transition: all ease-in-out .5s;
            margin-right: -2rem;
          }
          
          .search_input:hover, .search_input:focus {
            box-shadow: 0 0 1em #00000013;
          }
          
          .search__input:focus {
            outline: none;
            background-color: #f0eeee;
          }
          
          .search__input::-webkit-input-placeholder {
            font-weight: 100;
            color: #ccc;
          }
          
          .search_input:focus + .search_button {
            background-color: #f0eeee;
          }
          
          .search__button {
            border: none;
            background-color: #f4f2f2;
            margin-top: .1em;
          }
          
          .search__button:hover {
            cursor: pointer;
          }
          
          .search__icon {
            height: 1.3em;
            width: 1.3em;
            fill: #b4b4b4;
          }
        /*search*/
    </style>

</head>
<body>

    <header>
        <h1>NOT RETURNED</h1>
    </header>

    <main>
        <div>

            <form action="membsearch.php" method="POST">
            <div class="search">
            <input type="text" class="search__input" placeholder="Type your text">
            <button class="search__button">
            <i class="bi bi-search"></i>
            </button>
            
            </form>
        </div>

        <table id="mainTable">
            <thead>
                <tr>
                <th>admisson no:</th>
                <th>name:</th>
                <th>ISSUE DATE:</th>
                <th>DAYS:</th>
                <th>FINE:</th>                    
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
        // Access individual columns using the column name
        $uid = $row['uid'];
        $name = $row['username'];

        // Fetch the issue_date from the booklog table
        $sql = "SELECT issue_date FROM booklog WHERE uid=$uid AND return_date is NULL";
        $res = $conn->query($sql);
        
        if ($res !== false && $res->num_rows > 0) {
            $rows = $res->fetch_assoc();
            $issue_date = $rows['issue_date'];

            // Calculate the difference in days between the current date and issue_date
            $sql = "SELECT DATEDIFF('$currentdate', '$issue_date') AS day";
            $res = $conn->query($sql);
            $days = $res->fetch_assoc()['day'];

            // Calculate the fine (assuming a fine of $10 per day for days > 15)
            $fine = ($days > 15) ? $days * 10 : 0;

            // Perform actions with the data (e.g., display or process)
            echo "<tr><td>$uid</td><td>$name</td><td>$issue_date</td><td>$days</td><td>$fine</td></tr>";
        } else {
            echo "<br><h1><font color='blue'><i>No records found in booklog for UID: $uid</i></font></h1><br>";
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

    
    <script>
      
        function searchTable() {
            // Implement your search logic here
            alert("Implement your search logic here.");
        }
    </script>

</body>
</html>
