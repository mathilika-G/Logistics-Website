<?php
session_start();
include 'db_connect.php'; 

$message = "";

if (isset($_POST['submit_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $desc = mysqli_real_escape_string($conn, $_POST['product_description']);
    $source = mysqli_real_escape_string($conn, $_POST['source_type']);

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Import_Export_Web/img/products/"; 
    
    if (!file_exists($target_dir)) { 
        mkdir($target_dir, 0777, true); 
    }

    if (!empty($_FILES["product_image"]["name"])) {
        $file_extension = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = "prod_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        if (!is_writable($target_dir)) {
            $message = "<div class='alert alert-danger'>ERROR: The folder $target_dir is NOT writable. Right-click 'img' folder -> Properties -> Uncheck Read-Only.</div>";
        } 
        else if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            
            $sql = "INSERT INTO tbl_products (product_name, product_category, product_description, product_image, source_type) 
                    VALUES ('$name', '$category', '$desc', '$new_file_name', '$source')";
            
            if (mysqli_query($conn, $sql)) {
                $message = "<div class='alert alert-success'>SUCCESS! File is now in: $target_file</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>UPLOAD FAILED: PHP could not move the file. Error Code: " . $_FILES["product_image"]["error"] . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | Add Product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="css/new.css" rel="stylesheet">

    <style>
        body { background-color: #f4f7f6; }
        .btn-publish { background-color: #ffd700; color: #000; font-weight: bold; border: none; transition: 0.3s; }
        .btn-publish:hover { background-color: #e6c200; transform: translateY(-2px); }
        .card-custom { border-radius: 15px; border: none; }
        .image-preview { 
            width: 100%; height: 200px; border: 2px dashed #ddd; 
            border-radius: 10px; display: flex; align-items: center; 
            justify-content: center; overflow: hidden; background: #fff;
        }
        .image-preview img { max-width: 100%; max-height: 100%; object-fit: cover; }
    </style>

</head>

<body>
    <?php include "admin_header.php" ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 style="font-weight: 700;">Upload New Product</h2>
                    <a href="manage_products.php" class="btn btn-outline-secondary btn-sm">Back to List</a>
                </div>
                
                <div class="card card-custom shadow">
                    <div class="card-body p-5">
                        <?php echo $message; ?>
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" placeholder="e.g. Premium Red Onions" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Category</label>
                                            <select name="product_category" class="form-control" required>
                                                <option value="" disabled selected>Choose...</option>
                                                <option value="Handicrafts">Handicrafts</option>
                                                <option value="Furniture">Furniture</option>
                                                <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="font-weight-bold">Description</label>
                                        <textarea name="product_description" class="form-control" rows="5" placeholder="Details about quality and origin..."></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="font-weight-bold">Product Image</label>
                                    <div class="image-preview mb-2" id="imagePreview">
                                        <span class="text-muted">No Image Selected</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="product_image" class="custom-file-input" id="productImage" required>
                                        <label class="custom-file-label">Choose File</label>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="font-weight-bold">Source</label>
                                        <select name="source_type" class="form-control">
                                            <option value="Produced">In-House</option>
                                            <option value="Bought">Third-Party</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 border-top pt-4 text-right">
                                <button type="submit" name="submit_product" class="btn btn-publish px-5 py-2">
                                    <i class="fa fa-paper-plane mr-2"></i> PUBLISH TO CATALOG
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $("#productImage").on("change", function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").html('<img src="' + e.target.result + '">');
                }
                reader.readAsDataURL(file);
                
                var fileName = file.name;
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            }
        });
    </script>
</body>
</html>