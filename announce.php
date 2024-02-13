<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 0){
            header("Location: about.html");
            exit();
        }
        if($_SESSION['logged']==-1){
            header("Location: login.php");
            exit();
        }
    }else{
        header("Location: login.php");
        exit();
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaging App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



    <style>
        body {
          font-family: 'Lato', sans-serif;
          overflow: hidden;
        }
        body::-webkit-scrollbar {
    display: none;
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
          background-color: aliceblue;
        }
        .admin p{
          margin-left: 2px;
        }
        #refreshedContent{
          width: 100%; /* Set the width */
        height: 80%; /* Set the height */
        border: 1px solid #ccc; /* Optional: Add a border for visibility */
        overflow: auto;
        }
        #refreshedContent::-webkit-scrollbar {
          display: none;
        }
        #console,#consolelog{
          height: 5%;
          overflow: scroll;
        }
        #consolelog::-webkit-scrollbar,#console::-webkit-scrollbar{
          display: none;
        }
    </style>
</head>
<body class="bg-gray-200 p-10">
    <div class="max-w-md mx-auto bg-white rounded-md shadow overflow-hidden">
        <div class="p-4 space-y-2" id = 'refreshedContent'>
       
    </div>
    <div class="max-w-md mx-auto bg-white rounded-md shadow overflow-hidden">
    <div >
          <form method='POST' class="p-4 bg-gray-100 flex items-center">
            <input type="text" name="msg" placeholder="Type a message here..." class="w-full p-3 rounded-full focus:outline-none focus:ring" required>
            <input type='submit' value='Send' class="mr-2 text-blue-500">
          </form>
        </div>
       
    </div>
    <script>
            function refreshContent() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var div = document.getElementById('refreshedContent');
                        var previousContent = div.innerHTML;
                        div.innerHTML = xhr.responseText;
                        if (div.innerHTML !== previousContent) {
                          div.scrollTop = div.scrollHeight; 
                        }

                    }
                };
                xhr.open("POST", "listmessage.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send();
            }
            setInterval(refreshContent,100);
            
            </script>

    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['msg'];
    include 'dbconnect.php';
    date_default_timezone_set("Asia/Kolkata");
    session_start();
    $name=$_SESSION['name'];
    $sql = "INSERT INTO announce VALUES ('$name','$message',now())";
    $result = $conn->query($sql);
    if ($result) {
        echo "Message sent successfully";
    } else {
        echo "<p style = 'width: 5%;overflow: scroll;'>Error:  $conn->error</p>";
    }
    $conn->close();
}
?>
            
</body>
</html>