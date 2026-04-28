<?php
include 'db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sid = $_POST['shipment_id'];
    $status = mysqli_real_escape_string($conn, $_POST['new_status']);
    $loc = mysqli_real_escape_string($conn, $_POST['new_location']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment_status']);

    $sql = "UPDATE tbl_shipments SET current_status = '$status', location = '$loc', payment_status = '$payment',  updated_at = NOW()  WHERE id = '$sid'";

    if(mysqli_query($conn, $sql)) {
        header("Location: admin_shipments.php?msg=updated");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>