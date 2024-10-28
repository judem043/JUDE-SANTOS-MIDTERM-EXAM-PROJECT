<?php

require_once 'dbConfig.php';


function insertCar($pdo, $car_model, $rental_price) {
    $sql = "INSERT INTO Cars (car_model, rental_price) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$car_model, $rental_price]);
}
function getAllCars($pdo) {
    $sql = "SELECT * FROM Cars";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getCarByID($pdo, $car_id) {
    $sql = "SELECT * FROM Cars WHERE car_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$car_id]);
    return $stmt->fetch();
}
function updateCar($pdo, $car_model, $rental_price, $car_id) {
    $sql = "UPDATE Cars SET car_model = ?, rental_price = ? WHERE car_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$car_model, $rental_price, $car_id]);
}
function deleteCar($pdo, $car_id) {
    $sql = "DELETE FROM Cars WHERE car_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$car_id]);
}
function getActionsByCarID($pdo, $car_id) {
    $sql = "SELECT * FROM Actions WHERE car_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$car_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function updateCustomerInfo($pdo, $customer_name, $contact_info, $rental_months, $car_id) {
    $sql = "UPDATE Cars SET customer_name = ?, contact_info = ?, rental_months = ? WHERE car_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$customer_name, $contact_info, $rental_months, $car_id]);
}
function getUserByID($pdo, $user_id) {
    $sql = "SELECT * FROM Users WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllUsers($pdo) {
    $stmt = $pdo->prepare("SELECT user_id, first_name, last_name, address, age, username, email, created_at FROM Users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>