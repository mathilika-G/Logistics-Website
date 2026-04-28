<?php
include 'db_connect.php';

$data = null; 
$tid = "";

if(isset($_GET['tracking_id'])) {
    $tid = mysqli_real_escape_string($conn, $_GET['tracking_id']);
    
    $sql = "SELECT s.*, q.Origin, q.Destination, q.Name FROM tbl_shipments s JOIN tbl_QuoteForm q ON s.quote_id = q.Id WHERE s.tracking_id = '$tid'";
            
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Track Shipment | SHADOWWS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/new.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="track-card">
        <div class="track-header">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-label">TRACKING NUMBER</p>
                    <h3 class="font-weight-bold"><?php echo $tid; ?></h3>
                    <p class="mb-0">Customer: <strong><?php echo $data['Name']; ?></strong></p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p class="text-label">EXPECTED ARRIVAL</p>
                    <h3 class="text-gold"><?php echo date('M d, Y', strtotime($data['expected_delivery'])); ?></h3>
                </div>
            </div>
        </div>

        <div class="track-body">
            <div class="timeline-container">
                <?php 
                    $status = $data['current_status']; 
                    $stages = ["Ordered", "In Transit", "Arrived at Hub", "Out for Delivery", "Delivered"];
                    $current_idx = array_search($status, $stages);
                ?>
                <?php foreach($stages as $key => $stage): ?>
                    <div class="timeline-item <?php echo ($key <= $current_idx) ? 'active' : ''; ?>">
                        <div class="timeline-icon">
                            <i class="fa <?php echo ($stage == 'Delivered') ? 'fa-check' : 'fa-truck'; ?>"></i>
                        </div>
                        <p class="timeline-text"><?php echo $stage; ?></p>
                        <?php if($key < 4): ?><div class="timeline-line"></div><?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="location-update">
                <div class="d-flex align-items-center">
                    <div class="loc-pin"><i class="fa fa-map-marker-alt"></i></div>
                    <div>
                        <p class="text-label mb-0">CURRENT LOCATION</p>
                        <h5 class="mb-0"><?php echo $data['location']; ?></h5>
                    </div>
                </div>
                <div class="text-right ml-auto">
                    <small class="text-muted">Updated: <?php echo $data['updated_at']; ?></small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>