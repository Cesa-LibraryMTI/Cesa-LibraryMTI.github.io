<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flexbox Example</title>
  <style>
    .container {
  display: flex;
  flex-wrap: wrap;
}

.box {
  width: 200px;
  height: 200px;
  background-color: #ccc;
  margin: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 20px;
}

    </style>
</head>
<body>
  <div class="container">
  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bauthor=$_POST['bauthor'];
        echo "<h1>$bauthor</h1>";
    }
    
    ?>
    <div class="box">Box 1</div>
    <div class="box">Box 2</div>
    <div class="box">Box 3</div>
    <div class="box">Box 4</div>
    <div class="box">Box 5</div>
    <div class="box">Box 6</div>
  </div>
</body>
</html>
