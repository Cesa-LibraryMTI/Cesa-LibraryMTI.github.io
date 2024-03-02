<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        /* Your existing styles remain unchanged */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            /* Reverse the order of the stars */
            font-size: 0;
            /* Remove the space between the elements */
        }

        .rating input[type="radio"] {
            display: none;
            /* Hide the radio buttons */
        }

        .rating label {
            font-size: 30px;
            color: rgba(187, 183, 183, 0.726);
            /* Empty star color */
            margin: 0 2px;
            cursor: pointer;
        }

        .rating label:before {
            content: "\2605";
            /* Unicode character for filled star */
        }

        .rating input[type="radio"]:checked~label:before {
            content: "\2606";
            /* Unicode character for empty star */
            color: #ffffff;
            /* Filled star color */
        }

        textarea {
            color: black;
        }

        .Feedbackbox {
            display: flex;
            width: 100%;
            height: 40%;
        }

        .Feedbackbox textarea {
            resize: none;
            flex-wrap: wrap;
        }

        .modal {
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .modal-content {
            background: #075E54;
            padding: 2rem;
            border-radius: 1rem;
            width: 90%;
            max-width: 400px;
        }

        .close-btn {
            color: #ffffff;
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .button {
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            margin-left: 5px;
        }

        .submit-btn {
            float: right;
        }
    </style>
</head>

<body>

    <div class='modal' id='modal'>
        <div class='modal-content text-white'>
            <div class='close-btn' onclick='closeDiv()'>&times;</div>
            <h2 class='text-xl mb-2'>How was your last book?</h2>
            <p>Your answer is anonymous. WhatsApp uses it to help improve your call experience</p>
            <form method="POST"  >
            <div class='rating'>
                <input value='5' name='rating' id='star5' type='radio'>
                <label for='star5'></label>
                <input value='4' name='rating' id='star4' type='radio'>
                <label for='star4'></label>
                <input value='3' name='rating' id='star3' type='radio'>
                <label for='star3'></label>
                <input value='2' name='rating' id='star2' type='radio'>
                <label for='star2'></label>
                <input value='1' name='rating' id='star1' type='radio'>
                <label for='star1'></label>
            </div>
            <label>Feedback</label>
            <div class='Feedbackbox'>       
                    
                    <textarea name='Feedback' class='Feedback' rows='3' cols='60'></textarea>
            </div>
                    
                    <div class='actions mt-6'>
                        <button type="submit" class='button submit-btn' onsubmit="return validateForm()">Submit</button>
                        <button class='button' onclick='closeDiv()'>Not now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include '../database/dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uid = $_POST['uid'];
        $bid = $_POST['bid'];
        $stars = $_POST['rating'];
        echo "<script>alert('bid: {$bid}');</script>";

        // Validate if the rating is provided
        if (empty($stars)) {
            echo '<script>alert("Please provide a rating before submitting.");</script>';
        } else {
            // Assuming you have a 'booklog' table with columns 'uid', 'bid', 'stars', and 'feedback'
            $sql = "UPDATE booklog SET stars = $stars, feedback = '' WHERE uid = '$uid' AND bid = '$bid'";


            if ($conn->query($sql)) {
                echo '<script>alert("Feedback submitted successfully.");</script>';
            } else {
                echo '<script>alert("Error updating feedback: ' . $conn->error . '");</script>';
            }
            
        }
    }
    $conn->close();
    ?>

    <script>
        function openDiv() {
            var modal = document.getElementById('modal');
            modal.style.display = 'flex';
        }

        function closeDiv() {
            var modal = document.getElementById('modal');
            modal.style.display = 'none';
        }

        function validateForm() {
            var stars = document.querySelector('input[name="rating"]:checked');
            if (!stars) {
                alert('Please provide a rating before submitting.');
                return false;
            }

            // Set the value of the hidden rating field
            document.getElementById('rating').value = stars.value;

            return true;
        }
    </script>

</body>

</html>
