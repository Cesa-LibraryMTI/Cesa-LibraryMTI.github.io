<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 0){
            header("Location: ../about.html");
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
    <link rel="stylesheet" href="../styles/search.css">
    
    <link rel="stylesheet" href="../styles/tables.css">
</head>
<body>

    <header>
        <h1>LOGS</h1>
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
                <th>id</th>
                <th>details</th>
                <th>date and time</th>
            </tr>
            </thead>
            <tbody>
                
            <?php
                include '../database/dbconnect.php';
                $sql = "SELECT logid,details,loggeddatetime as dat FROM log";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        // Access individual columns using the column name
                        $id = $row['logid'];
                        $det = $row['details'];
                        $dat = $row['dat'];

                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$id</td><td>$det</td><td>$dat</td></tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>

       
    </main>
    <script src = "../js/search.js"></script>
</body>
</html>