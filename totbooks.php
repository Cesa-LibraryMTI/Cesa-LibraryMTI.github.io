<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESA Library</title>
    <style>
        body {
            background-color: grey; 
            margin: 0; 
            font-family: Arial, sans-serif; 
        }

        .DASHBOARD {
            text-align: center;
            padding: 20px;
        }

        .accname {
            padding: 5px;
        }

        .general {
            background-color: rgb(78, 255, 101);
            padding: 20px;
            border-radius: 20px;
            margin-top: 20px; /* Added margin to separate from the above content */
        }

        .selection {
            margin: 10px 5px; /* Adjusted margin */
            width: 30%;
            border-radius: 10px;
            padding: 10px;
            background-color: white; /* Added a background color */
            cursor: pointer; /* Added a pointer cursor on hover */
        }

        .selection img {
            display: block;
            margin: 0 auto; /* Centered image */
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
    </style>
</head>
<body>
    <div class="DASHBOARD">
        <div class="accname">
          
        </div>
        <br>
        <div class="general">
            <h3><u>CATEGORY</u></h3>
            <a href="membersonline.html" target="main">
                <button  class="selection">
                <img src="images/membonline.jpg" width="20%" height="20%" alt="Members Online">
                <p>C</p>
            </button></a>

            <a href="notreturned.html" target="main"><button class="selection">
                <img src="images/membonline.jpg" width="20%" height="20%" alt="Not Returned">
                <p>C++</p>
            </button></a>

            <button class="selection">
                <img src="images/java.jpg" width="20%" height="18%" alt="Total Books">
                <p>JAVA</p>
            </button>
        
        <br>
        <button class="selection">
            <img src="images/js.jpg" width="20%" height="20%" alt="Issue Book">
            <p>JAVA SCRIPT</p>
        </button>

        <button class="selection">
            <img src="images/newbook.png" width="20%" height="20%" alt="Add New Book">
            <p>PHP</p>
        </button>

        <button onclick="membersonline.html" target="main" class="selection">
            <img src="images/settings.png" width="20%" height="20%" alt="Settings">
            <p>PYTHON</p>
        </button>
    </div>
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
