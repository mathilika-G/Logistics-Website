<?php
include 'db_connect.php';

if(isset($_GET['qid'])) {
    $qid = $_GET['qid'];
    $tracking_id = "SHD-" . strtoupper(uniqid());
    $delivery_date = date('Y-m-d', strtotime('+7 days'));
    $initial_location = "Processing Center, Madurai"; 

    mysqli_query($conn, "UPDATE tbl_QuoteForm SET Status = 'accepted' WHERE Id = '$qid'");

    $sql = "INSERT INTO tbl_shipments (quote_id, tracking_id, current_status, location, expected_delivery) 
        VALUES ('$qid', '$tracking_id', 'Ordered', '$initial_location', '$delivery_date')";
    
    if(mysqli_query($conn, $sql)) {
        echo "<div style='text-align:center; margin-top:50px;'>
                <h1>Shipment Confirmed!</h1>
                <p>Your Tracking ID: <strong>$tracking_id</strong></p>
              </div>";
    }
}
?>
