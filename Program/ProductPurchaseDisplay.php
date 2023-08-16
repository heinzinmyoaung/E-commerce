<?php
	session_start();
  include('S_Header.php');
	include('connect.php');

if(!isset($_SESSION['StaffName'])){
  echo "<script>window.alert('Firstly You Must Login')</script>";
  echo "<script>window.location='StaffLogin.php'</script>";
  exit();
}
$StaffName = $_SESSION['StaffName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-6.1.2-web/css/all.min.css">
    <style>
      body{
        background-color: #eee;
      }
        a {
            text-decoration: none;
            color: inherit;
        }
        a:hover {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">
         
          <h4 class="fw-normal mb-0 text-black">Login: <?php echo $StaffName?>, </h4><br>
          
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Product Display For Staff</h3>
          <div>
           
          </div>
        </div>


        <?php  


	$query="SELECT * FROM product ORDER BY ProductID DESC";
	$ret=mysqli_query($conn,$query);
	$count=mysqli_num_rows($ret);
	if($count < 1) 
	{
		echo "<p>No Product Found.</p>";
		exit();
	}

for($a=0;$a<$count;$a+=4) 
{ 
	$query1="SELECT * FROM product 
			 ORDER BY ProductID DESC
			 LIMIT $a,4";
	$ret1=mysqli_query($conn,$query1);
	$count1=mysqli_num_rows($ret1);

	
	for($b=0;$b<$count1;$b++) 
	{ 
		$arr=mysqli_fetch_array($ret);
		$ProductID=$arr['ProductID'];
		$ProductName=$arr['ProductName'];
        $Color=$arr['Color'];
		$Price=$arr['Price'];
        $Quantity=$arr['Quantity'];
		$Image1=$arr['FrontImage'];
		
		$Price=$arr['Price'];
?>
        <!-- <div class="card-group"> -->
        
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="<?php echo $Image1 ?>"
                  class="img-fluid rounded-3" alt="Electronic Device">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $ProductName?></p>
                <p><span class="text-muted">Color: </span><?php echo $Color?></p>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 d-flex">
              
              <p><span class="text-muted">Quantity of </span><span class=" lead fw-normal"><?php echo $Quantity?></span></p>


                
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">K<?php echo $Price ?></h5>
              </div>
              <div class="col-md-12 col-lg-2 col-xl-2 text-end">
                
                <a href="ProductUpdate.php?ProductID=<?php echo $ProductID ?>" class="fs-3 text-danger "><i class="fa-solid fa-pen-to-square mx-3"></i></a>
                <a href="ProductPurchase.php?ProductID=<?php echo $ProductID ?>" class="fs-3 text-danger"><i class="fa-solid fa-circle-plus"></i></a>
              </div>
            </div>
          </div>
        </div>

            
        
        <?php
    }
}
?>
        

      </div>
    </div>
  </div>
</section>

</body>
</html>
<?php  
include('footer_login.php');
?>