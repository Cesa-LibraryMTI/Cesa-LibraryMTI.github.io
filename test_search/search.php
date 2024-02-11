<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <header>
        <h1>Books</h1>
    </header>

    <main>
        <div class="search">
            <label for="search">Enter Search Term:</label>
            <input type="text" name="search" id="search">
            <button id="searchButton">Search</button>
        </div>

        <div id="searchResults"></div>

        <table id="mainTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                include 'dbconnect.php';

                $sql = "SELECT * FROM books";
                $result = $conn->query($sql);

                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['sino']}</td><td>{$row['name']}</td></tr>";
                        // Add more columns as needed
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<tr><td colspan='2'>No results found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <script>
        $(document).ready(function() {
            $("#searchButton").click(function() {
                // Get the search term
                var searchTerm = $("#search").val();

                // Send the search term to the server
                $.post("search.php", { search: searchTerm }, function(data) {
                    // Update the search results div with the response from the server
                    $("#searchResults").html(data);
                });
            });
        });
    </script>

</body>
</html>