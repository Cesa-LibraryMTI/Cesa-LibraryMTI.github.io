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
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="../styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/search.css">
    <style>
        .mbuttons{
            border: 2px solid white;
            border-radius: 30px;
        }
        .mbuttons:hover{
            border: 2px solid red;
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
    <script src="../js/search.js"></script>
    <script>
        function valid(name){
            var result = confirm("Are you sure you want to delete user "+name+" permenantly?");
            if (result) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>
<body>

    <header>
        <h1>TOTAL MEMBERS</h1>
        <button class ='homebutton'>home</button>
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
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                include '../database/dbconnect.php';
                include '../database/checker.php';
                $sql = "SELECT uid,username FROM members";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        $uid = $row['uid'];
                        $name = $row['username'];
                        echo "<tr><td>$uid</td><td>$name</td><td>";
                        echo "<form method='post'><input type = 'hidden' name = 'user' value = $uid><button class = 'mbuttons' name = 'delete' onclick = 'return valid(`$name`)'><i class='bi bi-trash3-fill icon mb-2'></i></button></form></td></tr>";
                    }
                }
                $conn->close();
            ?>
            </tbody>
            <?php

                include '../database/dbconnect.php';
                include '../database/checker.php';
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $userid = $_POST['user'];
                    $sql = "delete from members where uid = $userid";
                    $conn->query($sql);
                    header("Refresh:0");
                }
                $conn->close();
            ?>
        </table>
    </main>
</body>
</html>


  