<?php
include("function/functions.php");

session_start();
if(!isset($_SESSION['customer_email'])){
    include('customer_login.php');
}
else{
/* PHP */
$post_data = array();
$post_data['store_id'] = "perso5f12a94f5d2d0";
$post_data['store_passwd'] = "perso5f12a94f5d2d0@ssl";
$post_data['total_amount'] = $_GET['price'];
$post_data['currency'] = "BDT";
$post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
$post_data['success_url'] = "http://www.e-shop.com/ecom/payment.php";
$post_data['fail_url'] = "http://localhost/new_sslcz_gw/fail.php";
$post_data['cancel_url'] = "http://localhost/new_sslcz_gw/cancel.php";
# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

# EMI INFO
$post_data['emi_option'] = "1";
$post_data['emi_max_inst_option'] = "9";
$post_data['emi_selected_inst'] = "9";

# CUSTOMER INFORMATION
$post_data['cus_name'] = $_SESSION['name'];
$post_data['cus_email'] = $_SESSION['customer_email'];
$post_data['cus_add1'] = "Dhaka";
$post_data['cus_add2'] = "Dhaka";
$post_data['cus_city'] = "Dhaka";
$post_data['cus_state'] = "Dhaka";
$post_data['cus_postcode'] = "1000";
$post_data['cus_country'] = "Bangladesh";
$post_data['cus_phone'] = "01711111111";
$post_data['cus_fax'] = "01711111111";

# SHIPMENT INFORMATION
$post_data['ship_name'] = "testpersogecy";
$post_data['ship_add1 '] = "Dhaka";
$post_data['ship_add2'] = "Dhaka";
$post_data['ship_city'] = "Dhaka";
$post_data['ship_state'] = "Dhaka";
$post_data['ship_postcode'] = "1000";
$post_data['ship_country'] = "Bangladesh";

# OPTIONAL PARAMETERS
$post_data['value_a'] = "ref001";
$post_data['value_b '] = "ref002";
$post_data['value_c'] = "ref003";
$post_data['value_d'] = "ref004";

# CART PARAMETERS
$post_data['cart'] = json_encode(array(
    array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
    array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
    array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
    array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
));
$post_data['product_amount'] = "100";
$post_data['vat'] = "5";
$post_data['discount_amount'] = "5";
$post_data['convenience_fee'] = "3";


# REQUEST SEND TO SSLCOMMERZ
$direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $direct_api_url );
curl_setopt($handle, CURLOPT_TIMEOUT, 30);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($handle, CURLOPT_POST, 1 );
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


$content = curl_exec($handle );

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle))) {
	curl_close( $handle);
	$sslcommerzResponse = $content;
} else {
	curl_close( $handle);
	echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
	exit;
}

# PARSE THE JSON RESPONSE
$sslcz = json_decode($sslcommerzResponse, true );

if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
	echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
	# header("Location: ". $sslcz['GatewayPageURL']);
	exit;
} else {
	echo "JSON Data parsing error!";
}
}


/*

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
                    </span>
                </div>

                <div id="product_box">
                    <?php

                    if(!isset($_SESSION['customer_email'])){
                        include('customer_login.php');
                    }
                    else{
                        echo "
                        
                    //    <script>
                    //    window.open('payment.php','_self');
                    //    </script> 
                       ";
                        echo $_GET['price'];
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


*/