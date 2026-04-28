<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM tbl_products WHERE id = '$id'");
    $data = mysqli_fetch_assoc($res);

    if (!$data) {
        header("Location: manage_products.php");
        exit();
    }
} else {
    header("Location: manage_products.php");
    exit();
}

$message = "";

if (isset($_POST['update_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = $_POST['product_category'];
    $desc = mysqli_real_escape_string($conn, $_POST['product_description']);
    $source = $_POST['source_type'];

    if (!empty($_FILES['product_image']['name'])) {
        $target_dir = "../img/products/";
        $new_file_name = "prod_" . time() . "." . pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_dir . $new_file_name);
        $final_image = $new_file_name;
    } else {
        $final_image = $data['product_image']; 
    }

    $update_sql = "UPDATE tbl_products SET 
                   product_name = '$name', 
                   product_category = '$category', 
                   product_description = '$desc', 
                   product_image = '$final_image', 
                   source_type = '$source' 
                   WHERE id = '$id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: manage_products.php?msg=updated");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Update Failed: " . mysqli_error($conn) . "</div>";
    }
}
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

<body class="bg-light">
    <?php include "admin_header.php" ?>

    <div class="admin-main">
        <div class="container-fluid">
            <h2 class="mb-4 " style="font-weight: bold"><?php echo $data['product_name']; ?></h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <?php echo $message; ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="<?php echo $data['product_name']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Category</label>
                                <select name="product_category" class="form-control" required>
                                    <option value="Handicrafts" <?php if($data['product_category'] == 'Handicrafts') echo 'selected'; ?>>Handicrafts</option>
                                    <option value="Furniture" <?php if($data['product_category'] == 'Furniture') echo 'selected'; ?>>Furniture</option>
                                    <option value="Fruits & Vegetables" <?php if($data['product_category'] == 'Fruits & Vegetables') echo 'selected'; ?>>Fruits & Vegetables</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="product_description" class="form-control" rows="4"><?php echo $data['product_description']; ?></textarea>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-md-4 mb-3">
                                <label>Production Source</label>
                                <select name="source_type" class="form-control">
                                    <option value="Produced" <?php if($data['source_type'] == 'Produced') echo 'selected'; ?>>Produced</option>
                                    <option value="Bought" <?php if($data['source_type'] == 'Bought') echo 'selected'; ?>>Bought</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3 text-center">
                                <p class="small text-muted mb-1">Current Image</p>
                                <img src="../img/products/<?php echo $data['product_image']; ?>" class="current-img-preview">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Change Image (Leave blank to keep current)</label>
                                <input type="file" name="product_image" class="form-control-file">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="update_product" class="btn btn-update px-5">SAVE CHANGES</button>
                            <a href="manage_products.php" class="btn btn-light border px-4">CANCEL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>