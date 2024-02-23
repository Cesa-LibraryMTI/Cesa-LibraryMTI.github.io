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

  
  
    
  <style>
        .rating {
  display: flex;
  flex-direction: row-reverse;
 /* Reverse the order of the stars */
  font-size: 0;
 /* Remove the space between the elements */
}

.rating input[type="radio"] {
  
    display: none;

 /* Hide the radio buttons */
}

.rating label {
  font-size: 30px;
  color: rgba(187, 183, 183, 0.726);
 /* Empty star color */
  margin: 0 2px;
  cursor: pointer;
}

.rating label:before {
  content: "\2605";
 /* Unicode character for filled star */
}

.rating input[type="radio"]:checked ~ label:before {
  content: "\2606";
 /* Unicode character for empty star */
  color: #ffffff;
 /* Filled star color */
}
textarea{
    color: black;
}
.Feedbackbox{
    display: flex;
    
    width : 100%;
    height: 40% ;

    
}
.Feedbackbox textarea{
    resize: none;
    flex-wrap: wrap;

}


       
      .modal {
            
            display: flex;
            margin-top: 30px;
            
            
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .modal-content {
          background: #075E54;
            padding: 2rem;
            border-radius: 1rem;
            width: 90%;
            max-width: 400px;
        }
        .close-btn {
            color: #ffffff;
            float: right;
            font-size: 1.5rem;
        }
        .button {
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            margin-top: 40px;
            cursor: pointer;
            margin-left: 5px;
        }
        .submit-btn {
            float: right;
        }
    </style>
    
        
       <div class='modal' id='modal'>
        <div class='modal-content text-white'>
            <div class='close-btn'>&times;</div>
            
            <h2 class='text-xl mb-2'>How was your ?</h2>
            <p>Your answer is anonymous. WhatsApp uses it to help improve your call experience</p>
            <form method="post">
            <div class='rating'>
                <input value='5' name='rating' id='star5' type='radio'>
                <label for='star5'></label>
                <input value='4' name='rating' id='star4' type='radio'>
                <label for='star4'></label>
                <input value='3' name='rating' id='star3' type='radio'>
                <label for='star3'></label>
                <input value='2' name='rating' id='star2' type='radio'>
                <label for='star2'></label>
                <input value='1' name='rating' id='star1' type='radio'>
                <label for='star1'></label>
              </div>
              <label>Feedback</label>
              <div class='Feedbackbox'><textarea  name='Feedback' class='Feedback' rows='3' cols='60'></textarea></div>
            <div class='actions mt-6'>
                
                <button class='button' onclick='closeDiv()'>Not now</button>
                <input type='submit' class='button submit-btn'>
                </form>
            </div>
        </div>
    </div>

  

</body>
</html>


