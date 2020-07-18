<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin_style.css" media="all">
    <title>Admin Panel</title>
</head>
<body>
    <div class="main_wrapper">
        <div id="header"> </div>
        <div id="left">
            <h2 style="text-align: center; color:chartreuse;">Manage Content</h2>

            <a href="index.php?insert">Insert Product</a>
            <a href="index.php?view_product">View All Product</a>
            <a href="index.php?insert_cat">Insert Category</a>
            <a href="index.php?insert_brands">Insert Brand</a>
            <a href="index.php?view_customers">View Customers</a>
            <a href="index.php?view_orders">View Orders</a>
            <a href="index.php?view_payments">View Payments</a>
        
    </div>
        <div id="right"> 
        
        <?php
        if(isset($_GET['insert'])){
            include('insert_product.php');
        }
        
        
        if(isset($_GET['view_product'])){
            include('view_product.php');
        }
        
        if(isset($_GET['edit_product'])){
            include('edit_product.php');
        }
        
        ?>
        </div>

    </div>
</body>
</html>


<?php
include('../includes/db.php');
if(isset($_GET['delete_product'])){
    $id=$_GET['delete_product'];
    $delete_sql="delete from products where product_id='$id'";
    $delete_query=mysqli_query($con,$delete_sql);
    if($delete_query){
       echo "<script>alert('Successfully deleted')</script>";
       echo "<script>window.open('index.php?view_product','_self')</script>";
    }
}
?>


