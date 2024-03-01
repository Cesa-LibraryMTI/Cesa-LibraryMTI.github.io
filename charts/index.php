<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Flexbox Example</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #f0f0f0;
        }

        .child-box {
            flex: 0 0 30%; /* Flex property to set the initial size of each child box */
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column; /* Stack child boxes vertically on smaller screens */
            }

            .child-box {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="child-box"><?php include 'gptchart.php'; ?></div>
        <div class="child-box"><?php include 'gptchart1.php'; ?></div>
        <div class="child-box"><?php include 'gptchart2.php'; ?></div>
    </div>
    
</body>
</html>
