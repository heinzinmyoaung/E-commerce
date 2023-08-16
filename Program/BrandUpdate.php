<?php  
include('connect.php');

if(isset($_REQUEST['BrandID'])) 
{
	$BrandID=$_REQUEST['BrandID'];
}
else
{
	$BrandID="";
}

$query="SELECT * FROM brand WHERE BrandID='$BrandID'";
$ret=mysqli_query($conn,$query);
$arr=mysqli_fetch_array($ret);

$BrandName=$arr['BrandName'];



if(isset($_POST['btnUpdate'])) 
{
	$txtBrandID=$_POST['txtBrandID'];
	$txtbrandname=$_POST['txtbrandname'];


	$update="UPDATE brand
			 SET BrandName='$txtbrandname'
			
			 WHERE BrandID='$txtBrandID'";
	$ret=mysqli_query($conn,$update);

	if($ret) 
	{
		echo "<script>window.alert('Brand Successfully Updated.')</script>";
		echo "<script>window.location='BrandRegister.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Brand_Update : " . mysqli_error($conn) . "</p>";
	}
}
?>
<html>
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

<div class="container col-10 col-sm-6 col-lg-4">
    <div class="border rounded mt-5 bg-light">
        <div class="text-center">
            <h2 class="text-capitalize my-5 text-lg">Brand Update</h2>
        </div>
        <form action="BrandUpdate.php" method="POST" class="mx-3">

            <!-- -----error Message condition---- -->
            
            <!-- -------- -->
            <!-- <div id="myDiv"><p>heelo</p></div> -->
            <input type="hidden" name="txtBrandID" value="<?php echo $BrandID ?>"/>
            <div class="row mb-3">
            <label for="inputName3" class="col-lg-4 col-form-label">Brand Name</label>
            <div class="col-lg-8 ">
                <input type="text" name="txtbrandname" class="form-control" value="<?php echo $BrandName ?>" id="inputName3" autocomplete="off" required>
            </div>
            </div>
        
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-end mb-4">
                <button type="submit" name="btnUpdate" class="btn btn-primary me-md-2">Update</button>
                <a href="BrandRegister.php" class="btn btn-primary">Cancel</a>
          </div>
        </form>

    </div>  
</div>
</body>
</html>