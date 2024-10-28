<?php
session_start();
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
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
            background: url('https://i.pinimg.com/originals/a6/a2/a1/a6a2a1da32e7c2a5ea6901e29161bded.gif') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 40%;
            margin: auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 
                        0vw 0vw 1.5vw 0vw #ff04de, 
                        0vw 0vw 1.5vw 0vw #d422cc;
            margin-top: 50px;
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h1 {
            text-align: center;
            color: #f73dcd;
            font-weight: bold; 
            animation: glow 1s ease-in-out infinite alternate;
        }

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;

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
        }

        button:hover {
            background-color: #218838;
        }

        .error {
            color: white; 
            text-align: center;
            margin-top: 10px;
            animation: glow 1s ease-in-out infinite alternate; 
        }

        p {
            text-align: center;
            color: purple; 
            text-shadow: 0 0 5px white, 0 0 10px white;
            animation: glow 1s ease-in-out infinite alternate; 
        }

        @-webkit-keyframes glow {
            from {
                text-shadow: 0 0 10px rgb(243, 133, 7), 0 0 20px rgb(245, 4, 145), 0 0 30px #e6008e, 0 0 40px #e60073, 0 0 50px #ec07a0, 0 0 60px #e600ad, 0 0 70px #f508cd;
            }
            to {
                text-shadow: 0 0 20px rgb(241, 97, 14), 0 0 30px #f73504, 0 0 40px #faa506, 0 0 50px #ff9102, 0 0 60px #ee9d08, 0 0 70px #f7b708, 0 0 80px #fd5d00;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <?php if ($error_message): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </form>
        <p><a href="register.php" style="color: black; font-weight: bold; text-decoration: underline;">Don't have an account? Register here</a></p>
    </div>
</body>
</html>
