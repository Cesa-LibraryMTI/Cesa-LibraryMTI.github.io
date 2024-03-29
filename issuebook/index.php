<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 0){
            header("Location: ../users/");
            exit();
        }
        if($_SESSION['logged']==-1){
            header("Location: ../login/");
            exit();
        }
    }else{
        header("Location: ../login/");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="../styles/tables.css">
    <link rel="stylesheet" href="../styles/search.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src = "../js/search.js"></script>
   <style>
        .homebutton{
            color: #fff;
            padding: 8px 22px;
            border-radius: 6px;
            background: #7d2ae8;
            transition: all 0.2s ease;  
        }
        .homebutton:active{
            transform: scale(0.96);
        }
    </style>
</head>
<body>

    <header>
        <h1>Book Issue</h1>
        <a href="../index.php"><button class ='homebutton'>HOME</button></a>
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
                    <th>Issue</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include '../database/dbconnect.php';
                        include '../database/checker.php';
                        $sql="SELECT b.*
                        FROM books b
                        LEFT JOIN copies c ON b.bid = c.bid AND c.available = 0
                        LEFT JOIN heldlog h ON b.bid = h.bid AND h.status = 1
                        WHERE c.bid IS NULL AND h.bid IS NULL";
                        $result=$conn->query($sql);
                        if(($result != false)&&($result->num_rows > 0))
                        {
                            while($row=$result->fetch_assoc()){
                                $bid = $row['bid'];
                                $bname= $row['bname'];
                                $bauthor=$row['bauthor'];
                                $bprice=$row['bprice'];
                                $bcategory=$row['bcategory'];
                                echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bcategory</td><td>$bprice</td><td><form action='issuemembers.php' method='POST'><input type='hidden' name ='bid' value ='$bid'><input type='hidden' name ='bname' value ='$bname'><button class = 'mbuttons' name = 'issue' ><i class='bi bi-cart-fill'></i></button></form></td></tr>";
                            }
                        }
                        $conn->close();
                    ?>

                    
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </main>

   
</body>
</html>


  