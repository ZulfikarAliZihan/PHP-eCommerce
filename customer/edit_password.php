


<form action="" method="post">
    <table align="right" width="650" style="padding: 30px; border:1.1px solid black; background-color:wheat;border-radius:10px;">
    <h2>Change Password</h2>
    
        <tr>
            <td>
                <b>Enter your old password</b>
            </td>
            <td>
                <input type="password" name="old_pass" >
            </td>
        </tr>
        <tr>
            <td>
                <b>Enter your new password</b>
            </td>
            <td>
                <input type="password" name="new_pass" required>
            </td>
        </tr>
        <tr>
            <td>
                <b>Re-enter your new password</b>
            </td>
            <td>
                <input type="text" name="new_pass_again">
            </td>
        </tr>
        <tr>
            <td align="right">
            <input type="submit" value="Update Account" name="change_p">
            </td>
        </tr>
    </table>
</form>

<?php
include('../includes/db.php');
if (isset($_POST['change_p'])) {
    $old_pass=$_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $new_pass_again = $_POST['new_pass_again'];
    //echo $new_pass_again."  ".$new_pass;
    $email=$_SESSION['customer_email'];
    
    if ($new_pass == $new_pass_again) {
        $pass_sql="update customers set customer_pass='$new_pass' where customer_email='$email' and customer_pass='$old_pass'";
        $pass_query=mysqli_query($con,$pass_sql);

        if($pass_query){
            echo "<script>alert('Your password changes successfully')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
        }
        else{
            echo "<script>alert('Your old password doesn't match')</script>";
        }
    }
     else {
        echo "<script>alert('Your new password dont match')</script>";
    }
}

?>