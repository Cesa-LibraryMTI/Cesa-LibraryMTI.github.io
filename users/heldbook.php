<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/members.css">
    <link rel="stylesheet" href="../styles/search.css">
    <script src = "../js/search.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<header>
        <h1>HELD BOOK</h1>
    </header>

    <main>
        <div>

            <form method="POST">
            <div class="search">
            <input type="text" class="search__input" id = "myInput" placeholder="Type your text" onkeyup="searchTable()">
            </form></div>
        </div>

        <table id="myTable">
            <thead>
            <tr>
                <th>SI NO</th>
                <th>BOOK NAME</th>
                <th>AUTHOR</th>
                <th>PRICE</th>
                <th>CATEGORY</th>
                <th>Held Book</th>
                
            </tr>
            </thead>
            <tbody>
            <?php    
            include '../database/dbconnect.php';
          
    session_start();
    $uname=$_SESSION['name'];
    $sql="SELECT uid FROM members WHERE username='$uname' ";
    $res = $conn->query($sql); 
    $ro = $res->fetch_assoc();
    $uid=$ro['uid'];


// Select relevant data from the members table
    $sql="SELECT * FROM books WHERE bid IN (SELECT bid FROM copies WHERE available = 0)";
    $result = $conn->query($sql);
    if ($result !== false && $result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $bid = $row['bid'];
     
            #$sql = "SELECT * FROM books WHERE bid IN (SELECT bid FROM booklog WHERE return_date is NULL OR bid=$bid) ";
            #$res = $conn->query($sql);
            #if ($res !== false && $res->num_rows > 0) {
             #   while ($ro = $res->fetch_assoc()) {
           

            
            $bname = $row['bname'];
            $bauthor = $row['bauthor'];
            $bprice = $row['bprice'];
            $bcategory = $row['bcategory'];
            echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bprice</td><td>$bcategory</td><td><form method='POST'><input type='hidden' name ='bid' value ='$bid'><input type='hidden' name ='uid' value ='$uid'><button class = 'mbuttons' name = 'issue' ><i class='bi bi-cart-fill'></i></button></form></td><tr>";
        }

    } 
    else
    {
        echo "<br><h1><font color='blue'><i>No records found</i></font></h1><br>";
    }




    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $bid = $_POST['bid'];
        $uid = $_POST['uid'];
    
        do{
            $heldid = rand(1,100000000);
            $sq1 = "select count(heldid) as cn from heldlog where heldid = $heldid";
            $r1 = $conn->query($sq1);
            $c = $r1->fetch_assoc()['cn'];
        }while($c != 0);

    
        $currentDate = date("Y-m-d");
        $sql = "INSERT INTO heldlog values($heldid,$bid,$uid,'$currentDate')";
        $conn->query($sql);
        }
        


// Close the database connection
    $conn->close();
    ?>
            </tbody>
        </table>

       
    </main>
    
</html>