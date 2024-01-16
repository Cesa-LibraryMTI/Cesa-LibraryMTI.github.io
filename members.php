<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        input[type="text"] {
            padding: 8px;
            width: 200px;
        }

        button {
            padding: 8px;
            cursor: pointer;
        }

        #miniTable {
            margin-top: 20px;
            width: 30%;
        }

        #miniTable, #miniTable th, #miniTable td {
            border: 1px solid #ddd;
        }

        #miniTable th, #miniTable td {
            padding: 5px;
            text-align: left;
        }

        #miniTable th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>

    <header>
        <h1>members</h1>
    </header>

    <main>
        <div>
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter your search">
            <button onclick="searchTable()">Search</button>
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
                        // Access individual columns using the column name
                        $id = $row['adno'];
                        $name = $row['name'];
                        

                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$adno</td><td>$name</td></tr>";
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


  