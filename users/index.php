<?php
    session_start();
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged'] == 1){
            header("Location: ../index.php");
            exit();
        }
        if($_SESSION['logged']==-1){
            header("Location: /login/");
            exit();
        }
    }else{
        header("Location: /login/");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESA Library</title>
    

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Nav</title>
    <link rel="stylesheet" href="index.css">
    <link rel='stylesheet' href='usernotification.css'>
    <style>

        
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .topic-card {
            transition: transform 0.3s;
        }
        .topic-card:hover {
            transform: translateY(-5px);
        }
        .icon {
            font-size: 24px;
        }
    </style>





    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Simulate content loading (you can replace this with your actual content loading logic)
        setTimeout(function() {
            hideLoadingScreen();
        }, 2000); // Replace 2000 milliseconds with the actual time it takes to load your content
    
        function hideLoadingScreen() {
            document.querySelector('.loading-screen').style.display = 'none';
            document.body.style.overflow = 'visible'; // Restore scrolling
        }
        
    });
    </script>
    <style>
body {
    margin: 0;
    overflow: auto;
}
body::-webkit-scrollbar {
    display: none;
}
.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #000000;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999; /* Ensure it's on top of other elements */
}
.messagebox{
    background-color: grey;
    width:100%;
    height:60%;
}



        @keyframes glow {
            0% {
                text-shadow: 0 0 10px #ffa502, 0 0 20px #ffa502, 0 0 30px #ffa502, 0 0 40px #ffa502, 0 0 50px #ffa502, 0 0 60px #ffa502, 0 0 70px #ffa502;
            }
            100% {
                text-shadow: 0 0 20px #ffd702, 0 0 30px #ffbb02, 0 0 40px #ffbb02, 0 0 50px #ffbb02, 0 0 60px #ffbb02, 0 0 70px #ffbb02, 0 0 80px #ffbb02;
            }
        }
        .glowing-text {
            font-size: 10rem;
            color: #ffffff;
            animation: glow 1s ease-in-out infinite alternate;
            font-family: 'Arial', sans-serif;
        }
        
    </style>
</head>

<body>
    
    <?php
    
    
    $totalcount = 1;
    if(isset($_COOKIE['count'])){
        $totalcount = $_COOKIE['count'];
        $totalcount++;
    }
    if($totalcount == 1){
        echo "<script> document.body.style.overflow = 'hidden';</script>";
        echo "<div class='loading-screen'><div class='glowing-text'>CESA</div></div>";
        echo "<script> setTimeout(function() {document.body.style.overflow = 'auto';}, 2000);</script>";
    }
    setcookie('count',$totalcount);
    ?>
    
    <!-- Your Website Content -->
    <div class="content">
        <!-- Your content goes here -->
        <header>
        <nav>
            <div class="logo">
                <a href="#"> CESA </a>
            </div>
            <input type="checkbox" id="click">
            <label for="click" class="mainicon">
                <div class="menu">
                    <i class="bi bi-list"></i>
                </div>
            </label>
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">settings</a></li>
                <li><a href="../logout/">LOG OUT</a></li>
            </ul>
        </nav>
    </header>
    


    <div class="container mx-auto text-center p-6">
        <h2 class="text-2xl font-bold mb-4">General Information</h2>
            <div class="grid grid-cols-3 gap-4"><!-- Update here -->
                <!-- Business Analysis -->
            <a href="availablebooks.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-people-fill icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">bla</h3>
                
            </div>
            </a>

            <!-- Computer Science -->
            <a href="notreturned">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-people-fill icon mb-2 text-red-500"></i>
                <h3 class="font-semibold">Held Book</h3>
                
            </div>
            </a>
            
            <!-- Data Science & Analytics -->
            <a href="totbooks.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-book icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Total Books</h3>
                
            </div>
            </a>
           
        </div>
        
    

        <?php
        if($totalcount == 1){
            include 'usernotification.php';
        }
        include 'whatsapp.php';
    ?>
    

    <script src="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet"></script>


    </div>

    <script src="script.js"></script>
</body>
</html>













