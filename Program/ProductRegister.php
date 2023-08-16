<?php  
include('connect.php');
include('S_Header.php');
if(isset($_POST['btnregister'])) 
{
	$txtproductname=$_POST['txtproductname'];
	$cboCategoryID=$_POST['cboCategoryID'];
	$cbobrandID=$_POST['cbobrandID'];
	$txtprice=$_POST['txtprice'];
	$txtquantity=$_POST['txtquantity'];
	$txtcolor=$_POST['txtcolor'];
	//Image Upload--------------------------------
	$Image1=$_FILES['Image1']['name'];
	$Folder="./ProductImage/";

	$filename=$Folder . '_' . $Image1;
	$copied=copy($_FILES['Image1']['tmp_name'], $filename);

	if(!$copied) 
	{
        echo "<script>window.alert('Cannot Upload Image.')</script>";
		exit();
	}
	//Image Upload--------------------------------
	$txtdescription=$_POST['txtdescription'];
	// $Status="Active";

	
	
	$insert="INSERT INTO product
			 (ProductName, CategoryID, BrandID, Price, Quantity, Color, FrontImage, Description)
			 VALUES 
			 ('$txtproductname','$cboCategoryID', '$cbobrandID', '$txtprice','$txtquantity','$txtcolor', '$filename', '$txtdescription')";
	$ret=mysqli_query($conn,$insert);

	if($ret) 
	{
		echo "<script>window.alert('Product Successfully Created.')</script>";
		echo "<script>window.location='ProductRegister.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in ProductRegister : " . mysqli_error($conn) . "</p>";
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
 

</head>
<body>
<script>
    
</script>
    <div class="container col-10 col-sm-6 col-xxl-4">
        <div class="border rounded mt-5 bg-light">
        <div class="text-center">
            <h2 class="text-capitalize my-5 text-lg">Product Register</h2>
        </div>
        <form action="ProductRegister.php" method="POST" enctype="multipart/form-data" class="mx-3">

            <div class="row mb-3">
            <label for="inputName3" class="col-lg-4 col-form-label">Product Name</label>
            <div class="col-lg-8">
                <input type="text" name="txtproductname" class="form-control" placeholder="Name" id="inputName3" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputrole3" class="col-lg-4 col-form-label">CategoryID</label>
            <div class="col-lg-8">
                <select class="form-control" name="cboCategoryID" id="inputrole3" required>
                    <option value="">Select Category Name</option>
                    <?php  
                        $query="SELECT * FROM category ";
                        $ret=mysqli_query($conn,$query);
                        $count=mysqli_num_rows($ret);

                        for($i=0;$i<$count;$i++) 
                        { 
                            $arr=mysqli_fetch_array($ret);
                            $CategoryID=$arr['CategoryID'];
                            $CategoryName=$arr['CategoryName'];
                            echo "<option value='$CategoryID'>" . $CategoryID . ' ~ ' . $CategoryName . "</option>";
                        }

                    ?>
                </select>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputrole3" class="col-lg-4 col-form-label">BrandID</label>
            <div class="col-lg-8">
                <select class="form-control" name="cbobrandID" id="inputrole3" required>
                    <option value="">Select Brand Name</option>
                    <?php  
                        $query="SELECT * FROM brand ";
                        $ret=mysqli_query($conn,$query);
                        $count=mysqli_num_rows($ret);

                        for($i=0;$i<$count;$i++) 
                        { 
                            $arr=mysqli_fetch_array($ret);
                            $BrandID=$arr['BrandID'];
                            $BrandName=$arr['BrandName'];
                            echo "<option value='$BrandID'>" . $BrandID . ' ~ ' . $BrandName . "</option>";
                        }

                    ?>
                </select>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputPassword3" class="col-lg-4 col-form-label">Price</label>
            <div class="col-lg-8">
                <input type="number" name="txtprice" class="form-control" placeholder="0 MMK" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputPassword3" class="col-lg-4 col-form-label">Quantity</label>
            <div class="col-lg-8">
                <input type="number" name="txtquantity" class="form-control" placeholder="0 Pcs" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="inputPassword3" class="col-lg-4 col-form-label">Color</label>
            <div class="col-lg-8">
                <input type="text" name="txtcolor" class="form-control" placeholder="Color" autocomplete="off" required>
            </div>
            </div>

            <div class="row mb-3">
            <label for="formFile" class="col-lg-4 col-form-label">Product Image</label>
            <div class="col-lg-8">
                <input class="form-control" type="file" id="formFile" name="Image1" required>
            </div>
            </div>

            <div class="row mb-4">
            <label for="formFile" class="col-lg-4 col-form-label">Description</label>
            <div class="col-lg-8">
                <textarea class="form-control" name="txtdescription" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
            </div>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-end mb-4">
                <button type="submit" name="btnregister" class="btn btn-primary btn-md hide-btn me-md-2">Register</button>
                <button type="reset"  class="btn btn-primary btn-md hide-btn">Clear</button>
            </div>

        </form>

        </div>
    </div>

</body>
</html>
<?php  
include('footer_login.php');
?>