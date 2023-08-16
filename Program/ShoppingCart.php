<?php
session_unset();
session_start();
include('header.php');

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
                    <!-- <p class="mb-1">Shopping cart</p> -->
                    <h5 class="mb-0 text-secondary ">Shopping cart</h5>
                    
                  </div>
                </div>
                


            <?php
 
                 $sum=0;
                 $total=0;
                 $total_qty=0;
                 $ProductIDArray = array();
        

                    if (!empty($_SESSION['cart'])) {
                        foreach($_SESSION['cart'] as $key => $value){
                           $id= $value["id"];
                           $name= $value["name"];
                           $image= $value["image"];
                           $color= $value["color"];
                           $price= $value["price"];
                           $qty= $value["qty"];
                           $total_price =number_format($value["price"] * $value["qty"]);

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
                                    <h5>$name <span class='fs-6'>- $color</span></h5>
                                    <p class='text-warning small mb-0'>K$price</p>
                                    </div>
                                </div>
                                <div class='d-flex flex-row align-items-center'>
                                    <div style='width: 50px;'>
                                    <span class='fw-normal fs-6  mb-0'>$qty</span>
                                    </div>

                                    <div style='width: 180px;'>
                                    <span class='mb-0 fs-6'>K$total_price</span>
                                    </div>
                                    <a href='ShoppingCart.php?action=remove&id=$id' class='text-secondary'><i class='fas fa-trash-alt'></i></a>
                                </div>
                                </div>
                            </div>
                            </div>";

                            $sum = $sum + $value["qty"] * $value["price"];
                            $total_qty = $total_qty + $value["qty"];
                            array_push($ProductIDArray,$id);
                        }
                            $total=number_format($sum);
                            $_SESSION['Qty']=$total;
                            $_SESSION['ProductIDArray']=$ProductIDArray;
                            $_SESSION['total_qty']=$total_qty;
                    }

                    if(isset($_GET['action'])){

                        if($_GET['action']== "remove"){
        
                            foreach ($_SESSION['cart'] as $key => $value){
        
                            if($value['id'] == $_GET['id']){
                                unset($_SESSION['cart'][$key]);
                                echo "<script>window.location='ShoppingCart.php'</script>";
                                
                                
                            }
                    }
                }
                    
                   
                }
            ?>

              </div>

              <div class="col-lg-4">

                <div class="card bg-light  rounded-3 " id="sticky-div">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0 text-secondary ">Summary</h5>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex">
                      <p class="mb-2 col-8">Total Quantity:</p>
                      <p class="mb-2"><?php echo $total_qty?></p>
                    </div>

                    <div class="d-flex mb-4">
                      <p class="mb-2 col-8 fw-bolder">Total(tax included):</p>
                      <p class="mb-2 fw-bolder">K<?php echo $total?></p>
                    </div>


                    <button type="button" class="btn btn-info btn-block " style='width: 122px; height: 43px;'>
                      <div class="d-flex">
                        <a href="Checkout.php" class="text-decoration-none text-dark"><span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span></a>
                      </div>
                    </button>

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