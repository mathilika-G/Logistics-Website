<?php
include 'db_connect.php';

$category = $_GET['cat'] ?? 'All';

if ($category == 'All') {
    $sql = "SELECT * FROM tbl_products ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM tbl_products WHERE product_category = '$category' ORDER BY id DESC";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | <?php echo $category; ?> Showcase</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> </head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold" style="color: #262223;"><?php echo strtoupper($category); ?> CATALOG</h2>
        <div style="width: 60px; height: 3px; background: #ffd700; margin: 10px auto;"></div>
    </div>

    <div class="row">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="img/products/<?php echo $row['product_image']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body text-center">
                            <h6 class="text-muted small mb-1"><?php echo $row['product_category']; ?></h6>
                            <h5 class="font-weight-bold"><?php echo $row['product_name']; ?></h5>
                            <hr style="width: 40px; border-top: 2px solid #ffd700; margin: 15px auto;">
                            
                            <button type="button" class="btn btn-warning btn-block font-weight-bold py-2 " data-toggle="modal" data-target="#modal<?php echo $row['id']; ?>">
                                KNOW MORE
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal<?php echo $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-body p-0">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <img src="img/products/<?php echo $row['product_image']; ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-6 p-4">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="font-weight-bold mt-2"><?php echo $row['product_name']; ?></h3>
                                        <p class="badge badge-warning"><?php echo $row['source_type']; ?></p>
                                        
                                        <div class="my-4">
                                            <h6 class="font-weight-bold">Product Brief:</h6>
                                            <p class="text-muted"><?php echo $row['product_description']; ?></p>
                                        </div>

                                        <a href="contact.php?product=<?php echo urlencode($row['product_name']); ?>" class="btn btn-warning btn-block font-weight-bold py-2">
                                            SEND REQUIREMENT
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fa fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No items found in this category.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>