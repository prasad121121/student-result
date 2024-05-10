<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Insert Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: calc(100% - 12px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p.error {
            color: red;
            margin-top: 10px;
        }

        p.success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insert Student Result</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="prn_No">PRN Number:</label>
            <input type="text" name="prn_No" required>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="dsa">DSA:</label>
            <input type="text" name="dsa" required>
            <label for="python">Python:</label>
            <input type="text" name="python" required>
            <label for="java">Java:</label>
            <input type="text" name="java" required>
            <label for="management">Management:</label>
            <input type="text" name="management" required>
            <label for="roll">Roll:</label>
            <input type="text" name="roll" required>
            <select type="select" id='selectPicker'name='sel' required>
            <option for'#selectPicker' value='pass'>Pass</option>
            <option for'#selectPicker' value='fail'>Fail</option>

            <input type="submit" value="Insert Result">
        </form>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'conn.php';

            function displayError($message) {
                echo "<p class='error'>$message</p>";
            }

            $PRN_NO = trim($_POST['prn_No']);
            $NAME = trim($_POST['name']);
            $DSA = trim($_POST['dsa']);
            $PYTHON = trim($_POST['python']);
            $JAVA = trim($_POST['java']);
            $MANAGEMENT = trim($_POST['management']);
            $ROLL = trim($_POST['roll']);
            $RESULT = isset($_POST['sel']) ? trim($_POST['sel']) : ""; // Check if 'sel' is set in the POST data before trimming it
            

            if (empty($PRN_NO) || empty($NAME) || empty($DSA) || empty($PYTHON) || empty($JAVA) || empty($MANAGEMENT) || empty($ROLL)) {
                displayError("All fields are required.");
            } elseif (!ctype_digit($PRN_NO) || !ctype_digit($DSA) || !ctype_digit($PYTHON) || !ctype_digit($JAVA) || !ctype_digit($MANAGEMENT) || !ctype_digit($ROLL)) {
                displayError("Numeric fields must contain numeric values.");
            } else {
                $insertQuery = "INSERT INTO result  (PRN_NO, NAME, DSA, PYTHON, JAVA, MANAGEMENT, ROLL,RESULT) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
                if (!$stmt = $conn->prepare($insertQuery)) {
                    displayError("Error while preparing query");
                } else {
                    $stmt->bind_param('ssiiiiis', $PRN_NO, $NAME, $DSA, $PYTHON, $JAVA, $MANAGEMENT, $ROLL,$RESULT);
                    if (!$stmt->execute()) {
                        displayError("Error while executing query");
                    } else {
                        echo "<p class='success'>Result inserted successfully.</p>";
                    }
                    $stmt->close();
                }
            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
