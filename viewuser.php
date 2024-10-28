<?php
require 'core/models.php';
$users = getAllUsers($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="style.css">
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-buttons a {
            margin-right: 10px;
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
            animation: glow 1s ease-in-out infinite alternate;
        }

        .back-button:hover {
            background-color: #218838;
        }

        th {
            color: white; 
            text-shadow: 0 0 5px white, 0 0 10px white; 
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
        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td class="action-buttons">
                <a href="core/handleForms.php?user_id=<?php echo $user['user_id']; ?>">View User</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
        </table>
        
        <a href="index.php" class="back-button">Back to Car List</a> <!-- Styled back button -->
    </div>
</body>
</html>
