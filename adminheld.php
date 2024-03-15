
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
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/search.css">
    <script src = "js/search.js"></script>
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
        <h1>Held books</h1>
        <a href="../index.php"><button class ='homebutton'>HOME</button></a>
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
                <th>HELD ID</th>
                <th>TRANSACTION ID</th>
                <th>BOOK ID</th>
                <th>BOOK NAME</th>
                
                
                <th>USER ID</th>
                <th>USER NAME</th>
                <th>HELD DATE</th>
                <th>MODIFY</th>
            </tr>
            </thead>
            <tbody>
                
            <?php
include 'database/dbconnect.php';
include 'database/checker.php';

$sql = "SELECT m.uid, m.username, b.heldid, b.bid, b.held_date, b.tid, COALESCE(bkl.return_date , NULL) as return_date, bk.bname 
        FROM members m
        LEFT JOIN heldlog b ON m.uid = b.uid
        LEFT JOIN books bk ON b.bid = bk.bid
        LEFT JOIN booklog bkl ON b.tid = bkl.tid
        WHERE status = 1";

$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $heldid = $row['heldid'];
        $tid = $row['tid'];
        $bid = $row['bid'];
        $uid = $row['uid'];
        $username = $row['username'];
        $held_date = $row['held_date'];
        $bname = $row['bname'];
        $return_date = $row['return_date'];

        echo "<tr><td>$heldid</td><td>$tid</td><td>$bid</td><td>$bname</td><td>$uid</td>
              <td>$username</td><td>$held_date</td>";
        if( $return_date != NULL)
        {
            echo "<td><form method='POST' action ='adminheldissue.php' onsubmit='return confirm(\"Do you want to hold this book?\");'>
            <input type = 'hidden' name ='heldid' value = $heldid>
            <input type = 'hidden' name ='uid' value = $uid>
            <input type = 'hidden' name ='bid' value = $bid>
            <button type = 'submit' class = 'ebuttons' name = 'edit'>
            <i class='bi bi-cart-fill'></i></button></form>
            </td></tr>";
        }
        else
        {
            echo "<td>Waiting..</td></tr>";
        }

    }
}   
else 
{
    echo "<h2>NO BOOKS HELD </h2>";
}

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
