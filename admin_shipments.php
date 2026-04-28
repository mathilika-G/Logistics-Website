<?php
session_start();
include 'db_connect.php';

$query = "SELECT s.*, q.Name, q.Origin, q.Destination 
          FROM tbl_shipments s 
          JOIN tbl_QuoteForm q ON s.quote_id = q.Id 
          ORDER BY s.updated_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | Admin Quotes</title>
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
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 style="color: #262223; font-weight: bold;">Shipment Operations</h2>
            </div>
        </div>

        <div class="section-card">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th>Tracking ID</th>
                        <th>Customer</th>
                        <th>Current Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { 
                        $status = $row['current_status'];
                        $badgeClass = ($status == 'Delivered') ? 'badge-success' : 'badge-weight';
                    ?>
                    <tr>
                        <td class="align-middle"><strong><?php echo $row['tracking_id']; ?></strong></td>
                        <td class="align-middle"><?php echo $row['Name']; ?></td>
                        <td class="align-middle text-muted"><?php echo $row['location']; ?></td>
                        <td class="align-middle">
                            <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                        </td>
                        <td class="align-middle">
                            <form action="update_status.php" method="POST" class="form-inline shipment-update-form">
                                <input type="hidden" name="shipment_id" value="<?php echo $row['id']; ?>">
                                
                                <select name="new_status" class="form-control form-control-sm status-select mr-2">
                                    <option value="Ordered" <?php if($status=='Ordered') echo 'selected'; ?>>Ordered</option>
                                    <option value="In Transit" <?php if($status=='In Transit') echo 'selected'; ?>>In Transit</option>
                                    <option value="Arrived at Hub" <?php if($status=='Arrived at Hub') echo 'selected'; ?>>Arrived at Hub</option>
                                    <option value="Out for Delivery" <?php if($status=='Out for Delivery') echo 'selected'; ?>>Out for Delivery</option>
                                    <option value="Delivered" <?php if($status=='Delivered') echo 'selected'; ?>>Delivered</option>
                                </select>
                                
                                <input type="text" name="new_location" placeholder="New Location" class="form-control form-control-sm location-input mr-2" required>
                                <select name="payment_status" class="form-control form-control-sm mr-2">
                                    <option value="Unpaid" <?php if($row['payment_status'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                                    <option value="Paid" <?php if($row['payment_status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                                </select>
                                
                                <button type="submit" class="btn btn-approve btn-sm">
                                    <i class="fa fa-sync-alt"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/admin.js"></script>    

</body>
</html>