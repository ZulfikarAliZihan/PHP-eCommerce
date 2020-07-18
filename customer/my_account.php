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

    <link rel="stylesheet" href="styles/cus-style.css" media="all"/>
</head>
<body>
    <!--Main  Container starts here-->
    <div class="main_wrapper">

        <!--Header  wrapper starts here-->
        <div class="header_wrapper">
            <img src="../images/logo.png" alt="Site-logo" id="logo">
            <img src="../images/banner.gif" alt="Site-Banner" id="banner">
            
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

                         
                    <?php

                        if(isset($_SESSION['customer_email'])){
                            echo "<button><a href='../logout.php' style='color:orange;'>Logout</a></button>";
                            }
                         else{
                            echo "<a href='../checkout.php'>Login</a>";
                             }
                    ?>
                    
                    </span>
                </div>

                <div id="product_box">

                    <?php 
                    if(!isset($_GET['edit_account'])){
                        if(!isset($_GET['my_order'])){
                            if(!isset($_GET['edit_pass'])){
                                if(!isset($_GET['delete_account'])){
                                    if(isset($_SESSION['name'])){
                                        $name=$_SESSION['name'];
                                        echo "<h1 style='color:antiquewhite;margin-top:60px;'> Welcome $name</h1>";      
                                    }
                                }
                            }
                        }
                    }
                   
                    if(isset($_GET['edit_account'])){
                        include('edit_account.php');
                    }
                    if(isset($_GET['edit_pass'])){
                        include('edit_password.php');
                    }
                    if(isset($_GET['delete_account'])){
                        include('delete_account.php');
                    }
                    
                    ?>

                    
                </div>

            </div>


            
            <div id="side_bar">

               <div id="side_bar_type">My Account</div>
                <ul id="cats">
                    <?php
                    if(isset($_SESSION['customer_email'])){
                    $c_email=$_SESSION['customer_email'];
                    $image_sql="select * from customers where customer_email='$c_email'";
                    $image_data=mysqli_query($con,$image_sql);
                    $image=mysqli_fetch_array($image_data);
                    $image_path=$image['customer_image'];
                    echo "<img src='customer_images/$image_path'>";
                    }
                    
                   echo "
                        <li><a href='my_account.php?my_order'>My Order</a></li>
                        <li><a href='my_account.php?edit_account'>Edit Account</a></li>
                        <li><a href='my_account.php?edit_pass'>Edit password</a></li>
                        <li><a href='my_account.php?delete_account'>Delete Account</a></li>";
                        
                    ?>
                </ul>

               
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