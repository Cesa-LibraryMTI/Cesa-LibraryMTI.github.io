<?php
    session_start();
    include '../database/dbconnect.php';
    //to display popup messages
    if(isset($_SESSION['logged']))
    {
        $totalcount = 1;
        if(isset($_COOKIE['count'])){
            $totalcount = $_COOKIE['count'];
            $totalcount++;
        }
        setcookie('count',$totalcount);
        if($totalcount == 1){
            include 'usernotification.php';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizontal Scrollable Div</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel='stylesheet' href='usernotification.css'>
    <style>
        /* scrolling */
        @import "https://unpkg.com/open-props";
        @import "https://unpkg.com/open-props/normalize.min.css";
        
        .container {
            inline-size: min(100% - 4rem, 70rem);
            margin-inline: auto;
        }

        .media-scroller {
            display: grid;
            gap: var(--size-4);
            grid-auto-flow: column;
            grid-auto-columns: 30%;
            height: 300px;


            padding: 0 var(--size-2) var(--size-2);

            overflow-x: auto;
            overscroll-behavior-inline: contain;
        }

        .media-element {
            background-color: black;
            display: grid;
            grid-template-rows: min-content;
            gap: var(--size-2);
            padding: var(--size-3);
            background: var(--surface-2);
            border-radius: var(--radius-2);
            box-shadow: var(--shadow-2);
            position: relative; /* Added for absolute positioning of text */
            height: 200px;
            min-width: 200px;
            transition: transform 0.2s ease-in-out;
        }
        .media-element:hover{
            transform: scale(1.1);
        }
        .media-element > img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-2); /* Adjust if needed */
        }

        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white; /* Adjust text color */
            font-size: 1.5rem; /* Adjust font size */
            text-align: center;
            z-index: 1; /* Ensure text is above the image */
        }
        
        .snaps-inline {
            scroll-snap-type: inline mandatory;
            scroll-padding-inline: var(--size-2);
        }

        .snaps-inline > * {
            scroll-snap-align: start;
        }

        .blur-image {
            filter: blur(5px); /* Adjust the blur value as needed */
        }
        .blur-image:hover {
            filter: blur(0); /* Adjust the blur value as needed */
        }
        
        /* top part */

        .curved-bottom-div {
            
            display: flex;
            align-items: center; /* Vertical alignment */
            justify-content: center; /* Horizontal alignment */
            height: 300px;
            background-color: grey;
            border-radius: 0 0 50% 50%; /* This creates a semi-circle at the bottom */
        }

    .content {
        text-align: center; /* Center the text horizontally */
        color: #fff;
    }

        /* search bar */

    .search-container {
    padding: 10px;
    display: flex;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
}

.search-input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 20px 0 0 20px;
    width: 300px;
}

.search-button {
    background-color: black;
    color: #fff;
    border-radius: 0 20px 20px 0;
    padding: 10px;
    cursor: pointer;
}

.author {
    background-color: black;
    display: grid;
    grid-template-rows: min-content;
    gap: var(--size-2);
    padding: var(--size-3);
    background: var(--surface-2);
    border-radius: 50%;
    box-shadow: var(--shadow-2);
    position: relative; /* Added for absolute positioning of text */
    transition: transform 0.2s ease-in-out;
}
.author-scroller {
            display: grid;
            gap: var(--size-3);
            grid-auto-flow: column;
            grid-auto-columns: 30%;

            padding: 0 var(--size-2) var(--size-2);
            
            overflow-x: auto;
            overscroll-behavior-inline: contain;
        }
        
.author-elememt{
            
            background-color: black;
            display: grid;
            grid-template-rows: min-content;
            gap: var(--size-2);
            padding: var(--size-3);
            background: var(--surface-2);
            border-radius: 100%;
            box-shadow: var(--shadow-2);
            position: relative; /* Added for absolute positioning of text */
            height: 200px;
            width: 200px;
            transition: transform 0.2s ease-in-out;
        
}
.author-elememt:hover{
            transform: scale(1.1);
        }


        .log {
          
          border-radius: 20px;
          padding: 5px 20px;
          border-color: #fff;
          border-width: 0px;
          position: absolute;
          top: 10px;
          right: 50px;
          color: white;
          background-color: black;
      }

      /*  css for buttons to display profile,notification etc..*/

.dropdown{
    position: absolute;
    top: 10px;
    right: 20px;
          
}    

  .dropdown-content {
    display: none;
    margin-top: 40px;
    margin-right: 40px;
    padding: 12px 16px;
    z-index: 1;
  }

  .dropdown-content button {
    display: block;
    width: 100%;
    padding: 5px 10px;
    margin-bottom: 8px;
    border-radius: 20px;
    background-color: black;
    color: white;
  }



  /* search divs css */

  #container {
  display: none;
  flex-wrap: wrap;
}

.box {
  width: 200px;
  height: 200px;
  background-color: #343a40;
  color: white;
  margin: 10px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-size: 20px;
  border-radius: 10px;
  transition: transform 0.2s ease-in-out;
}
.box:hover{
  transform: scale(1.1);
} 
    </style>

    <script>
        function displaynone()
        {
            var box = document.getElementById('general');
            box.style.display = 'none';
            var b = document.getElementById('container');
            b.style.display = 'flex';
        }
    </script>
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById("myInput");
    input.addEventListener("keyup", searchDivs);
  });

  function searchDivs() {
    var input, filter, divs, div, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    divs = document.getElementsByClassName("box"); // Select the divs with the class 'box'

    for (i = 0; i < divs.length; i++) {
      div = divs[i];
      txtValue = div.textContent || div.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        div.style.display = ""; // Display the div if it matches the search
      } else {
        div.style.display = "none"; // Hide the div if it doesn't match the search
      }
    }
  }
</script>
    <script>
        //used to display profile,notification etc..
function toggleDropdown() {
  var dropdownContent = document.getElementById("dropdownContent");
  dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
}
</script>

</head>
<body>

    <div class="curved-bottom-div">


    <?php
   
   if (isset($_SESSION['logged'])) {
       $uname=$_SESSION['name'];
       echo "       
       <div class='dropdown'>
       <button class='log' onclick='toggleDropdown()' ><i class='bi bi-person-fill'></i>$uname</button>    

  <div class='dropdown-content' id='dropdownContent'>
    <a href='profile.php'><button class='drop'>Profile</button></a>
    <a href='newNotification.php'><button class='drop'>Notifications</button></a>
    <a href='newReview.php'><button class='drop'>Reviews</button></a>
    <a href='logout/' onclick='refreshPage()'><button class='drop'>LOG OUT</button></a>
  </div>
</div>
";
   } else {
       echo "<a href='../login/'><button class='log'><p class='login'>Login</p></button></a>";
       
   }
   ?>

        <div class="content">
            <!-- Your content goes here -->
            <h2>CESA</h2>
            <p>Library Management System</p>
            
            
            <div class="search-container">
        <form method="POST">
        <input type="text" class="search-input" onkeyup="displaynone()" id="myInput" placeholder="Search by book name,author,category">
        <button class="search-button" >
            <i class="fas fa-search"></i>
        </button>
        </form>
    </div>
    <br>
                <i>"The only thing you absolutely have to know is the location of the library." - Albert Einstein</i>
        </div>
    </div>


    <div class="container" id="container">

    <?php
      include '../database/dbconnect.php';

      $sql = "SELECT b.bid, b.bname, b.bauthor, COALESCE(ROUND(AVG(bl.stars), 0) ,0) AS avgstars
              FROM books b
              LEFT JOIN booklog bl ON b.bid = bl.bid
              GROUP BY b.bid";

      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $bid = $row['bid'];
              $bname = $row['bname'];
              $bauthor = $row['bauthor'];
              $avgstars = $row['avgstars'];
              
              echo "<form class='myForm' action='bookdetails.php' method='post'>
              <a href='#' class='submitForm'><div class='box'>
              <p>$bid</p>
              <p>$bname</p>
              <p>$bauthor</p><p>";

              for ($count = 0; $count < 5; $count++) {
                if($count < $avgstars) echo "<i class='bi bi-star-fill'></i>";
                else echo "<i class='bi bi-star'></i>";
              }

              echo "</p></div></a><input type='hidden' name='bid' value='$bid'></form>";
          }
      }
      $stmt->close();
    ?>
  </div>



<div id="general">
    <br>

    <h3>Top Rated Books</h3>
    <div class="media-scroller snaps-inline">
        <?php
            include '../database/dbconnect.php';
            $sql = "SELECT * FROM books WHERE bid IN (SELECT DISTINCT bid FROM booklog WHERE stars >= (SELECT AVG(stars) FROM booklog where stars IS NOT NULL) ORDER BY stars DESC)";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bid=$row['bid'];
                    $bname=$row['bname'];
                    $bcategory=$row['bcategory'];
                    $bprice=$row['bprice'];
                    echo "<form class='myForm' action='bookdetails.php' method='post'>
                    <a href='#' class='submitForm'>
                    <div class='media-element'>
                            <div class='text-overlay'><h3>$bname</h3></div>
                            </div></a><input type='hidden' name='bid' value='$bid'></form>";

                }
            }
        ?>
    </div>

    <h3>Category</h3>
    <br>
    <div class="media-scroller snaps-inline">
        <?php
            include '../database/dbconnect.php';
            $sql = "SELECT DISTINCT bcategory from books";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bcategory = $row['bcategory'];

                    echo "<form class='myForm' action='category.php' method='post'>
                      <a href='#' class='submitForm'>
                          <div class='media-element'>
                            <img src='nature.jpeg' class='blur-image' alt='$bcategory'>
                            <div class='text-overlay'><h3>$bcategory</h3><input type='hidden' name='bcategory' value='$bcategory'></div>
                          </div>
                      </a>
                  </form>";

                   
                }
            }
        ?>
    </div>
    
<br>
<h3>Authors</h3>
<br>
<div class="media-scroller snaps-inline">
    <?php
    include '../database/dbconnect.php';
    $sql = "SELECT DISTINCT bauthor FROM books";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bauthor = $row['bauthor'];

            echo "<form class='myForm' action='author.php' method='post'>
                      <a href='#' class='submitForm'>
                          <div class='author-elememt'>
                              <div class='text-overlay'><h3>$bauthor</h3><input type='hidden' name='bauthor' value='$bauthor'></div>
                          </div>
                      </a>
                  </form>";
        }
    }
    ?>  
    <script src="aSubmit.js"></script>
</div>
    <br>
    </div>
      
</body>

</html>