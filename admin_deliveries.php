<?php
session_start();
include 'db_connect.php';

$total_quotes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_QuoteForm"))['count'];
$total_shipments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_shipments"))['count'];
$delivered = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_shipments WHERE current_status='Delivered'"))['count'];

$search = $_GET['search_client'] ?? '';

$query = "SELECT s.*, q.Name, q.Email, q.Phone, q.Origin, q.Destination, q.Weight, q.Dimension, q.Quoted_price, q.created_at as order_date 
          FROM tbl_shipments s 
          JOIN tbl_QuoteForm q ON s.quote_id = q.Id 
          WHERE s.current_status = 'Delivered'";

if(!empty($search)) {
    $query .= " AND (q.Name LIKE '%$search%' OR s.tracking_id LIKE '%$search%')";
}

$query .= " ORDER BY s.updated_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | Deliveries History</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/new.css" rel="stylesheet">
</head>
<body>
     
    <?php include "admin_header.php" ?>

    <div class="admin-main">
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <h2 style="font-weight: bold;">Business Overview</h2>
            <button onclick="window.print()" class="btn btn-approve">
                <i class="fa fa-print mr-2"></i> Print All Logs
            </button>
        </div>

        <form method="GET" class="mb-4 no-print">
            <div class="input-group" style="max-width: 450px;">
                <input type="text" name="search_client" class="form-control" placeholder="Search Client Name..." value="<?php echo htmlspecialchars($search); ?>">
                <div class="input-group-append">
                    <button class="btn btn-dark" type="submit">Search</button>
                    <?php if(!empty($search)): ?>
                        <a href="admin_reports.php" class="btn btn-outline-secondary">Clear</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
       
        <div class="row mb-4 no-print">
            <div class="col-md-4"><div class="report-stats-card"><p>Total Enquiries</p><h3><?php echo $total_quotes; ?></h3></div></div>
            <div class="col-md-4"><div class="report-stats-card"><p>Active Shipments</p><h3><?php echo $total_shipments; ?></h3></div></div>
            <div class="col-md-4"><div class="report-stats-card gold-variant"><p>Completed Deliveries</p><h3><?php echo $delivered; ?></h3></div></div>
        </div>

        <h4 class="mb-3 no-print">Completed Shipment Logs</h4>
        
        <div class="report-container">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="section-card p-4 mb-4 shipment-entry" style="border: 1px solid #eee; background: #fff;">
                    
                    <div class="company-header-print d-none">
                        <div class="row align-items-center">
                            <div class="col-6 text-left">
                                <h2 style="color:black; margin:0; font-weight:800;">SHADOWWS</h2>
                                <p class="small">Shadowws 2'nd Floor, No.12 & 13 Ashtalakshmi Nagar,<br>Thirunagar, Madurai, TN - 625006.</p>
                            </div>
                            <div class="col-6 text-right">
                                <h4 style="font-weight:bold;">DELIVERY RECEIPT</h4>
                                <p class="small">Tracking ID: <strong><?php echo $row['tracking_id']; ?></strong></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-left mb-3">
                            <div class="col-6">
                                <p class="mb-0 small text-uppercase font-weight-bold text-muted">Customer Details:</p>
                                <strong><?php echo $row['Name']; ?></strong><br>
                                <?php echo $row['Phone']; ?> | <?php echo $row['Email']; ?><br>
                                Destination: <?php echo $row['Destination']; ?>
                            </div>
                            <div class="col-6 text-right">
                                <p class="mb-0 small text-uppercase font-weight-bold text-muted">Order Timeline:</p>
                                Order Placed: <?php echo date('d-M-Y', strtotime($row['order_date'])); ?><br>
                                Delivery Done: <?php echo date('d-M-Y', strtotime($row['updated_at'])); ?><br>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr class="small text-uppercase">
                                <th>Client / Description</th>
                                <th>Weight & Dimension</th>
                                <th>Full Route</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    <strong><?php echo $row['Name']; ?></strong><br>
                                    <span class="text-muted small">Standard Logistics Item</span>
                                </td>
                                <td class="align-middle">
                                    <?php echo $row['Weight']; ?> kg<br>
                                    <small class="text-muted"><?php echo $row['Dimension'] ?? 'N/A'; ?> cm</small>
                                </td>
                                <td class="align-middle small">
                                    <?php echo $row['Origin']; ?> <i class="fa fa-arrow-right text-warning"></i> <?php echo $row['Destination']; ?>
                                </td>
                                <td class="align-middle font-weight-bold">
                                    Rs. <?php echo number_format($row['Quoted_price'], 2); ?>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-success px-3 py-2">PAID</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>