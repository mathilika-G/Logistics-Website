<?php
session_start();
include 'db_connect.php';

$query = "SELECT * FROM tbl_QuoteForm ORDER BY id DESC";
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
                <h2 style="color: #262223; font-weight: bold;">Quote Management</h2>
            </div>
        </div>

        <div class="section-card">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Info</th>
                        <th>Route</th>
                        <th>Specifications</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="align-middle">#<?php echo $row['Id']; ?></td>
                        <td class="align-middle">
                            <div class="font-weight-bold"><?php echo $row['Name']; ?></div>
                            <small class="text-muted"><?php echo $row['Email']; ?></small><br>
                            <small class="text-muted"><?php echo $row['Phone']; ?></small>
                        </td>
                        <td class="align-middle">
                            <span class="text-dark"><?php echo $row['Origin']; ?></span> 
                            <i class="fa fa-arrow-right mx-2 text-warning"></i> 
                            <span class="text-dark"><?php echo $row['Destination']; ?></span>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-weight"><?php echo $row['Weight']; ?> KG</span>
                            <span class="badge badge-light border"><?php echo $row['Dimension']; ?> CM</span>
                        </td>
                        <td class="align-middle text-muted" style="font-size: 13px;">
                            <?php echo date('M d, Y', strtotime($row['Created_at'])); ?>
                        </td>
                        <td class="align-middle">
                            <?php if($row['Status'] == 'quoted' || $row['Status'] == 'accepted'): ?>
                                <button class="btn btn-success btn-sm px-3 disabled">
                                    <i class="fa fa-check mr-1"></i> Approved</button><?php else: ?>
                                <button class="btn btn-approve btn-sm px-3 approve-ajax" data-id="<?php echo $row['Id']; ?>">
                                    <i class="fa fa-paper-plane mr-1"></i> Approve</button><?php endif; ?>
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
</html/>