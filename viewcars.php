<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

function getMostExpensiveCars($pdo, $limit = 10) {
    $sql = "
        SELECT Cars.*, Customers.customer_id, Customers.customer_name, Customers.contact_info, Customers.rental_months
        FROM Cars 
        LEFT JOIN Customers ON Cars.car_id = Customers.car_id 
        ORDER BY Cars.rental_price DESC 
        LIMIT :limit
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertCustomer($pdo, $car_id, $customer_name, $contact_info, $rental_months) {
    $sql = "INSERT INTO Customers (car_id, customer_name, contact_info, rental_months) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$car_id, $customer_name, $contact_info, $rental_months]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $car_id = $_POST['car_id'];
    $customer_name = $_POST['customer_name'] ?? null;
    $contact_info = $_POST['contact_info'] ?? null;
    $rental_months = $_POST['rental_months'] ?? null;

    if ($customer_name && $contact_info && $rental_months) {
        insertCustomer($pdo, $car_id, $customer_name, $contact_info, $rental_months);
        header("Location: viewcars.php"); 
        exit();
    }
}

$mostExpensiveCars = getMostExpensiveCars($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Expensive Cars</title>
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

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        input[type="text"], input[type="number"] {
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
        }

        button:hover {
            background-color: #218838;
        }
        
        th {
            color: black; 
            text-shadow: 0 0 5px white, 0 0 10px white; 
        }
        p {
            text-align: center;
            color: white; 
            text-shadow: 0 0 5px white, 0 0 10px white; 
        }
        .form-button {
            display: flex;
            justify-content: center;
            margin-top: 10px; 
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Most Expensive Cars</h1>
    <table border="1">
        <tr>
            <th>Car ID</th>
            <th>Car Model</th>
            <th>Rental Price</th>
            <th>Rental Months</th>
            <th>Customer Name</th>
            <th>Contact Info</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($mostExpensiveCars as $car): ?>
        <tr>
            <td><?php echo htmlspecialchars($car['car_id']); ?></td>
            <td><?php echo htmlspecialchars($car['car_model']); ?></td>
            <td><?php echo htmlspecialchars($car['rental_price']); ?></td>
            <td><?php echo htmlspecialchars($car['rental_months'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($car['customer_name'] ?? 'No customer'); ?></td>
            <td><?php echo htmlspecialchars($car['contact_info'] ?? 'No contact info'); ?></td>
            <td>
                <a href="update_customer.php?id=<?php echo $car['customer_id']; ?>">Update</a>
                <form action="delete_customer.php" method="POST" style="display:inline;">
                    <input type="hidden" name="customer_id" value="<?php echo $car['customer_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Customer Details</h2>
    <form action="viewcars.php" method="POST">
        <input type="hidden" name="car_id" value="<?php echo isset($car['car_id']) ? $car['car_id'] : ''; ?>">
        <input type="text" name="customer_name" placeholder="Customer Name" required>
        <input type="text" name="contact_info" placeholder="Contact Info" required>
        <input type="number" name="rental_months" placeholder="Rental Months" required>
        
        <div class="form-button">
            <button type="submit" name="submit">Add Customer</button>
        </div>
    </form>

    <p><a href="index.php" style="color: black; font-weight: bold; text-decoration: underline;">Back to Car List</a></p>
</div>

</body>
</html>
