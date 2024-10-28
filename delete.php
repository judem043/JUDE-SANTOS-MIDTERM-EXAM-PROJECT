<?php
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    if (deleteCar($pdo, $car_id)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting car.";
    }
} else {
    echo "No car ID provided.";
    exit();
}
?>
