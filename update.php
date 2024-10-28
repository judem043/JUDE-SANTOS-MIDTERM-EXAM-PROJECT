<?php
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $car = getCarByID($pdo, $car_id); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $car_model = $_POST['car_model'] ?? null;
        $rental_price = $_POST['rental_price'] ?? null;

        if ($car_model && $rental_price) {
            updateCar($pdo, $car_model, $rental_price, $car_id);
            header("Location: index.php");
            exit();
        } else {
            echo "Please fill in all required fields.";
        }
    }
} else {
    echo "No car ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/22/85/52/228552bb6bdd183da62941c007097034.gif') no-repeat center center fixed;
            background-size: cover;
        }

        @-webkit-keyframes glow {
            from {
                text-shadow: 0 0 10px rgb(243, 133, 7), 0 0 20px rgb(245, 4, 145), 0 0 30px #e6008e, 0 0 40px #e60073, 0 0 50px #ec07a0, 0 0 60px #e600ad, 0 0 70px #f508cd;
            }
            to {
                text-shadow: 0 0 20px rgb(241, 97, 14), 0 0 30px #f73504, 0 0 40px #faa506, 0 0 50px #ff9102, 0 0 60px #ee9d08, 0 0 70px #f7b708, 0 0 80px #fd5d00;
            }
        }

        h1 {
            text-align: center;
            color: #e60073;
            animation: glow 1s ease-in-out infinite alternate;
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

        .input-container {
            display: flex;
            justify-content: center; 
            margin: 10px 0; 
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            width: 80%;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;
        }

        button {
            padding: 10px 20px;
            background-color: white;
            color: #e60073;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            animation: glow 1s ease-in-out infinite alternate;
            font-weight: bold;
        }

        button:hover {
            background-color: #f1f1f1;
        }

        .form-button {
            display: flex;
            justify-content: center;
            margin-top: 10px; 
        }

        p {
            text-align: center;
            color: black; 
            text-shadow: 0 0 5px black, 0 0 10px black; 
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Update Car</h1>
    <form action="update.php?id=<?php echo htmlspecialchars($car_id); ?>" method="POST">
        <div class="input-container">
            <input type="text" name="car_model" value="<?php echo htmlspecialchars($car['car_model']); ?>" required>
        </div>
        <div class="input-container">
            <input type="text" name="rental_price" value="<?php echo htmlspecialchars($car['rental_price']); ?>" required>
        </div>
        <div class="form-button">
            <button type="submit">Update</button>
        </div>
    </form>

    <div style="text-align: center;">
        <p><a href="index.php" style="color: black; font-weight: bold; text-decoration: underline;">Back to Car List</a></p>
    </div>
</div>
</body>
</html>
