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
      margin-top: 5%;
  display: flex;
  flex-wrap: wrap;
}

.box {
  width: 200px;
  height: 200px;
  background-color: #343a40;
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
  <div class="container">
  <?php
include '../database/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bauthor = $_POST['bauthor'];
    echo "<h1>$bauthor</h1>";

    $sql = "SELECT b.bid, b.bname, b.bcategory, COALESCE(ROUND(AVG(bl.stars), 0), 1) AS avgstars
            FROM books b
            LEFT JOIN booklog bl ON b.bid = bl.bid
            WHERE b.bauthor = ?
            GROUP BY b.bid";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bauthor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bid = $row['bid'];
            $bname = $row['bname'];
            $bcategory = $row['bcategory'];
            $avgstars = $row['avgstars'];

            echo "<div class='box'>$bid <br> $bname <br> $bcategory <br>";

            for ($count = 1; $count <= $avgstars; $count++) {
                echo "<i class='bi bi-star-fill'></i>";
            }

            echo "</div>";
        }
    } else {
        echo "No rows";
    }

    $stmt->close();
}
?>

  
   
  </div>
</body>
</html>
