<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="styles/members.css">
</head>
<body>

    <header>
        <h1>members</h1>
    </header>

    <main>
        <div>
            <form action="membsearch.php" method="POST">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter your search">
            <input type="submit" value="Search">
            </form>
        </div>

        <table id="mainTable">
            <thead>
                <tr>
                    <th>ad.no</th>
                    <th>name</th>
                    
                </tr>
            </thead>
            <tbody>
                
                <?php
                include 'dbconnect.php';
                $sql = "SELECT adno,name FROM members";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['adno'];
                        $name = $row['name'];
                        echo "<tr><td>$id</td><td>$name</td></tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
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


  