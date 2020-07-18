<?php
include("function/functions.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecomerce Site</title>

    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
    <!--Main  Container starts here-->
    <div class="main_wrapper">

        <!--Header  wrapper starts here-->
        <div class="header_wrapper">
            <img src="images/logo.png" alt="Site-logo" id="logo">
            <img src="images/banner.gif" alt="Site-Banner" id="banner">
            
            <div class="menu">
                <?php
                getMenu();
                ?>
                <div id="search">
                    <form action="index.php" method="get" enctype="multipart/form-data">
                        <input type="text" name="user_query" placeholder="Search a product  ">
                        <input type="submit" value="Search" name="submit">
                    </form>
                </div>
            </div>
        </div>
        <!--Header  wrapper ends here-->

        <!--Content  wrapper starts here-->
        <div class="content_wrapper">
           
            <div id="side_bar">

               <div id="side_bar_type">Categories</div>
                <ul id="cats">
                    <?php
                    getCats();
                    ?>
                </ul>

                <div id="side_bar_type">Brands</div>
                <ul id="cats">
                <?php
                    getBrands();
                    ?>
                </ul>
               
            </div>
            
            

            <div id="content_area">

                <div id="shoping_cart">
                    <span>
                    <?php
                            if(isset($_SESSION['customer_email'])){
                               echo "Welcome ".$_SESSION['name'];
                            }
                            else{
                            echo "Welcome guest!";
                            }
                        ?>
                         <b style="color:yellow;">Shoping Cart-</b> Total Items:<?php echo getCartItem();  ?> Total Price:<?php echo getCartprice(); ?> <a href="index.php" style="color: yellow;">Go to Home</a>
                    
                    <?php
                         if(isset($_SESSION['customer_email'])){
                            echo"<a href='logout.php'>Logout</a>";
                        }
                        else{
                            echo "<a href='checkout.php'>Login</a>";
                        }
                    ?>
                    </span>
                </div>

                <div id="product_box">
                   
                    <form action="" name="insert_product" id="insert_product" method="post" enctype="multipart/form-data">
                   <table width="700" border="1px solid black">
                    <tr>
                        <th>Remove</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php
                    global $con;
                    $price=0;
                    $ip=getIp();
                    $cart_sql = "select * from cart where user_ip_address='$ip'";
                    $cart_data = mysqli_query($con, $cart_sql);
                    while($pro_row=mysqli_fetch_array($cart_data)){
                        $pro_id=$pro_row['product_id'];
                        $p_qty=$pro_row['quantity'];
                
                        $ssql = "select * from products  where product_id='$pro_id'";
                        $p_price=mysqli_query($con,$ssql);
                        while($pro_price_data=mysqli_fetch_array($p_price)){
                            $pro_id=$pro_price_data['product_id'];
                            $pro_title=$pro_price_data['product_title'];
                            $pro_image=$pro_price_data['product_image'];
                            $single_price= $pro_price_data['product_price'];
                            $price+= $pro_price_data['product_price'];
                            
                            echo "
                            <tr>
                            <td><input type='checkbox' name='remove[]' value='$pro_id'></td>
                            <td>$pro_title <br><img src='admin_area/product_image/$pro_image' height='60'></td>
                            <td><input type='text' size='4' name='qty' value='$p_qty' data='$pro_id'></td>
                            <td>$single_price</td>
                            </tr>";
                        }
                        
                        
                    }
                    echo "
                            <tr>
                            <td colspan='7' style='text-align: right;'>Total Price = $price</td>
                            </tr>";

                    echo "
                            <tr>
                            <td><input type='submit' name='update_cart' value='Update cart'></td>
                            <td><input type='submit' name='continue_shopping' value='Continue shopping'></td>
                            <td><button><a href='checkout.php?price=$price' style='text-decoration: none;'>Checkout</a></button></td>
                            
                            </tr>";
                    
                    
                    echo"
                   </table>
                   </form>
                   ";
                        

                    if(isset($_POST['update_cart'])){
                        $delete=null;
                        if($_POST['remove']==null){
                            }
                        else{
                            foreach($_POST['remove'] as $remove_id){
                            $delete_sql="delete from cart where product_id='$remove_id' and user_ip_address='$ip'";
                            $delete=mysqli_query($con,$delete_sql);
                            }
                            if($delete){
                                echo "
                                <script>
                                window.open('cart.php','_self');
                                </script>
                                ";
                            }
                        }
                    }
                    if(isset($_POST['continue_shopping'])){
                       
                        echo "
                        <script>
                        window.open('index.php','_self');
                        </script>
                        ";
                    
                    }
                    if(isset($_POST['update_cart'])){
                        echo "Zihan";
                       $qty=$_POST['qty'];
                       $p_id=$_POST['data'];
                        $update_sql="update cart set quantity='$qty' where product_id='$p_id'"; 
                        $update=mysqli_query($con,$update_sql);
                        $_SESSION['qtyi']=$qty;



                        echo "
                        <script>
                        window.open('cart.php','_self');
                        </script>
                        ";
                    
                    }

                    ?>            
                </div>

            </div>
        
        </div>
        <!--Content  wrapper ends here-->
        
        <!--Footer  section starts here-->
        <div class="footer_wrapper">
            <h1 style="text-align: center;"line-height:50px">&copy All Right Reserved || GogoGiant</h1>
        </div>
        <!--Footer  section ends here-->
        
    </div>
    <!--Main  Container starts here-->


    
</body>
</html>