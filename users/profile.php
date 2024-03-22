<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #1e2125;
    }
    .bg-gradient-to-b {
      background-image: linear-gradient(to bottom, #343a40, #1e2125);
    }
    .text-white {
      color: #ffffff;
    }
    .text-blue-800 {
      color: #343a40;
    }
    /* Increase shadow */
    .profile-image-container {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    #submit{
      border-radius: 20px;
      color: white;
      background-color: red;
      margin-top: 10px;
      padding: 5px 20px;
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Main container -->
  <div class="min-h-screen bg-gradient-to-b from-blue-600 to-blue-400 pt-12 pb-6 px-4">

    <!-- Header -->
    <header class="flex justify-between items-center pb-10 text-white">
      <h1 class="text-xxl font-bold">Profile</h1>
      
    </header>
    
    <!-- Profile section -->
    <div class="bg-gray-800 p-7 rounded-lg shadow-md text-white text-center mb-6">
      <div class="border-4 border-yellow-400 rounded-full w-24 h-24 mx-auto overflow-hidden profile-image-container">
        <!-- Profile image goes here -->
        <img src="hitler.jpg" class="w-full h-full object-cover">
      </div>
      <h2 class="font-semibold text-lg">
        <?php 
          session_start();
          include '../database/dbconnect.php';
          $name=$_SESSION['name'];
          echo "$name";
        ?>
       </h2>
      
    </div>

    
    <!-- Stats Cards -->
    <div class="grid grid-cols-2 gap-4 mb-6">
      <!-- Card 1 -->
      <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
        <i class="bi bi-book"></i>
        <p class="text-sm mt-2">NUMBER OF BOOKS READ</p>
        <h3 class="text-2xl font-semibold">0</h3>
      </div>
      <!-- Card 2 -->
      <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
        <i class="fas fa-clipboard-check fa-2x"></i>
        <p class="text-sm mt-2">REVIEWS SUBMITTED</p>
        <h3 class="text-2xl font-semibold">0%</h3>
      </div>
      <!-- Card 3 -->
      <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
        <i class="fas fa-gem fa-2x"></i>
        <p class="text-sm mt-2">HELD BOOK</p>
        <h3 class="text-2xl font-semibold">
        <?php
$uid=$_SESSION['id'];
$sql = "SELECT b.bid, b.bname
        FROM heldlog h 
        LEFT JOIN books b ON h.bid = b.bid  
        WHERE h.uid = ?
        AND h.status = 1"; // Removed the extra closing parenthesis
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid); // Assuming $uid is an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  
        $bid = $row['bid'];
        $bname = $row['bname'];
        echo "Name : $bname  
        <form method='POST' action='unheld.php'>
          <input type='submit' value='Un Held' id='submit'>

        </form>
        
        ";
        
    
} else {
    echo "NO BOOKS";
}
?>
        </h3>
      </div>
      <!-- Card 4 -->
      <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
        <i class="fas fa-users fa-2x"></i>
        <p class="text-sm mt-2">SOCIAL INDEX</p>
       <h3 class="text-2xl font-semibold">0</h3>
      </div>
    </div>

  </div>

</body>
</html>
