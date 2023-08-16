<?php  

session_start();  
include('header_login.php');
include('connect.php');


if(isset($_POST['btncontinue'])) 
{
    $txtnewpassword=$_POST['txtnewpassword'];
	$txtcomfirmpassword=$_POST['txtcomfirmpassword'];

    if($txtnewpassword==$txtcomfirmpassword)
    {
        $CustomerID=$_SESSION['CustomerID']; 
        $finalpassword=$txtnewpassword;

        $pwd_hashed = password_hash($finalpassword, PASSWORD_DEFAULT);

        $update="UPDATE customer 
                SET Password='$pwd_hashed'
                WHERE CustomerID='$CustomerID'";

        $ret=mysqli_query($conn,$update);
        // $count=mysqli_num_rows($ret);
        // $row = mysqli_fetch_array($ret);


        if($ret) 
        {
            echo "<script>window.alert('Password Successfully Updated.')</script>";
            echo "<script>window.location='CustomerLogin.php'</script>";
        }
        else
        {
            echo "<p>Something went wrong in PasswordUpdate : " . mysqli_error($conn) . "</p>";
       }

    }else{
        echo "<script>window.alert('Password does not match.')</script>";
            // echo "<script>window.location='#.php'</script>";
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
    <div class="container col-8 col-lg-4">
        <div class="border rounded mt-5 bg-light">
        <div class="text-start" style="border-bottom: 1px solid #ccc">
            <h2 class="text-capitalize m-3 text-lg">Create a new password</h2>
        </div>

        <div class="text-start m-3">
            <span class=""> Create a new password</span>
        </div>

        <form action="C_PasswordUpdate.php" method="POST" class="mx-3">

            <!-- -----error Message condition---- -->
            <!-- -------- -->
            <!-- <div id="myDiv"><p>heelo</p></div> -->
            
            <!-- <label for="inputEmail3" class="col-lg-3 col-form-label">Email</label> -->
            <div class=" mb-4">
                <input type="text" name="txtnewpassword" class="form-control " placeholder="New Password" id="inputEmail3" autocomplete="off" required>
            </div>

            <div class=" mb-4">
                <input type="text" name="txtcomfirmpassword" class="form-control" placeholder="Comfirm Password" id="inputEmail3" autocomplete="off" required>
            </div>
           
            <div class="text-center mb-3">
            <button type="submit" name="btncontinue" class="btn btn-primary btn-lg hide-btn">Continue</button>
            </div>
        </form>
        </div>
    </div>

</body>
</html>
<?php  
include('footer_login.php');
?>