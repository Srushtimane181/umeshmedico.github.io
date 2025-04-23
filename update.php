 













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <style>
        .custom-color {
            color: #16a085;
        }
        .custom-bg {
            background-color: #16a085;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    
    // if (isset($_GET['ID']) && !empty($_GET['ID'])) {
        $id = intval($_GET['ID']);
        $Record = mysqli_query($con, "SELECT * FROM tblproduct WHERE Id = $id");
        $data = mysqli_fetch_array($Record);
    // } else {
        // die("Invalid Product ID");
    // }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto border border-secondary mt-3 ">
                <form action="update.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <p class="text-center fw-bold fs-3 custom-color">Product Update</p>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" value="<?php echo $data['PName']?>" name="Pname" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="text" value="<?php echo $data['PPrice']?>" name="Pprice" class="form-control" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="productimage" class="form-label">Product Image</label>
                        <input type="file" name="Pimage" class="form-control" id="productimage">
                        <img src="<?php echo $data['PImage']?>" alt="" style="height:150px;">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Product category</label>
                        <select class="form-select" name="Pcategory">
                            <option value="Prescreptions Medicications">Prescreptions Medicications</option>
                            <option value="OTC">OTC</option>
                            <option value="Vaccines">Vaccines</option>
                            <option value="Herbal Supplements">Herbal Supplements</option>
                            <option value="Vitamins and Minerals">Vitamins and Minerals</option>
                            <option value="Topical treatments">Topical treatments</option>
                            <option value="Pain Relief Medications">Pain Relief Medications</option>
                            <option value="Antibiotics">Antibiotics</option>
                            <option value="Chronic conditions">Chronic conditions</option>
                            <option value="Emergency Medications">Emergency Medications</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data['Id']?>">
                    <button class="custom-bg fs-4 fw-bold my-3 form-control text-white" name="update">Update</button><br>
                </form>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['update'])) {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            die("Product ID is missing.");
        }

        $id = intval($_POST['id']);
        $product_name = $_POST['Pname'];
        $product_price = $_POST['Pprice'];
        $product_image = $_FILES['Pimage'];
        $product_category = $_POST['Pcategory'];

        if (!empty($product_image['name'])) {
            $image_loc = $product_image['tmp_name'];
            $image_name = $product_image['name'];
            $img_des = "uploadphoto/" . $image_name;
            move_uploaded_file($image_loc, $img_des);
        } else {
            $img_query = mysqli_query($con, "SELECT PImage FROM tblproduct WHERE Id = $id");
            $img_data = mysqli_fetch_array($img_query);
            $img_des = $img_data['PImage'];
        }

        $update_query = "UPDATE tblproduct SET PName='$product_name', PPrice='$product_price', PImage='$img_des', PCategory='$product_category' WHERE Id = $id";
        
        if (mysqli_query($con, $update_query)) {
            header("location:products.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
    ?>
</body>
</html>
