<?php
session_start();
include 'db_connect.php';

$query = "SELECT Name, Email, Phone, COUNT(*) as total_quotes FROM tbl_QuoteForm GROUP BY Email ORDER BY Name ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | Customer List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/new.css" rel="stylesheet">
</head>
<body>
    <?php include "admin_header.php" ?>

    <div class="admin-main">
        <h2 class="mb-4" style="font-weight: bold;">Client Directory</h2>

        <div class="section-card">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Contact Email</th>
                        <th>Phone Number</th>
                        <th>Total Interactions</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="align-middle"><strong><?php echo $row['Name']; ?></strong></td>
                        <td class="align-middle"><?php echo $row['Email']; ?></td>
                        <td class="align-middle"><?php echo $row['Phone']; ?></td>
                        <td class="align-middle text-center">
                            <span class="badge badge-weight"><?php echo $row['total_quotes']; ?> Quotes</span>
                        </td>
                        <td class="align-middle">
                            <span class="text-success small"><i class="fa fa-circle mr-1"></i> Active Client</span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>