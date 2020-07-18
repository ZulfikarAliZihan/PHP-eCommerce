<?php

$con = mysqli_connect("localhost","root","","ecommerce");

function login_logout($email){
    if(isset($email)){
        echo"<a href='logout.php'>Logout</a>";
    }
    else{
        echo "<a href='checkout.php'>Login</a>";
    }
}



function getMenu(){
    echo 
    "<ul id='menu_items'>
    <li><a href='../index.php'>Home</a></li>
    <li><a href='../all_products.php?all_products=all'>All Products</a></li>
    <li><a href='my_account.php'>My Account</a></li>
    <li><a href='../customer_register.php'>Sign Up</a></li>
    <li><a href='../cart.php'>Shoping Cart</a></li>
    </ul>";
}



function getCats() 
{
    global $con;
    $sql = "select * from categories";
    $cat_data = mysqli_query($con, $sql);
    while($cat_row=mysqli_fetch_array($cat_data)){
        $cat_id=$cat_row['cat_id'];
        $cat_title=$cat_row['cat_title'];
        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
     
}
function getCats_for_insert() 
{
    global $con;
    $sql = "select * from categories";
    $cat_data = mysqli_query($con, $sql);
    while($cat_row=mysqli_fetch_array($cat_data)){
        $cat_id=$cat_row['cat_id'];
        $cat_title=$cat_row['cat_title'];
        echo "<option value='$cat_id'>$cat_title</option>";
    }
     
}

function getBrands() 
{
    global $con;
    $sql = "select * from brands";
    $brads_data = mysqli_query($con, $sql);
    while($brand_row=mysqli_fetch_array($brads_data)){
        $brand_id=$brand_row['brand_id'];
        $brand_title=$brand_row['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
     
}

function getBrands_for_insert() 
{
    global $con;
    $sql = "select * from brands";
    $brads_data = mysqli_query($con, $sql);
    while($brand_row=mysqli_fetch_array($brads_data)){
        $brand_id=$brand_row['brand_id'];
        $brand_title=$brand_row['brand_title'];
        echo "<option value='$brand_id'>$brand_title </option>";
    }
     
}

function getProducts() 
{
    global $con;
    if(isset($_GET['cat'])){
        $cat= $_GET['cat'];
    
        $sql = "select * from products where product_cat='$cat' ";
        $pro_data = mysqli_query($con, $sql);
        while($pro_row=mysqli_fetch_array($pro_data)){
            $pro_id=$pro_row['product_id'];
            $pro_title=$pro_row['product_title'];
            $pro_image=$pro_row['product_image'];
            $pro_price=$pro_row['product_price'];
            $pro_brand=$pro_row['product_brand'];
            $pro_cat=$pro_row['product_cat'];

            echo "<div id='single_product'>
            <h1>$pro_title</h1> 
            <img src='admin_area/product_image/$pro_image' width='100px' height='80px'>
            <p>$pro_price taka</p>
            <a href='product_details.php?pro_id=$pro_id' style='float:left; margin:4px;'>Details</a>
            <a href='index.php?add_cart=$pro_id' style='float:right; margin:4px;'><button>Add to cart</button></a>
            </div>";

        }
    }

    else if(isset($_GET['brand'])){
        $brand= $_GET['brand'];
    
        $sql = "select * from products where product_brand='$brand' ";
        $pro_data = mysqli_query($con, $sql);
        while($pro_row=mysqli_fetch_array($pro_data)){
            $pro_id=$pro_row['product_id'];
            $pro_title=$pro_row['product_title'];
            $pro_image=$pro_row['product_image'];
            $pro_price=$pro_row['product_price'];
            $pro_brand=$pro_row['product_brand'];
            $pro_cat=$pro_row['product_cat'];

            echo "<div id='single_product'>
            <h1>$pro_title</h1> 
            <img src='admin_area/product_image/$pro_image' width='100px' height='80px'>
            <p>$pro_price taka</p>
            <a href='product_details.php?pro_id=$pro_id' style='float:left; margin:4px;'>Details</a>
            <a href='index.php?add_cart=$pro_id' style='float:right; margin:4px;'><button>Add to cart</button></a>
            </div>";

        }
    }

    else if(isset($_GET['all_products'])){
        
            $sql = "select * from products";
            $pro_data = mysqli_query($con, $sql);
            while($pro_row=mysqli_fetch_array($pro_data)){
            $pro_id=$pro_row['product_id'];
            $pro_title=$pro_row['product_title'];
            $pro_image=$pro_row['product_image'];
            $pro_price=$pro_row['product_price'];
            $pro_brand=$pro_row['product_brand'];
            $pro_cat=$pro_row['product_cat'];

            echo "<div id='single_product'>
            <h1>$pro_title</h1> 
            <img src='admin_area/product_image/$pro_image' width='100px' height='80px'>
            <p>$pro_price taka</p>
            <a href='product_details.php?pro_id=$pro_id' style='float:left; margin:4px;'>Details</a>
            <a href='index.php?add_cart=$pro_id' style='float:right; margin:4px;'><button>Add to cart</button></a>
            </div>";

        }

    }

    else if(isset($_GET['submit'])){

            $user_query=$_GET['user_query'];
            $sql = "select * from products where product_keywords like '%$user_query%'";
            $pro_data = mysqli_query($con, $sql);
            if(mysqli_num_rows($pro_data)==0){
                echo "<h1>There is no such product .</h1>";
            }
            while($pro_row=mysqli_fetch_array($pro_data)){
            $pro_id=$pro_row['product_id'];
            $pro_title=$pro_row['product_title'];
            $pro_image=$pro_row['product_image'];
            $pro_price=$pro_row['product_price'];
            $pro_brand=$pro_row['product_brand'];
            $pro_cat=$pro_row['product_cat'];

            echo "<div id='single_product'>
            <h1>$pro_title</h1> 
            <img src='admin_area/product_image/$pro_image' width='100px' height='80px'>
            <p>$pro_price taka</p>
            <a href='product_details.php?pro_id=$pro_id' style='float:left; margin:4px;'>Details</a>
            <a href='index.php?add_cart=$pro_id' style='float:right; margin:4px;'><button>Add to cart</button></a>
            </div>";

        }

    }

    else{
            $sql = "select * from products order by rand() limit 1,8 ";
            $pro_data = mysqli_query($con, $sql);
            while($pro_row=mysqli_fetch_array($pro_data)){
            $pro_id=$pro_row['product_id'];
            $pro_title=$pro_row['product_title'];
            $pro_image=$pro_row['product_image'];
            $pro_price=$pro_row['product_price'];
            $pro_brand=$pro_row['product_brand'];
            $pro_cat=$pro_row['product_cat'];

            echo "<div id='single_product'>
            <h1>$pro_title</h1> 
            <img src='admin_area/product_image/$pro_image' width='100px' height='80px'>
            <p>$pro_price taka</p>
            <a href='product_details.php?pro_id=$pro_id' style='float:left; margin:4px;'>Details</a>
            <a href='index.php?add_cart=$pro_id' style='float:right; margin:4px;'><button>Add to cart</button></a>
            </div>";

        }

    }
}


function getProductsDetails($product_id) 
{ 
    global $con;
    $sql = "select * from products  where product_id='$product_id'";
    $pro_data = mysqli_query($con, $sql);
    while($pro_row=mysqli_fetch_array($pro_data)){
        $pro_id=$pro_row['product_id'];
        $pro_title=$pro_row['product_title'];
        $pro_image=$pro_row['product_image'];
        $pro_price=$pro_row['product_price'];
        $pro_details=$pro_row['product_desc'];
        

       echo "<div id='single_product'>
        <h1>$pro_title</h1> 
        <img src='admin_area/product_image/$pro_image' width='400px'>
        <p>$pro_price taka</p>
        <p>$pro_details</p>
        <a href='index.php?pro_id=$pro_id' style='float:left; margin:4px;'>Go Back</a>
        <a href='index.php?add_cart=$pro_id' ><button style='float:right; margin:4px;'>Add to cart</button></a>
        </div>";
      return $product_id;
    }
     
}

function getIp(){
$ip=$_SERVER['REMOTE_ADDR'];
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}
else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
return $ip;
}


function cart(){
    global $con;
    if(isset($_GET['add_cart'])){

        $pro_id=$_GET['add_cart'];
        echo $pro_id;
        $ip=getIp();
        $sql = "select * from cart  where product_id='$pro_id' AND user_ip_address='$ip'";
        $pro_data = mysqli_query($con, $sql);

        if(mysqli_num_rows($pro_data)>0){
            echo "This product is already added";
        }
        else{
            $sql="insert into cart (product_id,user_ip_address) values('$pro_id','$ip')";
            $pro_data = mysqli_query($con, $sql);
            
            if($pro_data>0){
                echo "<script>
                window.open('index.php','_self');
                </script>";
            }
        }
    }
}

function getCartItem(){
    global $con;
    $ip=getIp();
    $sql = "select * from cart  where user_ip_address='$ip'";
    $pro_data = mysqli_query($con, $sql);
    return mysqli_num_rows($pro_data);
}

function getCartprice(){
    global $con;
    $price=0;
    $ip=getIp();
    $cart_sql = "select * from cart where user_ip_address='$ip'";
    $cart_data = mysqli_query($con, $cart_sql);
    while($pro_row=mysqli_fetch_array($cart_data)){
        $pro_id=$pro_row['product_id'];

        $ssql = "select * from products  where product_id='$pro_id'";
        $p_price=mysqli_query($con,$ssql);
        while($pro_price_data=mysqli_fetch_array($p_price)){
            $price+= $pro_price_data['product_price'];

        }
        
        
    }
    return $price." Taka only ";
}




?>