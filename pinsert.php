<?php

if(isset($_POST['submit']))
{
    include 'config.php';
    $product_name = $_POST['Pname'];
    $product_price = $_POST['Pprice'];
    $product_image = $_FILES['Pimage'];
    // print_r($product_image);
    $image_loc = $_FILES['Pimage']['tmp_name'];
    $image_name = $_FILES['Pimage']['name'] ;
    $product_category = $_POST['Pcategory'];
    $img_des = "uploadphoto/".$image_name;

    move_uploaded_file($image_loc,"uploadphoto/".$image_name);

    //insert product
    mysqli_query($con,"INSERT INTO `tblproduct`(`PName`, `PPrice`, `PImage`, `PCategory`) VALUES ('$product_name','$product_price','$img_des','$product_category')");
}
header("location:products.php");
?>

<!-- //fetch data -->
