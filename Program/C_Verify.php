<?php  

session_start();  
include('header_login.php');
include('connect.php');

$email = $_SESSION['Email'];
$opt = $_SESSION['otp'];


$error_msg = $_SESSION['error_msg'] ;

if(isset($_POST['btncontinue'])) 
{
	$txtcode=$_POST['txtcode'];

    if($opt == $txtcode) {

        echo "<script>window.alert('Success')</script>";
        echo "<script>window.location='C_PasswordUpdate.php'</script>";
    }
    else{
        echo "<script>window.alert('Failed')</script>";
        echo "<script>window.location='C_ForgetPass.php'</script>";
    }
}
if(isset($_POST['btnresend'])) {
    echo "<script>window.alert('Code Resent')</script>";
        echo "<script>window.location='C_CodeSend.php'</script>";
        
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
    <div class="container col-8 col-lg-4">
        <div class="border rounded mt-5 bg-light">
        <div class="text-start" style="border-bottom: 1px solid #ccc">
            <h2 class="text-capitalize m-3 fs-5 fw-bold text-lg">Verification required</h2>
        </div>

      
        <div class="text-start m-3 text-break">
            <p class="fs-6 lh-sm">   <?php if ($error_msg=="Code Sent"){ ?>
                    <p class="error" style="color: red;"><?php echo $error_msg;?></p> 
                <?php }else{ ?>

                <?php } ?>Please check your emails for a message with your code. Your code is 6 numbers long.<p>
        </div>

        <form action="C_Verify.php" method="POST" class="mx-3">
            
            <!-- <label for="inputEmail3" class="col-lg-3 col-form-label">Email</label> -->
        <div class="row">
            <div class=" mb-3 col-sm-6 ">
                <input type="text" maxlength="6" name="txtcode"  style ="height: 50px; font-size: 12px;" class="form-control " placeholder="code" autocomplete="off" >
            </div>
            <div class=" text-start col-sm-6 ">
                <p class=" lh-lg text-break" style="font-size: 10px;">We sent your code to:</br> <?php echo $email ?>.</p>
            </div>
         </div>

            <div class="text-center mb-3">
            <button type="submit" name="btncontinue" class="btn btn-primary btn-md hide-btn">Continue</button>
            </div>
            <div class="text-center mb-3">
            <button type="submit" name="btnresend" class="btn btn-link text-secondary text-decoration-underline btn-sm ">Resend</button>
            <!-- <a href="CodeSend.php" name="btnresend" class=" text-secondary">Resent</a> -->
            </div>
        </form>
        </div>
    </div>

</body>
</html>
<?php  
include('footer_login.php');
?>