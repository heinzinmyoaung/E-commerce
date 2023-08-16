<?php  

session_start();
include('header_login.php');  
include('connect.php');

$error_msg ="";
$error_password="";
if(isset($_POST['btnlogin'])) 
{
	$txtemail=$_POST['txtemail'];

	$checkUser="SELECT * FROM customer 
				WHERE Email='$txtemail'";
	$ret=mysqli_query($conn,$checkUser);
	$count=mysqli_num_rows($ret);
    $row = mysqli_fetch_array($ret);


    if($count == 1){
        $_SESSION['CustomerName'] = $row['CustomerName'];
        $_SESSION['CustomerID'] = $row['CustomerID'];
        $_SESSION['Email'] = $row['Email'];
        header("location: C_CodeSend.php");
    }else {
        $error_msg = "Incorrect email.";
    }
}
if(isset($_POST['btncalcel'])) {
    header("location: CustomerLogin.php");
}

?>
<script>
function relocate_home()
{
     location.href = "CustomerLogin.php";
} 
</script>

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
    <div class="container col-8 col-lg-4">
        <div class="border rounded mt-5 bg-light">
        <div class="text-start" style="border-bottom: 1px solid #ccc">
            <h2 class="text-capitalize m-3 text-lg">Password assistance</h2>
        </div>

        <div class="text-start m-3">
            <span class=""> Please enter your email address to recovery for your account.</span>
        </div>

        <form action="C_ForgetPass.php" method="POST" class="mx-3">

            <!-- -----error Message condition---- -->
                <?php if($error_msg=="" && $error_password==""){ ?>
                    <p style="display: none"></p>
                <?php }elseif ($error_msg=="Incorrect email."){ ?>
                    <p class="error"><?php echo $error_msg;?></p> 
                <?php }elseif ($error_password=="OTP SEND."){ ?>
                <p class="error"><?php echo $error_password;?></p> 
                <?php }else{ ?>

                <?php } ?>
            <!-- -------- -->
            <!-- <div id="myDiv"><p>heelo</p></div> -->
            
            <!-- <label for="inputEmail3" class="col-lg-3 col-form-label">Email</label> -->
            <div class=" mb-3">
                <input type="email" name="txtemail" style ="height: 50px; font-size: 12px;" class="form-control" placeholder="Enter Your Email Address" id="inputEmail3" autocomplete="off" required>
            </div>
            
            <div class="row ">
                <div class=" bg-light mb-3">
                <button type="submit" name="btnlogin" class=" col-12 btn btn-primary btn-md hide-btn mb-2 ">Continue</button>
              
                <input type="button" class="col-12 btn btn-secondary btn-md hide-btn mb-2" value="Cancel" onclick=" relocate_home()">
                </div>
                
            </div>
        </form>
        </div>
    </div>

</body>
</html>
<?php  
include('footer_login.php');
?>