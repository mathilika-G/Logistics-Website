<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $res = mysqli_query($conn, "SELECT product_image FROM tbl_products WHERE id = '$id'");
    $row = mysqli_fetch_assoc($res);
    $image_path = "../img/products/" . $row['product_image'];


    $delete_sql = "DELETE FROM tbl_products WHERE id = '$id'";
    if (mysqli_query($conn, $delete_sql)) {
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        header("Location: manage_products.php?msg=deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: manage_products.php");
}
?>