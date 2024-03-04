<?php
session_start();

// if(isset($_SESSION['user_id'])) {
//     // If the user is already logged in, redirect to appointment.php
//     header("Location: Status.php");
//     exit();
// }
$servername = "localhost";
$username_db = "root"; // Your database username
$password_db = "";     // Your database password
$dbname = "client";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if(isset($_POST['submit'])) {
    $username = $_POST['loginUserId'];
    $password = $_POST['loginPassword'];

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

    // Fetch user data from the database
    $sql = "SELECT username,password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set up the session
            $_SESSION['user_id'] = $row['username'];
            header("Location: Status.php");
            exit();
        } else {
            $error_message = "Invalid password!!!  Login Again";
            echo "$error_message";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.html';
                    }, 5000);
                  </script>";
        }
    } 
    else {
        $error_message = "Invalid username!!!";
        echo "$error_message";
        echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.html';
                    }, 5000);
                  </script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
            max-width: 400px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
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

    <form id="loginForm" method="POST">
        <h2>Login</h2>

        <label for="loginUserId">User ID:</label>
        <input type="text" id="loginUserId" name="loginUserId" required>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>

        <button type="submit" name="submit">Login</button>

<p>
   Not yet a member? <a href="signup.php">Register</a>

    </form>
</body>
</html>
