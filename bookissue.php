<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        input[type="text"] {
            padding: 8px;
            width: 200px;
        }

        button {
            padding: 8px;
            cursor: pointer;
        }

        #miniTable {
            margin-top: 20px;
            width: 30%;
        }

        #miniTable, #miniTable th, #miniTable td {
            border: 1px solid #ddd;
        }

        #miniTable th, #miniTable td {
            padding: 5px;
            text-align: left;
        }

        #miniTable th {
            background-color: #333;
            color: #fff;
        }

        .issue{
            background-image: url( 
'issuebutton.jpg'); 
            background-size: cover;  
            font-size: 2rem; 
        }
    </style>
</head>
<body>

    <header>
        <h1>Book Issue</h1>
    </header>

    <main>
        <div>
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter your search">
            <button onclick="searchTable()">Search</button>
        </div>

        <table id="mainTable">
            <thead>
                <tr>
                    <th>Book id</th>
                    <th>book name</th>
                    <th>Author</th>
		            <th>issue</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include 'dbconnect.php';

                        $sql="SELECT * FROM books WHERE bid!=(SELECT bid FROM booklog WHERE return_date='0000-00-00')";
                        $result=$conn->query($sql);
                        if(($result != false)&&($result->num_rows > 0))
                        {
                            while($row=$result->fetch_assoc()){
                                $bid = $row['bid'];
                                $bname= $row['bname'];
                                $bauthor=$row['bauthor'];
                                $bprice=$row['bprice'];
                                echo "<tr><td>$bid</td><td>$bname</td><td>$bauthor</td><td>$bprice</td></tr>";
                            }
                        }
                        else{
                            echo "wrong";
                        }
                        

                    ?>

                    
                <!-- Add more rows as needed -->
            </tbody>
        </table>

       
    </main>

   
</body>
</html>


  