<?php
session_start();
include 'db_connect.php';

$search = $_GET['search_product'] ?? '';

$query = "SELECT * FROM tbl_products";

if(!empty($search)) {
    $query .= " WHERE product_name LIKE '%$search%' OR product_category LIKE '%$search%'";
}

$query .= " ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | Manage Products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/new.css" rel="stylesheet">
</head>

<body>
    <?php include "admin_header.php" ?>

    <div class="admin-main">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 style="color: #262223; font-weight: bold;">Product Management</h2>
            </div>
            <div class="d-flex align-items-center">
                <form method="GET" class="mr-3">
                    <input type="text" name="search_product" class="form-control" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                </form>
                <a href="add_products.php" class="btn btn-warning-custom px-4">
                    <i class="fa fa-plus-circle mr-2"></i> ADD NEW PRODUCT
                </a>
            </div>
        </div>

        <div class="report-container">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="audit-strip p-0 mb-3 shadow-sm overflow-hidden border-0">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-1 text-center bg-light p-2 border-right">
                                <img src="../img/products/<?php echo $row['product_image']; ?>" 
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            </div>

                            <div class="col-md-3 pl-4">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">PRODUCT NAME</small>
                                <strong style="color: #1a1a1a; font-size: 1.1rem;"><?php echo $row['product_name']; ?></strong>
                            </div>

                            <div class="col-md-2 border-left pl-4">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">CATEGORY</small>
                                <span class="badge badge-pill badge-info px-3 py-2"><?php echo $row['product_category']; ?></span>
                            </div>

                            <div class="col-md-2 border-left pl-4">
                                <small class="text-muted d-block font-weight-bold" style="letter-spacing: 1px;">SOURCE</small>
                                <span class="small font-weight-bold <?php echo ($row['source_type'] == 'Produced') ? 'text-success' : 'text-primary'; ?>">
                                    <i class="fa <?php echo ($row['source_type'] == 'Produced') ? 'fa-industry' : 'fa-handshake'; ?> mr-1"></i>
                                    <?php echo strtoupper($row['source_type']); ?>
                                </span>
                            </div>

                            <div class="col-md-4 border-left text-right pr-4">
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-dark mx-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="delete_product.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Are you sure you want to remove this product?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>

                        <div class="bg-light px-4 py-2 border-top small text-muted">
                            <div class="row">
                                <div class="col-md-10">
                                    <i class="fa fa-info-circle mr-2 text-gold"></i> 
                                    <strong>Brief:</strong> <?php echo substr($row['product_description'], 0, 120); ?>...
                                </div>
                                <div class="col-md-2 text-right">
                                    <strong>ID:</strong> #PRD-<?php echo $row['id']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="card p-5 text-center border-0 shadow-sm rounded">
                    <i class="fa fa-box-open fa-3x mb-3 text-muted"></i>
                    <h5 class="text-muted">No products found in the catalog</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>