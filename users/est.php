
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Close Div Example</title>
    <link rel='stylesheet' href='est.css'>
    <style>
        
        .messagebox{
            min-width: 30%;
            min-height: 40%;
            color: white;
            background-color: black;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
    </style>
</head>
<body>

    
    <?php
        include 'dbconnect.php';

        
        session_start();
        if($_SESSION['logged'] == 0){

            $uname=$_SESSION['name'];
            $sql = "SELECT uid FROM members WHERE username='$uname'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $uid = $row['uid'];


            $sql = "SELECT bname FROM books where bid IN (SELECT bid FROM booklog WHERE stars IS NULL AND return_date IS NOT NULL AND uid = $uid)";
            
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $date = $row['date'];
                $message = $row['message'];
                $name = $row['name'];
                echo "<div id='myDiv'>";
                echo "<div id='messagebox'>name: $name <br>message: $message<br>";
                echo "<button onclick='closeDiv()' class='close'>Close</button></div></div>";
            }
        }
    }
    
    ?>
    
 

    <script>
        function closeDiv() {
            var box = document.getElementByID('messagebox');
            box.style.display = 'none';
        }
    </script>

</body>
</html>
