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
    <link rel="stylesheet" href="../styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/search.css">
    <script src = "../js/search.js"></script>
    <script>
        function valid(name,copy,available){
            if(available != copy){
                alert("Book cannot be deleted because it has been issued!!!");
                return false;
            }
            var result = confirm("Are you sure you want to delete book "+name+" and all its data permenantly?");
            if (result) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <style>
        .dbuttons, .ebuttons{
            border: 2px solid white;
            border-radius: 30px;
        }
        .dbuttons:hover{
            border: 2px solid red;
        }
        .ebuttons:hover{
            border: 2px solid green;
        }
        .modbuttons{
            white-space: nowrap;
        }
        .modbuttons form{
            display: inline-block;
            margin-right: 5px;
        }
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
        <h1>TOTAL BOOKS</h1>
        <button class ='homebutton'>home</button>
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
                <th>CATEGORY</th>
                <th>COPIES</th>
                <th>AVAILABLE</th>
                <th>MODIFY</th>
            </tr>
            </thead>
            <tbody>
                
            <?php
                include '../database/dbconnect.php';
                include '../database/checker.php';
                $sql = "SELECT * FROM viewbooks";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        // Access individual columns using the column name
                        $bid = $row['bid'];
                        $bname = $row['bname'];
                        $bauthor = $row['bauthor'];
                        $bprice = $row['bprice'];
                        $bcategory = $row['bcategory'];
                        $bcopy = $row['copies'];
                        $bavailable = $row['available'];
                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bprice</td><td>$bcategory</td><td>$bcopy</td><td>$bavailable</td>";
                        echo "<td class = 'modbuttons'>";
                        echo "<form method='POST' action = 'editbook.php'><input type = 'hidden' name = 'sent' value = '1'><input type = 'hidden' name = 'book' value = $bid><input type = 'hidden' name = 'bookname' value = $bname><input type = 'hidden' name = 'bauthor' value = '$bauthor'><input type = 'hidden' name = 'bprice' value = '$bprice'><input type = 'hidden' name = 'bcategory' value = '$bcategory'><input type = 'hidden' name = 'bcopy' value = '$bcopy'><input type = 'hidden' name = 'bavailable' value = '$bavailable'><button type = 'submit' class = 'ebuttons' name = 'edit'><i class='bi bi-pencil-square icon mb-2'></i></button></form>";
                        echo "<form method='post'><input type = 'hidden' name = 'book' value = $bid><input type = 'hidden' name = 'bookname' value = $bname><button class = 'dbuttons' name = 'delete' onclick = 'return valid(`$bname`,$bcopy,$bavailable)'><i class='bi bi-trash3-fill icon mb-2'></i></button></form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>

       
    </main>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include '../database/dbconnect.php';
        include '../database/checker.php';

        if(isset($_POST['delete'])){
            $bname = $_POST['bookname'];
            $bid = $_POST['book'];
            $sql1 = "delete from copies where bid = $bid";
            $result1 = $conn->query($sql1);
            $sql2 = "delete from books where bid = $bid";
            $result2 = $conn->query($sql2);
            echo "<script>location.replace(location.href);</script>";
        }
        $conn->close();
    }
    ?>
</body>
</html>
