<?php
include '../database/dbconnect.php';
$oneWeekBefore = date('Y-m-d', strtotime('-1 week'));
$currentDate = date('Y-m-d');
$sql = "SELECT * FROM announce";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $message = $row['message'];

        echo "<div class='popup popup$count'>
                <p>Name: $name</p>
                <p>Message: $message</p>
                <button onclick='closePopup($count)'>Close</button>
              </div>";
        $count++;
    }
}
?>

<script>
    var popups = document.querySelectorAll('.popup');

    function openNextPopup() {
        var currentPopup = popups[0];
        if (currentPopup) {
            currentPopup.style.display = 'block';
            popups = Array.prototype.slice.call(popups, 1);
        }
    }

    function closePopup(count) {
        var currentPopup = document.querySelector('.popup' + count);
        if (currentPopup) {
            currentPopup.style.display = 'none';
            openNextPopup();
        }
    }

    // Initial call to start displaying popups
    openNextPopup();
</script>
