<?php
session_start();
include 'db_connect.php';

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
    <title>SHADOWWS | Logistics Audit Reports</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/new.css" rel="stylesheet">
</head>

<body>
    <?php include "admin_header.php" ?>

    <div class="admin-main">
        <div class="d-flex justify-content-between align-items-end mb-4 no-print">
            <div>
                <h2 style="color: #262223; font-weight: bold;">Reports & Analytics</h2>

            </div>
            <div class="d-flex align-items-center">
                <form method="GET" class="mr-3">
                    <input type="text" name="search_client" class="form-control" placeholder="Search ..." value="<?php echo htmlspecialchars($search); ?>">
                </form>
                <button onclick="window.print()" class="btn btn-warning-custom px-4">
                    <i class="fa fa-file-export mr-2"></i> EXPORT PDF
                </button>
            </div>
        </div>


        <div class="report-container">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="audit-strip p-0 mb-4 shadow-sm overflow-hidden">
                        
                        <div class="company-header-print d-none p-4 text-center border-bottom">
                            <h2 style="font-weight: 800; color: #000;">SHADOWWS LOGISTICS</h2>
                            <p class="mb-0">Audit Record | Generated: <?php echo date('d M Y'); ?> | Tracking ID: <?php echo $row['tracking_id']; ?></p>
                        </div>

                        <div class="row no-gutters p-4 align-items-center">
                            <div class="col-md-2">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">TRACKING ID</small>
                                <span class="font-weight-bold" style="color: #1a1a1a; font-size: 1.1rem;">#<?php echo $row['tracking_id']; ?></span>
                            </div>
                            <div class="col-md-3 border-left pl-4">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">CUSTOMER</small>
                                <strong style="color: #1a1a1a;"><?php echo $row['Name']; ?></strong>
                            </div>
                            <div class="col-md-3 border-left pl-4">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">ROUTE</small>
                                <span class="small font-weight-bold text-dark"><?php echo $row['Origin']; ?> <i class="fa fa-arrow-right text-gold mx-2"></i> <?php echo $row['Destination']; ?></span>
                            </div>
                            <div class="col-md-2 border-left pl-4">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">FINANCIALS</small>
                                <strong class="text-dark">Rs. <?php echo number_format($row['Quoted_price'], 2); ?></strong>
                            </div>
                            <div class="col-md-2 border-left text-right pr-4">
                                <small class="text-muted d-block font-weight-bold mb-1">AUDIT STATUS</small>
                                <span class="badge badge-status">
                                    <i class="fa fa-check-circle mr-1"></i> VERIFIED
                                </span>
                            </div>
                        </div>

                        <div class="bg-light px-4 py-3 border-top small text-muted">
                            <div class="row">
                                <div class="col-md-4"><i class="fa fa-calendar-alt mr-2 text-gold"></i> <strong>Placed:</strong> <?php echo date('d M, Y', strtotime($row['order_date'])); ?></div>
                                <div class="col-md-4"><i class="fa fa-shipping-fast mr-2 text-gold"></i> <strong>Delivered:</strong> <?php echo date('d M, Y', strtotime($row['updated_at'])); ?></div>
                                <div class="col-md-4 text-right"><i class="fa fa-weight-hanging mr-2 text-gold"></i> <strong>Metrics:</strong> <?php echo $row['Weight']; ?>kg | <?php echo $row['Dimension']; ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="card p-5 text-center border-0 shadow-sm rounded">
                    <i class="fa fa-folder-open fa-3x mb-3 text-muted"></i>
                    <h5 class="text-muted">No audit records match your search criteria</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>