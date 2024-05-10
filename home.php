<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Form styling */
        form {
            margin: 20px auto;
            text-align: center;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Table styling */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            color:black;
        }

        th {
            background-color: #4CAF50;
            color: black;
        }

        /* Conditional styling for result cells */
        .pass {
            color: green;
        }

        .fail {
            color: red;
        }

        /* Body background */
        body {
            background-color:#548687;
            color: white; /* Text color for better readability */
            
        }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="prn_No">
        <input type="submit" style="margin: 100px;"  value="Submit">
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conn.php';

        function displayError($message) {
            echo "<p style='color: red;'>Error: $message</p>";
        }

        $PRN_NO = trim($_POST['prn_No']);
        if (empty($PRN_NO)) {
            displayError("PRN number cannot be empty.");
        } elseif (!ctype_digit($PRN_NO)) {
            displayError("PRN number must be a valid number.");
        } else {
            $VAq = "SELECT NAME, PRN_NO, DSA, PYTHON, JAVA, MANAGEMENT, ROLL FROM result WHERE PRN_NO = ?";
            if (!$stmt = $conn->prepare($VAq)) {
                displayError("Error while preparing query");
            } else {
                $stmt->bind_param('s', $PRN_NO);
                if (!$stmt->execute()) {
                    displayError("Error while executing query");
                } else {
                    $stmt->bind_result($NAME, $PRN_NO, $DSA, $PYTHON, $JAVA, $MANAGEMENT, $ROLL);
                    ?>
                    <table border="1">
                        <tr>
                            <th>Name</th>
                            <th>PRN Number</th>
                            <th>DSA</th>
                            <th>Python</th>
                            <th>Java</th>
                            <th>Management</th>
                            <th>Result</th>
                            <th>Roll</th>
                        </tr>
                        <?php
                        while ($stmt->fetch()) {
                            ?>
                            <tr>
                                <td><?php echo $NAME; ?></td>
                                <td><?php echo $PRN_NO; ?></td>
                                <td <?php echo ($DSA > 35) ? 'class="pass"' : 'class="fail"'; ?>><?php echo $DSA; ?></td>
                                <td <?php echo ($PYTHON > 35) ? 'class="pass"' : 'class="fail"'; ?>><?php echo $PYTHON; ?></td>
                                <td <?php echo ($JAVA > 35) ? 'class="pass"' : 'class="fail"'; ?>><?php echo $JAVA; ?></td>
                                <td <?php echo ($MANAGEMENT > 35) ? 'class="pass"' : 'class="fail"'; ?>><?php echo $MANAGEMENT; ?></td>
                                <td><?php echo (($DSA > 35) && ($PYTHON > 35) && ($JAVA > 35) && ($MANAGEMENT > 35)) ? 'Pass' : 'Fail'; ?></td>
                                <td><?php echo $ROLL; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
    ?>
</body>
</html>
