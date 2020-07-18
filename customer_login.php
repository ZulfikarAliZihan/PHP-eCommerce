<?php
include('includes/db.php');
//include('function/functions.php');
?>

<div>

<form action="" method="post">

<table width="500" align="center" bgcolor="skyblue">
    <tr align="center">
        <td colapan="3"><h2>Login or Register to Bye</h2></td>
    </tr>
    <tr align="center">
        <td><b>Email</b></td>
        <td><input type="text" name="email" placeholder="Enter email"></td>
    </tr>
    <tr align="center">
        <td>Passward</td>
        <td><input type="password" name="pass" placeholder="Enter password"></td>
    </tr>
        <tr>
            <td colspan="3"><a href="checkout.php?forgot_pass">Forgot password</a></td>
        </tr>

    <tr align="right">
        <td><input type="submit" name="login" value="Login"></td>
    </tr>
</table>
   <h1 style="float: right; text-decoration: none;"><a href="customer_register.php">Register Now</a></h1>
</form>

</div>

<?php

if(isset($_POST['login'])){

$c_email=$_POST['email'];
$c_pass=$_POST['pass'];

$login_sql="select * from customers where customer_email='$c_email' and customer_pass='$c_pass'";
$login=mysqli_query($con,$login_sql);
$check_login=mysqli_num_rows($login);
if($check_login>0){
    $_SESSION['customer_email']=$c_email;
    
    while($data=mysqli_fetch_array($login)){
        $_SESSION['name']=$data['customer_name'];
    }

    echo "
    <script>
    window.open('index.php','_self');
    </script>
    ";
}
else{
    echo "
    <script>
    alert('Wrong email and/or password');
    </script>
    ";
}

}

?>

