<br>
<div style="border: 1px solid black; background-color: lightgoldenrodyellow;">
<h1>Do you realy want to delete your account ?</h1>
<form action="" method="POST" >
    <button style="font-size: 22px; color:white; background-color: red; margin-right: 10px;" type="submit" name="yes"><b >Yes</b></button>
    <button style="font-size: 22px; color:white; background-color: green" type="submit" name="no"><b >No</b></button>
</form>
<br>
</div>

<?php
include('../includes/db.php');
$email=$_SESSION['customer_email'];
if(isset($_POST['yes'])){
    $delete_sql="delete from customers where customer_email='$email'";
    $delete_query=mysqli_query($con,$delete_sql);
    echo "<script>window.open('../logout.php','_self')</script>";
}
else if(isset($_POST['no'])){
    echo "<script>window.open('my_account.php','_self')</script>";
}

?>