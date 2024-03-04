<?php
session_start();

if(isset($_SESSION['user_id'])) {
    // If the user is already logged in, redirect to appointment.php
    header("Location: Status.php");
    exit();
}
$servername = "localhost";
$username_db = "root"; // Your database username
$password_db = "";     // Your database password
$dbname = "client";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if(isset($_POST['submit'])) {
    $email = $_POST['signupEmail'];
    $phone = $_POST['signupPhone'];
    $username = $_POST['signupUserId'];
    $password = $_POST['signupPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form data (add more validation as needed)
    if ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
    } else {
        // Replace the following with your database connection logic
        // $servername = "localhost";
        // $username_db = "root"; // Your database username
        // $password_db = "";     // Your database password
        // $dbname = "client";

        // // Create connection
        // $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password before storing in the database (for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (email, phone, username, password) VALUES ('$email', '$phone', '$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_id'] = $username;
            header("Location: Status.php");
            exit();
        } 
        else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>




<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://www.aamc.org/sites/default/files/Article-Academic-Health-Centers-927897070_0.jpg') center/cover fixed; /* Replace 'your-background-image.jpg' with your image URL */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            max-width: 300px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
width:100vh;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus {
            border-color: #3498db;
        }

        button {
            background: #3498db;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>

    <form id="signupForm">
        <h2>Sign Up</h2>

        <label for="signupEmail">Email ID:</label>
        <input type="email" id="signupEmail" name="signupEmail" required>

        <label for="signupPhone">Phone Number:</label>
        <input type="tel" id="signupPhone" name="signupPhone" required>

        <label for="signupUserId">User ID:</label>
        <input type="text" id="signupUserId" name="signupUserId" required>

        <label for="signupPassword">Password:</label>
        <input type="password" id="signupPassword" name="signupPassword" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        <button type="submit" name="submit" id="submit" >Sign Up</button>
        <p>
   Already Registered? <a href="login.html">Login</a>
</p>
    </form>
</body>
</html> -->
