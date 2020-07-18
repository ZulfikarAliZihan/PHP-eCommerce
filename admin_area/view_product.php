<table width="700px" style="margin:auto; margin-bottom:25px;" id="table1">
<h1 style="text-align: center;">Manage All Products</h1>
<tr style="color: black; background-color:skyblue;">
    <td>S.N</td>
    <td>Product Name</td>
    <td>Product Image</td>
    <td>Edit Product</td>
    <td>Delete Product</td>
</tr>

<?php 
include('../includes/db.php');
$sql="select * from products";
$sql_query=mysqli_query($con,$sql);
$sl=0;
while($data=mysqli_fetch_array($sql_query)){
$pro_id=$data['product_id'];
$pro_name=$data['product_title'];
$pro_image=$data['product_image'];
$sl=$sl+1;
?>
<tr>
    <td><?php echo $sl?></td>
    <td><?php echo $pro_name?></td>
    <td><img src='product_image/<?php echo $pro_image?>' width="60px" ></td>
    <td style="line-height:70px;"><a href="index.php?edit_product=<?php echo $pro_id?>">Edit</a></td>
    <td><a href="index.php?delete_product=<?php echo $pro_id?>">Delete</a></td>
</tr>

<?php } ?>

</table>