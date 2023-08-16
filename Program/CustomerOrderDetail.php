<?php
	session_start();
  include('header.php');
	include('connect.php');

$CustomerID=$_SESSION['CustomerID'];

$OrderID=$_REQUEST['orderdetail'];



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
        .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
}

#sticky-div {
   position : sticky;
 bottom:0;
 top:30px

}
    </style>

</head>
<body>

<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-10">
         
         <h4 class="fw-normal mb-0 text-black">All Order Details</h4><br>
         
         </div>
       </div>
      <div class="col">
     
        <div class="card">
          <div class="card-body p-4" data-bs-spy="scroll">

            <div class="row">
              <div class="col-lg-8">
                <h5 class="mb-3"><a href="ProductDisplay.php" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                   
                    <h5 class="mb-0 text-secondary ">OrderID : <?php echo $OrderID?></h5>
                    
                  </div>
                </div>
                


            <?php
 
                 $sum=0;
                 $total=0;
                 $total_qty=0;

          
                
                 $query="SELECT * FROM orderproduct
                         WHERE OrderID ='$OrderID' ";

                  $ret=mysqli_query($conn,$query);
                  $count=mysqli_num_rows($ret);
                 
                 
                  for($i=0;$i<$count;$i++){
                    $arr=mysqli_fetch_array($ret);
                    $ProductID=$arr['ProductID'];
                    $Price =$arr['Price'];
                    $Quantity =$arr['Quantity'];
                    // var_dump($ProductID);

                    $query1="SELECT * FROM product
                             WHERE ProductID='$ProductID'";

                    $ret1=mysqli_query($conn,$query1);
                    $arr1=mysqli_fetch_array($ret1);

                    $name=$arr1['ProductName'];
                    $color=$arr1['Color'];
                    $image = $arr1['FrontImage'];
                    $price =$arr1['Price'];
                    

                    echo "
                    <div class='card mb-3'>
                     <div class='card-body'>
                         <div class='d-flex justify-content-between'>
                         <div class='d-flex flex-row align-items-center'>
                             <div>
                             <img
                                 src='$image' style='width: 65px;'>
                             </div>
                             <div class='ms-3'>
                             <b>$name <span class='fs-6'>- $color</span></b>
                             <p class='text-warning small mb-0'>K$price</p>
                             </div>
                         </div>
                         <div class='d-flex flex-row align-items-center'>
                             <div style='width: 140px;'>
                             <span class='text-muted' style='font-size: 14px;'>Quantity of <span class='fw-normal fs-6 text-dark mb-0'>$Quantity</span></span>
                             </div>
                           
                             <div style='width: 180px;'>
                             <b><span class='mb-0 fs-6'>K$Price</span></b>
                             </div>
                             
                         </div>
                         </div>
                     </div>
                     </div>";
                    

                  }

            ?>

              </div>

            <?php 
               $query_o="SELECT TotalAmount,TotalQuantity,Status FROM orders
                          WHERE OrderID='$OrderID'";
              $ret_o=mysqli_query($conn,$query_o);
              $arr_o=mysqli_fetch_array($ret_o);

              $TotalAmount=$arr_o['TotalAmount'];  
              $TotalQuantity=$arr_o['TotalQuantity'];   
              $Status=$arr_o['Status'];
           ?>

             
              <div class='col-lg-4'>

                <div class='card bg-light  rounded-3 ' id='sticky-div'>
                  <div class='card-body'>
                    <div class='d-flex justify-content-between align-items-center mb-4'>
                      <h5 class='mb-0 text-secondary '>Summary</h5>
                    </div>

                    <hr class='my-4'>

                    <div class='d-flex'>
                      <p class='mb-2 col-8'>Total Quantity:</p>
                      <p class='mb-2'><?php echo $TotalQuantity?></p>
                    </div>

                    <div class='d-flex mb-4'>
                      <p class='mb-2 col-8 fw-bolder'>Total(tax included):</p>
                      <p class='mb-2 fw-bolder'>K<?php echo $TotalAmount?></p>
                    </div>

                    <?php 
                    if($Status == "Pending"){
                    echo"
                     
                      <button type='button' class='ml-3 btn btn-info btn-block' style='width: 80px; height: 40px;'>
                      <div class='d-flex'>
                        <a href='CustomerOrderDelete.php?orderdetail=$OrderID' class='text-decoration-none text-dark'>Cancel</a>
                      </div>
                    </button>
                    
                    ";
                    }elseif ($Status == "Canceled") {
                      echo"
                      
                      <span class='text-danger'>Order is Calceled</span>
                    
                    ";
                    }
                    else {
                      echo"
                      
                      <span class='text-success'>Order is Approved</span>
                    
                    ";
                    }
                    ?>
                   
<span></span>
                  </div>
                </div>

              </div>
              

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</section>

       
</body>
<?php
 include('footer.php');
?>
 <!-- // <div class='d-flex'>
                      //   <button type='submit' name='btncancel' class='btn btn-info btn-lg hide-btn'>Cancel</button>
                      // </div> -->