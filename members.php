<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Book Issue</title>
    <link rel="stylesheet" href="styles/members.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
      
        /*search*/
        .search {
            display: flex;
            text-align: center;
            border-radius: 30px;
            width: fit-content;
          }
          
          .search__input {
            font-family: inherit;
            font-size: inherit;
            background-color: #f4f2f2;
            border: none;
            color: #646464;
            padding: 0.7rem 1rem;
            border-radius: 30px;
            width: 12em;
            margin-right: -2rem;
            transition: all ease-in-out .5s;
          }
          
          .search_input:hover, .search_input:focus {
            box-shadow: 0 0 1em #00000013;
          }
          
          .search__input:focus {
            outline: none;
            background-color: #f0eeee;
          }
          
          .search__input::-webkit-input-placeholder {
            font-weight: 100;
            color: #ccc;
          }
          
          .search_input:focus + .search_button {
            background-color: #f0eeee;
          }
    </style>

</head>
<body>

    <header>
        <h1>TOTAL MEMBER'S</h1>
    </header>

    <main>
        <div>

            <form method="POST">
            <div class="search">
              <input type="text" class="search__input" id='myInput' placeholder="Type your text" onkeyup="searchTable()">
            </div>
            </form>
        </div>

        <table id="myTable">
            <thead>
                <tr>
                    <th>ad.no</th>
                    <th>name</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
                
                <?php
                include 'dbconnect.php';
                $sql = "SELECT uid,username FROM members";
                $result = $conn->query($sql);

                
            
                if (($result !== false)&&($result->num_rows > 0)) {
                    while ($row = $result->fetch_assoc()) {
                        $uid = $row['uid'];
                        $name = $row['username'];
                        echo "<tr><td>$uid</td><td>$name</td><td><i class='bi bi-trash3-fill icon mb-2 text-blue-500'></i></td></tr>";
                    }
                }else{
                    print "<br><h1><font color = 'blue'><i>Wrong credentials<i><font></h1><br>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>

       
    </main>

    
    <script>
      
        function searchTable() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }            
         }
        }
    </script>

</body>
</html>


  