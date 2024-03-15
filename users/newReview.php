<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
        <style>
        body {
            margin: 0;
            background-color: #1e2125;
            color: white;
        }

        .msg {
            margin-top: 40px;
            margin-left: 10px;
            max-width: 75%;
            margin-bottom: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: #343a40;
        }

        .msg-time {
            font-size: 0.75rem;
            text-align: right;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <?php
        session_start();
       include '../database/dbconnect.php';
        

       $uid = $_SESSION['id'];
        
    
       $sql="SELECT b.bid, b.bname, b1.return_date 
       FROM booklog b1 
       LEFT JOIN books b ON b1.bid = b.bid 
       WHERE b1.stars IS NULL AND b1.uid IN ($uid)";

          $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bid = $row['bid'];
                $bname = $row['bname'];
                $return_date = $row['return_date']; 

                echo "<div class='msg incoming'><div class='username'><p>How was the book $bname ?</p>
                    </div><form method='POST' action='writeReview.php' name='form1'>
                    <input type='hidden' name='bid' value='$bid'>
                    <input type='hidden' name='uid' value='$uid'>
                    <input type='hidden' name='bname' value='$bname'>
                    <input type='submit' value='click here to add review'></form>
                    <div class='msg-time'>$return_date</div></div>";
            }
        }
        else echo "<h2>No Reviews Available</h2>";
        ?>
    
    <script>
    // Automatically scroll to the bottom of the page
    window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    };
</script>

</body>
</html>