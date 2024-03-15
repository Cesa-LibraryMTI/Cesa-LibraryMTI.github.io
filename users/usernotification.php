<?php
include '../database/dbconnect.php';
$oneWeekBefore = date('Y-m-d', strtotime('-1 week'));
$currentDate = date('Y-m-d');
$sql = "SELECT * FROM announce WHERE date BETWEEN '$oneWeekBefore' AND '$currentDate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $message = $row['message'];

        echo "<div class='popup popup$count'>
    
                <p>Name: $name</p>
                <p>$message</p>
                <button onclick='closePopup($count)' class='close'>Close</button>
              </div>";
        $count++;
    }
}
?>

<script>
    var currentPopupIndex = 1;
    var popups = document.querySelectorAll('.popup');

    function openNextPopup() {
        if (currentPopupIndex <= popups.length) {
            var currentPopup = document.querySelector('.popup.popup' + currentPopupIndex);
            currentPopup.style.display = 'block';
            currentPopupIndex++;
        }
    }

    function closePopup(count) {
        var currentPopup = document.querySelector('.popup.popup' + count);
        if (currentPopup) {
            currentPopup.style.display = 'none';
            openNextPopup();
        }
    }

    // Initial call to start displaying popups
    openNextPopup();
</script>
