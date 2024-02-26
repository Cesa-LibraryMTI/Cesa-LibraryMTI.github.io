<!DOCTYPE html>
<html>
<head>


<style>
body {margin:0;}

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
      mess.style.display = 'none'; // Use quotes around 'none';
      var me = document.getElementById('modal');
      me.style.display = 'block';
    }
    function reviewFunction() {
      var me = document.getElementById('modal');
      me.style.display = 'none'; // Use quotes around 'none';
      var mess = document.getElementById('messages');
      mess.style.display = 'block';
    }
  </script>
    </head>
    <body>

<ul>
    <li><a class="active" href="#" onclick="reviewFunction()">Messages</a></li>
    <li><a href="#" onclick="messageFunction()">Review</a></li>
  </ul>

  <div id="messages">
    <div style="padding:20px;margin-top:30px;background-color:#1abc9c;height:1500px;">
    <?php
        include '../database/dbconnect.php';
        $oneWeekBefore = date('Y-m-d', strtotime('-1 week'));
        $currentDate = date('Y-m-d');
        $sql = "SELECT message,date FROM announce WHERE date BETWEEN '$oneWeekBefore' AND '$currentDate'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
                while ($row = $result->fetch_assoc()) 
                {
                    $message = $row['message'];
                    $date = $row['date'];   
                    echo "<div class='msg incoming'><div class='username'><p>ADMIN</p></div><p>$message</p><div class='msg-time'>$date</div></div>";     
                    
                
                }
        }
?>
    </div>
  </div>
    <div id='modal' style="padding:20px;margin-top:30px;background-color:#1abc9c;height:1500px;">
    <?php
        include '../database/dbconnect.php';
        session_start();
        $uname=$_SESSION['name'];
        $sql = "SELECT uid FROM members WHERE username = '$uname'";

        $result = $conn->query($sql); 
        $ro= $result->fetch_assoc();
        $uid=$ro['uid'];

        $sql = "SELECT bid, bname FROM books WHERE bid IN (SELECT bid FROM booklog WHERE stars IS NULL AND uid IN ($uid))";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
                while ($row = $result->fetch_assoc()) 
                {
                    
                    $bid = $row['bid'];
                    $bname = $row['bname'];
                    
                    echo "<div class='msg incoming'><div class='username'><p>How was the book $bname ?</p></div><p><a>click here to add review</a></p><div class='msg-time'>$date</div></div>";       
                    
                
                }
        }

?>
  
  </h1>
    </div>
  

    
      
  
    
  

  

</body>
</html>


