<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
        <table>
            <tr>
                <th>SI NO</th>
                <th>BOOK NAME</th>
                <th>AUTHOR</th>
                <th>PRICE</th>
            </tr>
            <?php
                include 'dbconnect.php';
                $sql = "SELECT sino,name,author,price FROM books";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        // Access individual columns using the column name
                        $id = $row['sino'];
                        $name = $row['name'];
                        $author = $row['author'];
                        $price = $row['price'];

                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$id</td><td>$name</td><td>$author</td><td>$price</td></tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
        </table>
    </div>
</body>
</html>