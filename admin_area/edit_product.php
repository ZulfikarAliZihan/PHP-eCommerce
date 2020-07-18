<?php
include("../function/functions.php");
include("../includes/db.php");
$id=$_GET['edit_product'];
$sql = "select * from products where product_id='$id'";
            $pro_data = mysqli_query($con, $sql);
            $pro_row=mysqli_fetch_array($pro_data);
            $pro_id=$pro_row['product_id'];
            $pro_title=$pro_row['product_title'];
            $pro_image=$pro_row['product_image'];
            $pro_price=$pro_row['product_price'];
            $pro_brand=$pro_row['product_brand'];
            $pro_cat=$pro_row['product_cat'];
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="styles/admin_style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


</head>
<body>
    <form action="insert_product.php" name="insert_product" id="insert_product" method="post" enctype="multipart/form-data">
        <table>
            <th>
            Edit a Product
            </th>
            <tr>
                <td>Product Title</td>
                <td><input type="text" name="product_title" size="60" value="<?php echo $pro_title?>"></td>
            </tr>
            <tr>
                <td>Product Category</td>
                <td>
                    <select name="product_cat" id="product_cat">
                        <option value=""><?php getCats_for_edit($id); ?></option>
                        <?php getCats_for_insert()?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Product Brand</td>
                <td>
                    <select name="product_brand" id="product_brand">
                        <option value="">Select a Brand</option>
                        <?php getBrands_for_insert(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Product Price</td>
                <td><input type="text" name="product_price"></td>
            </tr>
            <tr>
                <td>Product Description</td>
                <td><textarea name="editor1"></textarea>
                <script>
                        CKEDITOR.replace( 'editor1' );
                </script></td>
            </tr>
            <tr>
                <td>Product Image</td>
                <td><input type="file" name="product_image"></td>
            </tr>
            <tr>
                <td>Product Keywords</td>
                <td><input type="text" name="product_keywords" size="50"></td>
            </tr>
            <tr>
                <td>Product Title</td>
                <td><input type="submit" name="submit" id="submit"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

if(isset($_POST['submit'])){
    //get product data
   $product_title=$_POST['product_title'];
   $product_cat=$_POST['product_cat'];
   $product_brand=$_POST['product_brand'];
   $product_price=$_POST['product_price'];
   $product_desc=$_POST['editor1'];
   $product_keywords=$_POST['product_keywords'];
   
   //get product image
   $product_image=$_FILES['product_image']['name'];
   $product_image_temp=$_FILES['product_image']['tmp_name'];
   
   //move the image file
   move_uploaded_file($product_image_temp,"product_image/$product_image");

   //insert into database
    $sql="insert into products (product_title,product_cat,product_brand,product_price,product_desc,product_image,product_keywords) values ('$product_title','$product_cat','$product_brand','$product_price','$product_desc','$product_image','$product_keywords')";

    $insert=mysqli_query($con,$sql);

    if(isset($insert)){
        //$_POST['submit']="";
        echo "<script>alert('Product add successfuly ')</script>";
        echo "<script>window.open('index.php?view_product',self)</window></script>";
    }

}


?>