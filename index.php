
<?php
include 'conn.php';

$error = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    if (empty($_POST['userName']) || empty($_POST['userPass'])) {
        $error = "Username and password are required fields.";
    } else {
        
        $userName = $_POST['userName'];
        $password = $_POST['userPass'];

        $VAq = "SELECT Password FROM login WHERE Name=?";

        if (!$stmt = $conn->prepare($VAq)) {
            recorddie(__LINE__, __FILE__, $conn->error);
            die("Error while preparing query");
        }

        $stmt->bind_param('s', $userName);

        if (!$stmt->execute()) {
            recorddie(__LINE__, __FILE__, $stmt->error);
            die("Error while executing query");
        }

        $stmt->bind_result($PasswordDB);
        
        if (!$stmt->fetch()) {
            $error = "Invalid user not found.";
        } else {
            if ($password === $PasswordDB) {
                header("Location: home.php"); // Replace 'home.php' with your actual home page URL
                exit; 
            } else {
                $error = "Password is incorrect.";
            }
        }

        $stmt->close();
    }
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #548687;
            background-color:url("images\student.jpg")
        }

        .container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Ensure input size includes padding and border */
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-sizing: border-box; /* Ensure button size includes padding */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .login-pic {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="login-pic" src="images\download login.jpg" alt="Login Picture">

        <h1>Login</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="userName">Username</label>
            <input type="text" name="userName" id="userName">

            <label for="userPass">Password</label>
            <input type="password" name="userPass" id="userPass">

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
