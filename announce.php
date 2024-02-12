
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaging App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    


    <style>
        body {
          font-family: 'Lato', sans-serif;
        }
        .msg {
          max-width: 75%;
          margin-bottom: 0.75rem;
          padding: 0.5rem 1rem;
          border-radius: 25px;
        }
        .incoming {
          background-color: #EBF4FF;
          align-self: flex-start;
        }
        .outgoing {
          background-color: #DCF8C6;
          align-self: flex-end;
        }
        .msg-time {
          color: #999;
          font-size: 0.75rem;
          text-align: right;
          margin-top: 0.25rem;
        }




        .admin{
          border-radius: 20px;
          background-color: grey;
        }
    </style>
</head>
<body class="bg-gray-200 p-10">
    <div class="max-w-md mx-auto bg-white rounded-md shadow overflow-hidden">
        <div class="p-4 space-y-2">
          
            <div class="msg incoming">
              <div>Admin Name</div>
                Hi Laura, is your charming boat available for this weekend to enjoy the beautiful ocean?
                <div class="msg-time">10:11 AM</div>
            </div>
            
            
            <?php
              include 'dbconnect.php';
              $sql="SELECT * FROM announce";
              $result = $conn->query($sql);

                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $message = $row['message'];
                        $date = $row['date'];
                        
                        echo "<div class='msg outgoing'><div class='admin'>$name</div>$message<div class='msg-time'>$date</div></div>";
                    }
                }
            ?>
        <div class="p-4 bg-gray-100 flex items-center">
          <form method='POST'>
            <input type="text" name="msg" placeholder="Type a message here..." class="w-full p-3 rounded-full focus:outline-none focus:ring" required>
            <input type='submit' value='Send' class="mr-2 text-blue-500">
          </form>
        </div>
    </div>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['msg'];
    include 'dbconnect.php';
    date_default_timezone_set("Asia/Kolkata");
    session_start();
    $name=$_SESSION['name'];
    $sql = "INSERT INTO announce VALUES ('$name','$message', '" . date('Y-m-d') . "')";
    $result = $conn->query($sql);

    if ($result) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>