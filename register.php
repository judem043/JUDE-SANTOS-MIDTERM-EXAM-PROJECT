<?php
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['email'])) {
        echo "Email field is missing.";
        exit();
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $email = $_POST['email']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO Users (first_name, last_name, address, age, username, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$first_name, $last_name, $address, $age, $username, $email, $password])) {
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/a6/a2/a1/a6a2a1da32e7c2a5ea6901e29161bded.gif') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 40%;
            margin: auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: inset 0 0 0 .1vw #d422cc, 0 0 1.5vw 0 #ff04de, 0 0 1.5vw 0 #d422cc;
            margin-top: 50px;
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h1 {
            text-align: center;
            color: #f73dcd;
            animation: glow 1s ease-in-out infinite alternate;
            font-weight: bold; 
        }

        input[type="text"], input[type="password"], input[type="number"], input[type="email"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 0 0 .1vw #d422cc, 0 0 1.5vw 0 #ff04de, 0 0 1.5vw 0 #d422cc;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            animation: glow 1s ease-in-out infinite alternate;
            width: 80%;
            max-width: 400px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }

        .glow {
            text-shadow: 0 0 10px #ffffff, 0 0 20px #ffffff, 0 0 30px #ffffff;
            color: #ffffff; 
            font-weight: bold; 
            transition: color 0.3s ease;
        }

        .glow:hover {
            color: #e60073; 
        }

        @-webkit-keyframes glow {
            from {
                text-shadow: 0 0 10px rgb(243, 133, 7), 0 0 20px rgb(245, 4, 145), 0 0 30px #e6008e, 0 0 40px #e60073, 0 0 50px #ec07a0, 0 0 60px #e600ad, 0 0 70px #f508cd;
            }
            to {
                text-shadow: 0 0 20px rgb(241, 97, 14), 0 0 30px #f73504, 0 0 40px #faa506, 0 0 50px #ff9102, 0 0 60px #ee9d08, 0 0 70px #f7b708, 0 0 80px #fd5d00;
            }
        }

        p {
            text-align: center;
            color: white; 
            text-shadow: 0 0 5px white, 0 0 10px white; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required> 
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p><a href="login.php" style="color: black; font-weight: bold; text-decoration: underline;">Already have an account? Login here</a></p>
    </div>
</body>
</html>
