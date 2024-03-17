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
      <h2 class="font-semibold text-lg">hitler</h2>
      
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
        <p class="text-sm mt-2"></p>
        <h3 class="text-2xl font-semibold">0</h3>
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
