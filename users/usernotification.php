<?php
include '../database/dbconnect.php';

// Get one week before and current date
$oneWeekBefore = date('Y-m-d', strtotime('-1 week'));
$currentDate = date('Y-m-d');

// Query to get announcements within the last week
$sqlAnnouncements = "SELECT * FROM announce WHERE date BETWEEN ? AND ?";
$stmtAnnouncements = $conn->prepare($sqlAnnouncements);
$stmtAnnouncements->bind_param("ss", $oneWeekBefore, $currentDate);
$stmtAnnouncements->execute();
$resultAnnouncements = $stmtAnnouncements->get_result();

// Query to check if the user is holding any book without returning
$uid = $_SESSION['id'];
$sqlHeldBooks = "SELECT b.bname 
                FROM booklog b1 
                LEFT JOIN heldlog h ON b1.tid = h.tid 
                LEFT JOIN books b ON b1.bid = b.bid  
                WHERE b.return_date IS NULL 
                AND b.uid = ?";
$stmtHeldBooks = $conn->prepare($sqlHeldBooks);
$stmtHeldBooks->bind_param("i", $uid);
$stmtHeldBooks->execute();
$resultHeldBooks = $stmtHeldBooks->get_result();

$count = 1; // Counter for popups
while ($row = $resultAnnouncements->fetch_assoc()) {
    $name = $row['name'];
    $message = $row['message'];

    // Display announcement popup
    echo "<div class='popup popup$count'>
            <p>Name: $name</p>
            <p>$message</p>
            <button onclick='closePopup($count)' class='close'>Close</button>
          </div>";
    $count++;
}

// Check if the user is holding any book without returning
if ($resultHeldBooks->num_rows > 0) {
    $row = $resultHeldBooks->fetch_assoc();
    $bid = $row['bid'];

    // Display held book popup
    echo "<div class='popup popup$count'>
            <p>@BOT:</p>
            <p>THE BOOK YOU HELD</p>
            <button onclick='closePopup($count)' class='close'>Close</button>
          </div>";
    $count++;
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
