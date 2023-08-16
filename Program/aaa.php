<?php  
include('connect.php');

$ProductID = $_REQUEST['ProductID'];

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
		echo "<script>window.location='ProductDisplay.php'</script>";
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
<body style="background-color: #eee;">
<form action="ProductUpdate.php?ProductID=<?php echo $ProductID?>" method="POST">
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center pb-2">

        <div class="col-md-8 col-xl-4">
           
           <div class='rounded d-flex flex-column p-2' style='background-color: #f8f9fa; border: 1px solid black;'>
            <div class='p-2 me-3'>
              <h4>Product Update</h4>
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b> Name</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <input type="text" name="txtproductname" class="form-control" placeholder=" <?php echo $ProductID?>" id="inputName3" autocomplete="off" required>
                </div>
            </div>

           
            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>CategoryID</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
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
             

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>BrandID</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
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


            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>Price</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <input type="number" name="txtprice" class="form-control" placeholder="0 MMK" autocomplete="off" required>
                </div>
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>Quantity</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <input type="number" name="txtquantity" class="form-control" placeholder="0 Pcs" autocomplete="off" required>
                </div>
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>Color</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <input type="text" name="txtcolor" class="form-control" placeholder="Color" autocomplete="off" required>
                </div>
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>Image</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <input class="form-control" type="file" id="formFile" name="Image1" required>          
             </div>
            </div>



        
          <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>Description</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <textarea class="form-control" name="txtdescription" id="exampleFormControlTextarea1" rows="3" required></textarea>
                </div>
            </div>
            

        

          <div class='d-flex justify-content-end'>
              <button type='submit' name='btnupdate' class='btn btn-primary btn-md btn-sm btn-lg me-2'>Comfirm</button>
              <button type='submit' name='btnCancel' class='btn btn-primary btn-md btn-sm btn-lg'>Cancel</button>
          </div>

      
                           
       </div>
    </div>

  </div>

</section>
</form>
</body>
</html>