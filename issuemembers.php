<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/search.css">
    <style>
        .mbuttons{
            border: 2px solid white;
            border-radius: 30px;
        }
        .mbuttons:hover{
            border: 2px solid red;
        }
    </style>
    <script src="js/search.js"></script>
    <script>
        function valid(bid,uid){
            var result = confirm("Book : "+bid+" to User "+uid+" Are you sure you want to issue?");
            if (result) {
                alert("Book Issued");
                return true;
            } else {
                alert("Book Not Issued");
                return false;
            }
        }
    </script>
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
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
            
                <?php
                include 'dbconnect.php';
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $bid = $_POST['bid'];
                }
                $sql = "SELECT uid,username FROM members WHERE uid NOT IN (SELECT uid from booklog WHERE return_date is NULL)";
                $result = $conn->query($sql);

                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        $uid = $row['uid'];
                        $name = $row['username'];
                        echo "<tr><td>$uid</td><td>$name</td><td>";
                        echo "<form method='post' action = 'delete_user.php'><input type = 'hidden' name = 'user' value =$bid><button class = 'mbuttons' name = 'issue' onclick = 'return valid($bid,$uid)'><i class='bi bi-cart-fill'></i></button></form></td></tr>";
                    }
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </main>
</body>
</html>


  