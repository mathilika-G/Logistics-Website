<?php
include "db_connect.php";

$errors = [];

$origin      = $_POST['departure'] ?? '';
$destination = $_POST['delivery'] ?? '';
$weight      = $_POST['weight'] ?? 0;
$dimension   = $_POST['dimension'] ?? 0;
$name        = $_POST['name'] ?? '';
$email       = $_POST['email'] ?? '';
$phone       = $_POST['phonono'] ?? '';
$message     = $_POST['message'] ?? '';

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email Address";
}
if(!preg_match('/^[0-9]{10}$/', $phone)) {
    $errors[] = "Phone must be 10 digits";
}

if(!empty($errors)) {
    echo implode("<br>", $errors);
    exit();
}

$sql = "INSERT INTO tbl_QuoteForm (Origin, Destination, Weight, Dimension, Name, Email, Phone, Message) 
        VALUES ('$origin', '$destination', '$weight', '$dimension', '$name', '$email', '$phone', '$message')";

if(mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Database Error: " . mysqli_error($conn);
}
?>
