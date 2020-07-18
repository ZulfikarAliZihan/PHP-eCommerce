<?php
include("function/functions.php");
include("includes/db.php");
session_start();
if(isset($_SESSION['customer_email'])){
    echo "<script>window.open('customer/my_account.php','_self')</script>";
}
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
                        Welcome guest! <b style="color:yellow;">Shoping Cart-</b> Total Items:<?php echo getCartItem();  ?> Total Price:<?php echo getCartprice(); ?> <a href="cart.php" style="color: yellow;">Go to Cart</a>
                    </span>
                </div>

                <form action="customer_register.php" method="post" enctype="multipart/form-data">
                    <table align="center" width="750">
                        <tr >
                            <td align="center" colspan="3"><h2>Create account</h2></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Name</td>
                            <td><input type="text" name="c_name"></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Email</td>
                            <td><input type="text" name="c_email" required></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Password</td>
                            <td><input type="password" name="c_pass"></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Image</td>
                            <td><input type="file" name="c_image"></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Country</td>
                            <td><select name="c_country" >
                                <option>Bangladesh</option>
                                <option>India</option>
                                <option>Srilanka</option>
                                <option>Nepal</option>
                                <option>Pakistan</option>
                            </select></td>
                        </tr>

                        <tr>
                            <td align="right">Customer City</td>
                            <td><input type="text" name="c_city" size="8"></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Contact</td>
                            <td><input type="text" name="c_contact"></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Address</td>
                            <td><textarea name="c_address" id="" cols="20" rows="5"></textarea></td>
                        </tr>

                        <tr>
                            
                            <td align="center" colspan="3"><input type="submit" value="Create Account" name="register"></td>
                        </tr>

                    </table>
            
                </form>

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

<?php

if(isset($_POST['register'])){
    global $con;
    $ip=getIp();

    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];

    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $incert_c="insert into customers(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image)
                                     values('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
    
    $run_c=mysqli_query($con,$incert_c);

    $select_cart="select * from cart where user_ip_address='$ip'";
    $run_cart=mysqli_query($con,$select_cart);
    $check_cart=mysqli_num_rows($run_cart);

    if($check_cart==0){
        $_SESSION['customer_email']=$c_email;
        $_SESSION['name']=$c_name;
        echo "<script>alert('Account has been created successfully')</script>";
        echo "<script>alert('customer/my_account.php','_self')</script>";

    }
    else{
        $_SESSION['customer_email']=$c_email;
        $_SESSION['name']=$c_name;
        echo "<script>alert('Account has been created successfully   kk')</script>";
        echo "<script>window.open('payment.php','_self')</script>";

    }

    // if($run_c){
    //     echo "
    //     <script>
    //     alert('registration successfull');
    //     </script>
    //     ";
    // }
}

?>