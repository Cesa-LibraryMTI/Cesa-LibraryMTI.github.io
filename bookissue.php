<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="styles/tables.css">
    <link rel="stylesheet" href="styles/search.css">
    <script src = "js/search.js"></script>
</head>
<body>

    <header>
        <h1>Book Issue</h1>
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
                    <th>Book id</th>
                    <th>book name</th>
                    <th>Author</th>
                    <th>category</th>
		            <th>Price</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include 'dbconnect.php';

                        $sql="SELECT * FROM books WHERE bid NOT IN (SELECT bid FROM booklog WHERE return_date is NULL)";
                        $result=$conn->query($sql);
                        if(($result != false)&&($result->num_rows > 0))
                        {
                            while($row=$result->fetch_assoc()){
                                $bid = $row['bid'];
                                $bname= $row['bname'];
                                $bauthor=$row['bauthor'];
                                $bprice=$row['bprice'];
                                $bcategory=$row['bcategory'];
                                echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bcategory</td><td>$bprice</td></tr>";
                            }
                        }
                        

                    ?>

                    
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </main>

   
</body>
</html>


  