<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/search.css">
    <script src = "js/search.js"></script>
</head>
<body>

    <header>
        <h1>TOTAL BOOK'S</h1>
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
            </tr>
            </thead>
            <tbody>
                
            <?php
                include 'dbconnect.php';
                $sql = "SELECT bid,bname,bauthor,bprice FROM books";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        // Access individual columns using the column name
                        $bid = $row['bid'];
                        $bname = $row['bname'];
                        $bauthor = $row['bauthor'];
                        $bprice = $row['bprice'];

                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bprice</td></tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>

       
    </main>

</body>
</html>
