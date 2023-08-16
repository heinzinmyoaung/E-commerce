
<?php  

session_start();  
include('connect.php');

if (isset($_POST['btnregister']))
{
	$SupplierName=$_POST['txtname'];
	$NRC=$_POST['txtnrc'];
	$Email=$_POST['txtemail'];
    $Phone=$_POST['txtphone'];
    $Address =$_POST['txtaddress'];


	$insert ="Insert into supplier(SupplierName,NRC,Email,Phone,Address)
		   values('$SupplierName','$NRC','$Email','$Phone','$Address')";


			$run= mysqli_query($conn,$insert);

if($run)
{
	echo "<script>window.alert('Supplier Registeration is successfully Inserted')</script> ";
	echo "<script>window.location ='SupplierRegister.php'</script>";

}
else 
{
	echo mysqli_error($conn);
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
            <h2 class="text-capitalize my-5 text-lg">Supplier Register</h2>
        </div>
        <form action="SupplierRegister.php" method="POST" class="mx-3">
    
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
                <input type="text" name="txtphone" class="form-control" placeholder="Phone Number" id="inputphonenumber3" autocomplete="off" required>
            </div>
            </div>

     
            <div class="row mb-3">
            <label for="inputPassword3" class="col-lg-3 col-form-label">NRC No</label>
            <div class="col-lg-9">
                <input type="text" name="txtnrc" class="form-control" placeholder="Enter Nrc" id="inputPassword3" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputPassword3" class="col-lg-3 col-form-label">Address</label>
            <div class="col-lg-9">
            <textarea class="form-control" name="txtaddress" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
            </div>

            <div class="text-center mb-3">
            <button type="submit" name="btnregister" class="btn btn-primary btn-lg hide-btn">Register</button>
            </div>
        </form>

        </div>
    </div>

</body>
</html>