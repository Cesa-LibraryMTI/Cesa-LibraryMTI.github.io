<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/search.css">
    <script src="js/search.js"></script>
</head>
<body>

    <header>
        <h1>TOTAL MEMBERS</h1>
    </header>

    <main>
        <div>

            <form method="POST">
            <div class="search">
              <input type="text" class="search__input" id='myInput' placeholder="Type your text" onkeyup="searchTable()">
            </div>
            </form>
        </div>

        <table id="myTable">
            <thead>
                <tr>
                    <th>ad.no</th>
                    <th>name</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
                
                <?php
                include 'dbconnect.php';
                $sql = "SELECT uid,username FROM members";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        $uid = $row['uid'];
                        $name = $row['username'];
                        echo "<tr><td>$uid</td><td>$name</td><td><button><i class='bi bi-trash3-fill icon mb-2 text-blue-500'></i></button></td></tr>";
                    }
                }
                $conn->close();
            ?>
            </tbody>
        </table>

       
    </main>

    

</body>
</html>


  