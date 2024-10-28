<?php
require_once __DIR__ . '/models.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $user = getUserByID($pdo, $user_id);

    if (!$user) {
        die("User not found.");
    }
} else {
    die("No user ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/b6/6f/2c/b66f2c5fd4317ff886784e6bf6c73c2f.gif') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 60%;
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

        h2 {
            text-align: center;
            color: #f73dcd;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
            animation: glow 1s ease-in-out infinite alternate;
        }

        a:hover {
            background-color: #218838;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            color: #333;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>User Details</h2>
        <p><strong>User ID:</strong> <?php echo htmlspecialchars($user['user_id']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
        <p><strong>Created At:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        
        <a href="../viewuser.php">Back to User List</a>
    </div>
</body>
</html>
