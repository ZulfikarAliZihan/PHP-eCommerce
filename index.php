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

                         <b style="color:yellow;">Shoping Cart-</b> Total Items:<?php echo getCartItem();  ?> Total Price:<?php echo getCartprice(); ?> <a href="cart.php" style="color: yellow;">Go to Cart</a>
                    <?php

                        if(isset($_SESSION['customer_email'])){
                            echo "<button><a href='logout.php' style='color:orange;'>Logout</a></button>";
                            }
                         else{
                            echo "<a href='checkout.php'>Login</a>";
                             }
                    ?>
                    
                    </span>
                </div>

                <div id="product_box">
                    <?php
                    cart();
                        getProducts();
                        
                    ?>            
                </div>

            </div>
        
        </div>
        <!--Content  wrapper ends here-->
        
        <!--Footer  section starts here-->
        <div class="footer_wrapper">
            <h1 style="text-align: center; line-height:100px;">&copy All Right Reserved || GogoGiant</h1>
        </div>
        <!--Footer  section ends here-->
        
    </div>
    <!--Main  Container starts here-->


    
</body>
</html>