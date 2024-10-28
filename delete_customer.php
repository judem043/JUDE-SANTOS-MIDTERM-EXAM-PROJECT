<?php

require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 


if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];


    $sql = "DELETE FROM Customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$customer_id])) {
        header("Location: viewcars.php"); 
        exit();
    } else {
        echo "Error deleting customer.";
    }
} else {
    echo "No customer ID provided.";
    exit();
}
?>
