
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Topics to Learn</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Nav</title>
    <link rel="stylesheet" href="work-room/index.css">
    
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





    
</head>

<body>
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
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>




    <div class="container mx-auto text-center p-6">
        <h2 class="text-2xl font-bold mb-4">General Information</h2>
            <div class="grid grid-cols-3 gap-4"><!-- Update here -->
                <!-- Business Analysis -->
            <a href="members.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-people-fill icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Total Members</h3>
                <p>
                    
                    <?php
                        
                        include 'dbconnect.php';
                        $sql="SELECT COUNT(adno) as member_count FROM members";
                        $result=$conn->query($sql);
                        $rows=$result->fetch_assoc();
                        echo $rows['member_count'];
                    ?>
                </p>
            </div>
            </a>

            <!-- Computer Science -->
            <a href="notreturned.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-people-fill icon mb-2 text-red-500"></i>
                <h3 class="font-semibold">Not Returned</h3>
                <p>
                    <?php
                        
                        include 'dbconnect.php';
                        $sql="SELECT COUNT(adno) as member_count FROM members";
                        $result=$conn->query($sql);
                        $rows=$result->fetch_assoc();
                        echo $rows['member_count'];
                    ?>
                    </p>
            </div>
            </a>
            
            <!-- Data Science & Analytics -->
            <a href="totbooks.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-book icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Total Books</h3>
                <p>
                    <?php
                        
                        include 'dbconnect.php';
                        $sql="SELECT COUNT(sino) as book_count FROM books";
                        $result=$conn->query($sql);
                        $rows=$result->fetch_assoc();
                        echo $rows['book_count'];
                    ?>
                    </p>
            </div>
            </a>
           
        </div>
        
    </div>

    <div class="container mx-auto text-center p-6">
        <h2 class="text-2xl font-bold mb-4">blah blah!!</h2>
        <div class="grid grid-cols-3 gap-4"> <!-- Update here -->
            <!-- Business Analysis -->
            <a href="addmember.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-person-plus-fill icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Add members</h3>
               
            </div>
            </a>

            <!-- Computer Science -->
            <a href="">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-journal-bookmark icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Issue Book</h3>
                
            </div>
            </a>

            <!-- Data Science & Analytics -->
            <a href="addnewbook.php">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="bi bi-database-fill-add icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Add new book</h3>
                
            </div>
            </a>
            
        </div>
        
    </div>
    

    

    <div class="container mx-auto text-center p-6">
        <h2 class="text-2xl font-bold mb-4">Reports</h2>
        <div class="grid grid-cols-3 gap-4"> <!-- Update here -->
            <!-- Business Analysis -->
            <a href="">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="fas fa-chart-line icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Daily</h3>
                
            </div>
            </a>

            <!-- Computer Science -->
            <a href="">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="fas fa-chart-line icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Weekly</h3>
                
            </div>
            </a>

            <!-- Data Science & Analytics -->
            <a href="">
            <div class="bg-white p-4 shadow-lg rounded-lg topic-card">
                <i class="fas fa-chart-line icon mb-2 text-blue-500"></i>
                <h3 class="font-semibold">Monthly</h3>
                
            </div>
            </a>
        </div>
        
    </div>
    
    

    <script src="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet"></script>
</body>
</html>
