
<?php  

session_start();  
include('S_Header_Login.php');
include('connect.php');
$error_msg ="";
$error_phone ="";
if(isset($_POST['btnregister'])) 
{
	$staffname=$_POST['txtname'];
	$email=$_POST['txtemail'];
	$pass=$_POST['txtpassword'];

    $pwd_hashed = password_hash($pass, PASSWORD_DEFAULT);

	$phone=$_POST['txtphonenumber'];
	$role=$_POST['cborole'];

    $select="SELECT Email from staff where Email='$email'";
	$ret=mysqli_query($conn,$select);
	$count=mysqli_num_rows($ret);

	if($count>0) {   
        $error_msg = "Email already exit.";
	}
    elseif (is_numeric($phone) == 1){
        $insert="INSERT into staff(StaffName,Email,Password,PhoneNumber,Role)
			 	 values('$staffname','$email','$pwd_hashed','$phone','$role')";

        $ret=mysqli_query($conn,$insert);

        if ($ret) 
		{
			
			echo "<script> alert('Register Successfully') </script>";
			echo "<script>window.location='ProductPurchaseDisplay.php'</script>";

		}
		else
		{
			echo "<p>Something went wrong.".mysqli_error($conn)."</p>";
		}
    }
	else
	{
        $error_phone = "Please enter valid mobile number.";
	
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
 
    <style>
        .error {
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<script>
    
</script>
    <div class="container col-10 col-sm-6 col-lg-4">
        <div class="border rounded mt-5 bg-light">
        <div class="text-center">
            <h2 class="text-capitalize my-5 text-lg">Staff Register</h2>
        </div>
        <form action="StaffRegister.php" method="POST" class="mx-3">
             <!-- -----error Message condition---- -->
             <?php if($error_msg=="" && $error_phone==""){ ?>
                    <p style="display: none"></p>
                <?php }else if ($error_msg=="Email already exit."){ ?>
                    <p class="error"><?php echo $error_msg;?></p> 
                <?php }else if ($error_phone== "Please enter valid mobile number."){ ?>
                <p class="error"><?php echo $error_phone;?></p> 
                <?php }else{ ?>

                <?php } ?>
            <!-- -------- -->
            <div class="row mb-3">
            <label for="inputName3" class="col-lg-3 col-form-label">Name</label>
            <div class="col-lg-9">
                <input type="text" name="txtname" class="form-control" placeholder="Name" id="inputName3" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputEmail3" class="col-lg-3 col-form-label">Email</label>
            <div class="col-lg-9">
                <input type="email" name="txtemail" class="form-control" placeholder="Email Address" id="inputEmail3" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputphonenumber3" class="col-lg-3 col-form-label">Phone</label>
            <div class="col-lg-9">
                <input type="text" name="txtphonenumber" class="form-control" placeholder="Phone Number" id="inputphonenumber3" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputPassword3" class="col-lg-3 col-form-label">Password</label>
            <div class="col-lg-9">
                <input type="password" name="txtpassword" class="form-control" placeholder="Password" id="inputPassword3" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-5">
            <label for="inputrole3" class="col-lg-3 col-form-label">Role</label>
            <div class="col-lg-9">
                <select class="form-control" name="cborole" id="inputrole3" required>
                    <option value="">Select Staff Role</option>
                    <option value="Manager">Admin</option>
                </select>
            </div>
            </div>

            <div class="text-center mb-3">
            <button type="submit" name="btnregister" class="btn btn-primary btn-lg hide-btn">Register</button>
            </div>
        </form>
        <center class="mb-3">
                <a class="text-black-50" href="StaffLogin.php" style="text-align:center; text-decoration: underline; ">Already have an account?</a>
        </center>

        </div>
    </div>

</body>
</html>
<?php  
include('footer_login.php');
?>