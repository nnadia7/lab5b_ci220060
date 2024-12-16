<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password']; // Get password from the form
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Check if the password is correct
            $_SESSION['loggedin'] = true;
            header('Location: display.php');
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Invalid matric number.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Full-screen background centering */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            text-align: center;
        }

        /* Form container style */
        .container {
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 320px; /* Make the container smaller and centered */
        }

        h2 {
            color: #ff69b4; /* Pink color for the header */
            margin-bottom: 30px;
        }

        /* Styling for text input fields */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Styling for the login button */
        button {
            width: 108%;
            padding: 10px;
            background-color: #ff69b4; /* Pink button */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff1493; /* Darker pink on hover */
        }

        /* Styling for error message */
        p {
            color: red;
            font-size: 14px;
        }

        /* Styling for the register link */
        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }

        /* Styling the link to be blue */
        .register-link a {
            color: #007BFF; /* Blue color */
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="text" name="matric" placeholder="Enter your matric number" required><br>
            <input type="password" name="password" placeholder="Enter your password" required><br>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

        <!-- Registration link in blue color -->
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Click here to register</a></p>
        </div>
    </div>
</body>
</html>
