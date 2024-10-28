<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: index.php"); 
    exit();
}

require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_model = $_POST['car_model'] ?? null;
    $rental_price = $_POST['rental_price'] ?? null;

    if ($car_model && $rental_price) {
        insertCar($pdo, $car_model, $rental_price);    
        echo "<p style='color: white; text-align: center;'><strong>Car inserted successfully.</strong></p>";
    } else {
        echo "<p style='color: red; text-align: center;'><strong>Please fill in all required fields.</strong></p>";
    }
}

$cars = getAllCars($pdo);
$users = getAllUsers($pdo); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/a6/a2/a1/a6a2a1da32e7c2a5ea6901e29161bded.gif') no-repeat center center fixed;
            background-size: cover;
        }

        h1, h2 {
            text-align: center;
            color: #f73dcd;
            animation: glow 1s ease-in-out infinite alternate;
            margin-bottom: 20px;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px rgb(243, 133, 7), 0 0 20px rgb(245, 4, 145), 0 0 30px #e6008e, 0 0 40px #e60073;
            }
            to {
                text-shadow: 0 0 20px rgb(241, 97, 14), 0 0 30px #f73504, 0 0 40px #faa506;
            }
        }

        .container {
            width: 60%;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
            backdrop-filter: blur(10px); 
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;
            position: relative; 
        }

        .logout-button {
            position: absolute; 
            top: -80px; 
            right: 20px;
            margin: 10px; 
        }

        .logout-button a,
        .view-user-list a {
            color: purple;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #dc3545;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-button a:hover {
            background-color: #5d0096;
            color: white;
        }

        .view-user-list {
            position: absolute; 
            top: -40px; 
            right: 120px;
            margin: 10px; 
        }
        .view-user-list a {
            background-color: #2ea745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            animation: glow 1s ease-in-out infinite alternate;
        }

        .view-user-list a:hover {
            background-color: #E7EBE0;
            color: white;
        }

        .welcome-message {
            text-align: center;
            color: black;
            margin: 20px 0;
            font-size: 1.5em; 
            animation: glow 1s ease-in-out infinite alternate;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
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
        }

        button:hover {
            background-color: ##E7EBE0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;
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

        .action-buttons a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .action-buttons a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="logout-button">
        <form action="index.php?logout=true" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="view-user-list">
        <a href="viewuser.php">View User List</a>
    </div>

    <h1>WELCOME TO MY EXPENSIVE CAR RENTALS</h1>
    
    <div class="welcome-message">
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </div>

    <h2>Insert Car</h2>
    <form action="index.php" method="POST">
        <input type="text" name="car_model" placeholder="Car Model" required>
        <input type="text" name="rental_price" placeholder="Rental Price" required>
        <button type="submit">Submit</button>
    </form>

    <h2>Car List</h2>
    <table>
        <thead>
            <tr>
                <th>Car ID</th>
                <th>Car Model</th>
                <th>Rental Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['car_id']); ?></td>
                    <td><?php echo htmlspecialchars($car['car_model']); ?></td>
                    <td><?php echo htmlspecialchars($car['rental_price']); ?></td>
                    <td class="action-buttons">    
                        <a href="viewcars.php?id=<?php echo $car['car_id']; ?>">Car Rent INFO</a>
                        <a href="update.php?id=<?php echo $car['car_id']; ?>">Update Car INFO</a>
                        <a href="delete.php?id=<?php echo $car['car_id']; ?>" onclick="return confirm('Are you sure you want to delete this car?');">Delete Car INFO</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
