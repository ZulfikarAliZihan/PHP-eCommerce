<?php
$email=$_SESSION['customer_email'];
$select_sql="select * from customers where customer_email='$email'";
$data_fetch=mysqli_query($con,$select_sql);
while($data=mysqli_fetch_array($data_fetch)){
    $s_name=$data['customer_name'];
    $s_email=$data['customer_email'];
    $s_pass=$data['customer_pass'];
    
    $s_country=$data['customer_country'];
    $s_city=$data['customer_city'];
    $s_contact=$data['customer_contact'];
    $s_address=$data['customer_address'];
}
?>


            
            

            <div id="content_area">

               

                <form action="" method="post" enctype="multipart/form-data">
                    <table align="center" width="750">
                        <tr >
                            <td align="center" colspan="3"><h2>Edit account</h2></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Name</td>
                            <td><input type="text" name="c_name" value=<?php echo $s_name?>></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Email</td>
                            <td><input type="text" name="c_email" value=<?php echo $s_email?> disabled></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Password</td>
                            <td><input type="password" name="c_pass" value=<?php echo $s_pass?> ></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Image</td>
                            <td><input type="file" name="c_image" disabled></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Country</td>
                            <td><select name="c_country" value=<?php echo $s_country?> >
                                <option>Bangladesh</option>
                                <option>India</option>
                                <option>Srilanka</option>
                                <option>Nepal</option>
                                <option>Pakistan</option>
                            </select></td>
                        </tr>

                        <tr>
                            <td align="right">Customer City</td>
                            <td><input type="text" name="c_city" value=<?php echo $s_city?> size="8"></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Contact</td>
                            <td><input type="text" name="c_contact" value=<?php echo $s_contact?> ></td>
                        </tr>

                        <tr>
                            <td align="right">Customer Address</td>
                            <td><input type="text" name="c_address"  value=<?php echo $s_address?> ></td>
                        </tr>

                        <tr>
                            
                            <td align="center" colspan="3"><input type="submit" value="Update Account" name="update"></td>
                        </tr>

                    </table>
            
                </form>

            </div>
        
        </div>
        <!--Content  wrapper ends here-->
     

<?php


if(isset($_POST['update'])){
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

    $id_sql="select * from customers where customer_email='$email'";
    $id_qyery=mysqli_query($con,$id_sql);
    while($id_data=mysqli_fetch_array($id_qyery)){
        $id=$id_data['customer_id'];
    }
    echo $id;
    $incert_c="update customers set customer_ip='$ip',customer_name='$c_name' ,customer_pass='$c_pass',customer_country='$c_country',customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address' where customer_id='$id'";
    $run_c=mysqli_query($con,$incert_c);
    if($run_c){
    echo "<script>window.open('my_account.php','_self')</script>";
    }

}

?>