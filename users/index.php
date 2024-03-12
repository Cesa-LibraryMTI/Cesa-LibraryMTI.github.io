<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizontal Scrollable Div</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src = "../js/search.js"></script>
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
            gap: var(--size-3);
            grid-auto-flow: column;
            grid-auto-columns: 30%;

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
            min-height: 200px;
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
            border-width: 2px;
            position: absolute;
            top: 20px;
            right: 50px;
            color: white;
        }
    #myTable{
        display: none;
        
    }

    </style>

    <script>
        function displaynone()
        {
            var box = document.getElementById('general');
            box.style.display = 'none';

            var b = document.getElementById('myTable');
            b.style.display = 'contents';
        }

        function refreshPage() {
            location.reload();
        }
    </script>
</head>
<body>

    <div class="curved-bottom-div">
    
    <?php
   
if (isset($_SESSION['logged'])) {
    $uname=$_SESSION['name'];
    echo "<a href='logout/' onclick='refreshPage()'><button class='log'><i class='bi bi-person-fill'></i>$uname</button></a>";
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
        <input type="text" class="search-input" placeholder="Search by book name,author,category" id = "myInput"  onkeyup="searchTable();displaynone()">
        <button class="search-button" onclick="displaynone()">
            <i class="fas fa-search"></i>
        </button>
        </form>
    </div>
    <br>
                <i>"The only thing you absolutely have to know is the location of the library." - Albert Einstein</i>
        </div>
    </div>

    <br>







    <div id="myTable">
    <table>
            <thead>
            <tr>
                <th>SI NO</th>
                <th>BOOK NAME</th>
                <th>AUTHOR</th>
                <th>PRICE</th>
                <th>CATEGORY</th>
                <th>COPIES</th>
                <th>AVAILABLE</th>
                <th>MODIFY</th>
            </tr>
            </thead>
            <tbody>
                
            <?php
                include '../database/dbconnect.php';
                include '../database/checker.php';
                $sql = "SELECT * FROM viewbooks";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        // Access individual columns using the column name
                        $bid = $row['bid'];
                        $bname = $row['bname'];
                        $bauthor = $row['bauthor'];
                        $bprice = $row['bprice'];
                        $bcategory = $row['bcategory'];
                        $bcopy = $row['copies'];
                        $bavailable = $row['available'];
                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bprice</td><td>$bcategory</td><td>$bcopy</td><td>$bavailable</td>";
                        echo "<td class = 'modbuttons'>";
                        echo "<form method='POST' action = 'editbook.php'><input type = 'hidden' name = 'sent' value = '1'><input type = 'hidden' name = 'book' value = $bid><input type = 'hidden' name = 'bookname' value = $bname><input type = 'hidden' name = 'bauthor' value = '$bauthor'><input type = 'hidden' name = 'bprice' value = '$bprice'><input type = 'hidden' name = 'bcategory' value = '$bcategory'><input type = 'hidden' name = 'bcopy' value = '$bcopy'><input type = 'hidden' name = 'bavailable' value = '$bavailable'><button type = 'submit' class = 'ebuttons' name = 'edit'><i class='bi bi-pencil-square icon mb-2'></i></button></form>";
                        echo "<form method='post'><input type = 'hidden' name = 'book' value = $bid><input type = 'hidden' name = 'bookname' value = $bname><button class = 'dbuttons' name = 'delete' onclick = 'return valid(`$bname`,$bcopy,$bavailable)'><i class='bi bi-trash3-fill icon mb-2'></i></button></form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </div>
















    
<div id="general">
<h3>Recomended Books</h3>
    <div class="media-scroller snaps-inline">
        <?php
            include '../database/dbconnect.php';
            $sql = "SELECT * FROM books WHERE bid IN (SELECT DISTINCT bid FROM booklog WHERE stars > (SELECT AVG(stars) FROM booklog where stars IS NOT NULL) ORDER BY stars DESC)";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bid=$row['bid'];
                    $bname=$row['bname'];
                    $bcategory=$row['bcategory'];
                    $bprice=$row['bprice'];
                    echo "<form method='POST'><a href=notification.php><div class='media-element'>
                            <div class='text-overlay'><h3>$bname</h3></div>
                            <input type='hidden' value='$bid' name='bid'><input type='hidden' value='$bname' name='bname'><input type='hidden' value='$bcategory' name='bcategory'><input type='hidden' value='$bprice' name='bprice'>
                            </div></a></form>";

                }
            }
        ?>
    </div>
    <br>

    <h3>Top Rated Books</h3>
    <div class="media-scroller snaps-inline">
        <?php
            include '../database/dbconnect.php';
            $sql = "SELECT * FROM books WHERE bid IN (SELECT DISTINCT bid FROM booklog WHERE stars > (SELECT AVG(stars) FROM booklog where stars IS NOT NULL) ORDER BY stars DESC)";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bid=$row['bid'];
                    $bname=$row['bname'];
                    $bcategory=$row['bcategory'];
                    $bprice=$row['bprice'];
                    echo "<form method='POST'><a href=notification.php><div class='media-element'>
                            <div class='text-overlay'><h3>$bname</h3></div>
                            <input type='hidden' value='$bid' name='bid'><input type='hidden' value='$bname' name='bname'><input type='hidden' value='$bcategory' name='bcategory'><input type='hidden' value='$bprice' name='bprice'>
                            </div></a></form>";

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
                    echo "<div class='media-element'>
                            <img src='nature.jpeg' class='blur-image' alt='$bcategory'>
                            <div class='text-overlay'><h3>$bcategory</h3></div>
                        </div>";
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
                    
                    $bauthor=$row['bauthor'];
                    
                    echo "<a href='#' onclick='document.getElementById('myForm').submit(); return false;'>
                    <div class='author-element'>
                        <div class='text-overlay'><h3>$bauthor</h3></div>
                    </div>
                </a>
                
                <form id='myForm' method='post' action='totbooks.php'>
                    <!-- Your form fields go here -->
                </form>";
                
                }
            }
        ?>
    </div>
    <br>
    </div>
      
</body>

</html>


