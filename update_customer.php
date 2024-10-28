<?php

require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 


if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];


    $sql = "SELECT * FROM Customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customer_id]);
    $customer = $stmt->fetch();


    if (!$customer) {
        echo "Customer not found.";
        exit();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_name = $_POST['customer_name'] ?? null;
        $contact_info = $_POST['contact_info'] ?? null;
        $rental_months = $_POST['rental_months'] ?? null;


        if ($customer_name && $contact_info && $rental_months) {
            $updateSql = "UPDATE Customers SET customer_name = ?, contact_info = ?, rental_months = ? WHERE customer_id = ?";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute([$customer_name, $contact_info, $rental_months, $customer_id]);
            header("Location: viewcars.php"); 
            exit();
        } else {
            echo "Please fill in all required fields.";
        }
    }
} else {
    echo "No customer ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/f0/20/03/f0200331edbeabb3433eafb8e0765e02.gif') no-repeat center center fixed;
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

        .form-button {
            display: flex;
            justify-content: center;
            margin-top: 10px; 
        }

        p {
            text-align: center;
            color: white; 
            text-shadow: 0 0 5px white, 0 0 10px white; 
        }
    </style>
<h1>Update Customer</h1>
<form action="update_customer.php?id=<?php echo htmlspecialchars($customer_id); ?>" method="POST">
    <input type="text" name="customer_name" value="<?php echo htmlspecialchars($customer['customer_name']); ?>" required>
    <input type="text" name="contact_info" value="<?php echo htmlspecialchars($customer['contact_info']); ?>" required>
    <input type="number" name="rental_months" value="<?php echo htmlspecialchars($customer['rental_months']); ?>" required>
    <button type="submit">Update</button>
</form>

<p><a href="viewcars.php" style="color: white; font-weight: bold; text-decoration: underline;">Back to Customer List</a></p>

</body>
</html>