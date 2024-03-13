<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flexbox Example</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  
   <style>
     body{
      background-color:#1e2125;
      color: white;
    }
    .container {
  display: flex;
  flex-wrap: wrap;
}

.box {
  width: 200px;
  height: 200px;
  background-color: #343a40;
  color: white;
  margin: 10px;
  display: flex;
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
</head>
<body>
  
  <?php
include '../database/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bcategory = $_POST['bcategory'];
    echo "<h1>$bcategory</h1><br><div class='container'>";

    $sql = "SELECT b.bid, b.bname, b.bauthor, COALESCE(ROUND(AVG(bl.stars), 0) ,1) AS avgstars
            FROM books b
            LEFT JOIN booklog bl ON b.bid = bl.bid
            WHERE b.bcategory = ?
            GROUP BY b.bid";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bcategory);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bid = $row['bid'];
            $bname = $row['bname'];
            $bauthor = $row['bauthor'];
            $avgstars = $row['avgstars'];

            echo "<form class='myForm' action='bookdetails.php' method='post'>
            <a href='#' class='submitForm'>
<div class='box'>$bid <br> $bname <br> $bauthor <br>";

            for ($count = 1; $count <= $avgstars; $count++) {
                echo "<i class='bi bi-star-fill'></i>";
            }

            echo "</div></a><input type='hidden' name='bid' value='$bid'></form>";
        }
    }
    $stmt->close();
}
?>


<script src="aSubmit.js"></script>

   
  </div>
</body>
</html>
