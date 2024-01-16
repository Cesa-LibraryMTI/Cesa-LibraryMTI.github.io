<html>
    <head><title>Members Online</title>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
    </style>
    </head>
    <h3 align="center"><u>NOT RETURNED</u></h3>
    <table>
        <tr>
            <th>admisson no:</th>
            <th>name:</th>
            <th>FINE:</th>
            <th>DAYS:</th>
        </tr>
        <?php
                include 'dbconnect.php';
                $sql = "SELECT adno,name,fine,days FROM books";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        // Access individual columns using the column name
                        $adno= $row['adno'];
                        $name = $row['name'];
                        $fine = $row['fine'];
                        $days = $row['days'];

                        // Perform actions with the data (e.g., display or process)
                        echo "<tr><td>$adno</td><td>$name</td><td>$fine</td><td>$days</td></tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
        
    </table>
   
    
</html>