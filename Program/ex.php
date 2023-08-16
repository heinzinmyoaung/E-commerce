<?php
	session_start();
	include('connect.php');


$CustomerID=$_SESSION['CustomerID'];
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
  <Style>
    .b {
      
      font-size:18px;
      font-weight: 10;
    }
    .s{
      font-size:15px;
      font-weight: 10;
    }
  </Style>

</head>
<body>
<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">
         
          <h4 class="fw-normal mb-0 text-black">All Order Details</h4><br>
          
        <!-- <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Product Purchase</h3>
          <div> -->
            <!-- <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i
                  class="fas fa-angle-down mt-1"></i></a></p> -->
          </div>
        </div>


        <?php  


	$query="SELECT OrderID
            FROM orders 
            WHERE CustomerID = '$CustomerID'";
	$ret=mysqli_query($conn,$query);
	$count=mysqli_num_rows($ret);
	if($count < 1) 
	{
		echo "<p>No Order Found.</p>";
		exit();
	}

for($a=0;$a<$count;$a+=4) 
{ 
	$query1="SELECT * FROM orders 
			 ORDER BY OrderID DESC
             LIMIT $a,4";

	$ret1=mysqli_query($conn,$query1);
	$count1=mysqli_num_rows($ret1);

	
	for($b=0;$b<$count1;$b++) 
	{ 
		$arr=mysqli_fetch_array($ret1);
		$OrderID=$arr['OrderID'];
		$OrderDate=$arr['OrderDate'];
        $TotalAmount=$arr['TotalAmount'];
		$TotalQuantity=$arr['TotalQuantity'];
        $Status=$arr['Status'];

?>
        
        <form action="a.php" method="GET">
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
              <p class=" b m-auto"><?php echo $OrderID?></p>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2">
                <p class="b m-auto"><?php echo $OrderDate?></p>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2">
                <p class="b m-auto"><span class="text-muted s">Quantity </span><?php echo $TotalQuantity?></p>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2  ">
            
                <p class="b m-auto">K<?php echo $TotalAmount?></p>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2 my-3 ">
                 <b>
                   <?php 
                      if($Status =="Approved"){
                        echo "
                        <span class='text-success'>$Status</span>";
                      }elseif($Status == "Cancled"){
                        echo "
                        <span class='text-danger'>$Status</span>";
                      }else{
                        echo "
                        <span class='text-warning'>$Status</span>";
                      }
                    
                   ?>
                
                </span></b>
              </div>

              <div class="col-md-12 col-lg-1 col-xl-1 ">
                <button tyle="summit" class="btn btn-sm btn-primary" name="orderdetail" data-toggle="modal" data-target="#addNewQAC" value="<?php echo $OrderID?>" >Details</button>
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
</form>

</body>
</html>
