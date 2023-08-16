<?php  
session_start();  
include('header_login.php');

include('connect.php');
$error_msg ="";
$error_password="";
if(isset($_POST['btnlogin'])) 
{
	$txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];

	$checkUser="SELECT * FROM customer 
				WHERE Email='$txtemail'";
	$ret=mysqli_query($conn,$checkUser);
	$count=mysqli_num_rows($ret);
    if($count == 1){
        $arr=mysqli_fetch_array($ret);
        if (password_verify($txtpassword,  $arr['Password'])) {
            $_SESSION['CustomerID']=$arr['CustomerID'];
            $_SESSION['CustomerName']=$arr['CustomerName'];
         
            
            echo "<script>window.alert('Success : Welcome Back')</script>";
            echo "<script>window.location='ProductDisplay.php'</script>";
        }
        else {
            // echo "<script>window.alert('You no as Staff')</script>";
            $error_password = "Incorrect password.";
        }
    }
else {
        $error_msg = "Incorrect email.";
        // echo "<script>window.alert('You sdss Staff')</script>";
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
            <h2 class="text-capitalize my-5 text-lg">Customer Login</h2>
        </div>
        <form action="CustomerLogin.php" method="POST" class="mx-3">

            <!-- -----error Message condition---- -->
                <?php if($error_msg=="" && $error_password==""){ ?>
                    <p style="display: none"></p>
                <?php }elseif ($error_msg=="Incorrect email."){ ?>
                    <p class="error"><?php echo $error_msg;?></p> 
                <?php }elseif ($error_password=="Incorrect password."){ ?>
                <p class="error"><?php echo $error_password;?></p> 
                <?php }else{ ?>

                <?php } ?>
            <!-- -------- -->
            <!-- <div id="myDiv"><p>heelo</p></div> -->
            <div class="row mb-3">
            <label for="inputEmail3" class="col-lg-3 col-form-label">Email</label>
            <div class="col-lg-9">
                <input type="email" name="txtemail" class="form-control" placeholder="Enter Your Email Address" id="inputEmail3" autocomplete="off" required>
            </div>
            </div>
            <div class="row mb-5">
            <label for="inputPassword3" class="col-lg-3 col-form-label">Password</label>
            <div class="col-lg-9">
                <input type="password" name="txtpassword" class="form-control" placeholder="Enter Password" id="inputPassword3" autocomplete="off" required>
            </div>
            </div>
            <div class="text-center mb-3">
            <button type="submit" name="btnlogin" class="btn btn-primary btn-lg hide-btn">Login</button>
            </div>
        </form>
        <center class="mb-3">
                <a class="text-black-50" href="C_ForgetPass.php" style="text-align:center; text-decoration: underline; ">Forgotten Password?</a>
        </center>
        <center class="mb-3">
                <a class="text-black-50" href="CustomerRegister.php" style="text-align:center; text-decoration: underline; ">Create New Account</a>
        </center>
        </div>
      
    </div>

</body>
</html>

<?php  
include('footer_login.php');
?>