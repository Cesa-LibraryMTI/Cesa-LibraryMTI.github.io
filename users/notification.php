

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages and Review</title>
    <style>
        body {
            margin: 0;
            background-color: green;
        }

        ul {
            border-radius: 20px;
            list-style-type: none;
            margin: 5px 0 0 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #04AA6D;
        }

        .incoming {
            background-color: #EBF4FF;
        }

        .msg {
            margin-top: 40px;
            min-width: 50%;
            max-width: 75%;
            margin-bottom: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }

        .msg-time {
            color: #999;
            font-size: 0.75rem;
            text-align: right;
            margin-top: 0.25rem;
        }
        
    </style>


<script>
function messageFunction() {
    var mess = document.getElementById('messages');
    mess.style.display = 'block'; // Show the Messages div
    var me = document.getElementById('review');
    me.style.display = 'none';    // Hide the Review div
    document.getElementById("mb").classList.add("active");
    document.getElementById("rb").classList.remove("active");
}

function reviewFunction() {
    var me = document.getElementById('review');
    me.style.display = 'block'; // Show the Review div
    var mess = document.getElementById('messages');
    mess.style.display = 'none'; // Hide the Messages div
    document.getElementById("mb").classList.remove("active");
    document.getElementById("rb").classList.add("active");
}


        function closeDiv() {
            var box = document.getElementById('modal');
            box.style.display = 'none';
        }
        function openDiv() {
            var box = document.getElementById('modal');
            box.style.display = 'flex';
        }

    </script>
</head>

<body>

    <ul>
        <li><a class="active" id = "mb" onclick="reviewFunction()">Messages</a></li>
        <li> <a  id = "rb" onclick="messageFunction()">Review</a></li>
    </ul>

    <div id="messages" style="padding:20px;margin-top:30px;background-color:#1abc9c;height:1500px;">
        <?php
        include '../database/dbconnect.php';
        $oneWeekBefore = date('Y-m-d', strtotime('-1 week'));
        $currentDate = date('Y-m-d');
        $sql = "SELECT message, date FROM announce WHERE date BETWEEN '$oneWeekBefore' AND '$currentDate'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = $row['message'];
                $date = $row['date'];
                echo "<div class='msg incoming'><div class='username'><p>ADMIN</p></div><p>$message</p><div class='msg-time'>$date</div></div>";
            }
        }else echo "<h2>No Messages Available</h2>";
        ?>
    </div>

    <div id='review' style="display: none; padding:20px;margin-top:30px;background-color:#1abc9c;height:1500px;">
        <?php
        session_start();
       
        

       // $uid = $_SESSION['id'];
       $uid=12582; 
       $sql = "SELECT bid, bname FROM books WHERE bid IN (SELECT bid FROM booklog WHERE stars IS NULL AND uid IN ($uid))";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bid = $row['bid'];
                $bname = $row['bname']; 

                echo "<div class='msg incoming'><div class='username'><p>How was the book $bname ?</p>
                    </div><form method='POST' action='whatsapp.php' name='form1'>
                    <input type='hidden' name='bid' value='$bid'>
                    <input type='hidden' name='uid' value='$uid'>
                    <input type='hidden' name='bname' value='$bname'>
                    <input type='submit' value='click here to add review'></form>
                    <div class='msg-time'>date</div></div>";
            }
        }
        else echo "<h2>No Reviews Available</h2>";
        ?>
        
    </div>
</body>

</html>
