<?php  
include('S_Header.php');
include('connect.php');


if(isset($_POST['btnsave'])) 
{
	$txtbrandname=$_POST['txtbrandname'];

	$query="SELECT * FROM brand WHERE BrandName='$txtbrandname'";
	$ret=mysqli_query($conn,$query);
	$count=mysqli_num_rows($ret);

	if($count!=0) 
	{
		echo "<script>window.alert('Brand Name $BrandName Already Exist.')</script>";
		echo "<script>window.location='BrandRegister.php'</script>";
	}
	else
	{
		$insert="INSERT INTO brand
				 (BrandName)
				 VALUES 
				 ('$txtbrandname')";
		$ret=mysqli_query($conn,$insert);

		if($ret) 
		{
			echo "<script>window.alert('Brand Successfully Created.')</script>";
			echo "<script>window.location='BrandRegister.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in Brand : " . mysqli_error($conn) . "</p>";
		}
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

<div class="container col-10 col-sm-6 col-lg-4">
    <div class="border rounded mt-5 bg-light">
        <div class="text-center">
            <h2 class="text-capitalize my-5 text-lg">Brand Entry</h2>
        </div>
        <form action="BrandRegister.php" method="POST" class="mx-3">

            <!-- -----error Message condition---- -->
            
            <!-- -------- -->
            <!-- <div id="myDiv"><p>heelo</p></div> -->
            <div class="row mb-3">
            <label for="inputName3" class="col-lg-4 col-form-label">Brand Name</label>
            <div class="col-lg-8 ">
                <input type="text" name="txtbrandname" class="form-control" placeholder="Enter Brand Name" id="inputName3" autocomplete="off" required>
            </div>
            </div>
        
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-end mb-4">
                <button type="submit" name="btnsave" class="btn btn-primary me-md-2">Save</button>
                <button type="reset"  class="btn btn-primary">Clear</button>
          </div>
        </form>

    </div>  
</div>

<div class="container col-12 col-sm-7 table-responsive mt-5">
<legend>Brand Listing:</legend>

<?php  
	$query="SELECT * FROM brand ORDER BY BrandID DESC";
	$ret=mysqli_query($conn,$query);
	$count=mysqli_num_rows($ret);

	if($count==0) 
	{
		echo "<p>No Brand Record Found.</p>";
		exit();
	}
	?>
    <table class=" table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">CategoryName</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php

for($i=0;$i<$count;$i++) 
{
    $arr=mysqli_fetch_array($ret);
    $BrandID=$arr['BrandID'];
    $BrandName=$arr['BrandName'];

    echo "<tr>";
        echo "<td>$BrandID</td>";
        echo "<td>" . $arr['BrandName'] . "</td>";
    
        echo "<td> 
                <a href='BrandDelete.php?BrandID=$BrandID'>Delete</a> | 
                <a href='BrandUpdate.php?BrandID=$BrandID'>Update</a>
              </td>";

    echo "</tr>";

    
}
?>
</table>
</div>
</body>
</html>

<?php  
include('footer_login.php');
?>