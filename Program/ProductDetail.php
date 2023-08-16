<?php  
session_unset();
session_start();
include('header.php');
include('connect.php');

$_SESSION['productid']=$_REQUEST['ProductID'];
$ProductID=$_SESSION['productid'];

$query="SELECT p.*, c.CategoryName,c.CategoryID, b.BrandName,b.BrandID 
		FROM product p, category c, brand b
		WHERE ProductID='$ProductID'
		AND p.BrandID=b.BrandID
		AND p.CategoryID=c.CategoryID";

$ret=mysqli_query($conn,$query);
$arr=mysqli_fetch_array($ret);

$ProductName=$arr['ProductName'];

$Price=$arr['Price'];
$Quantity=$arr['Quantity'];
$Description=$arr['Description'];
$CategoryName=$arr['CategoryName'];
$BrandName=$arr['BrandName'];

$FrontImage=$arr['FrontImage'];

$Color=$arr['Color'];

// ===================shoppingcart count check=======
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();
}
// ==========================

if(isset($_POST['btnAddtoCart']))
    {
        
      if(isset($_SESSION['cart']))
      {
          
        $session_array_id= array_column($_SESSION['cart'], "id");

        if(!in_array($ProductID, $session_array_id)) {
            
            $session_array= array(
                "id" => $ProductID,
                "name" => $ProductName,
                "image" => $FrontImage,
                "price" =>  $Price,
                "color" => $Color,
                "qty" => $_POST['txtbuyQty']
                
            );
            $_SESSION['cart'][]=$session_array;
           
        }else{
            $session = $_SESSION['cart'];

            for( $i =key($session); $i<= array_key_last($session);$i++){
                $id= $session[$i]["id"];
                $qty=$session[$i]["qty"];
                $buyqty=$_POST['txtbuyQty'];
                $qtysum =""; 
                if($id==$ProductID){
                    
                    $s= (int)$qty;
                    $qtysum = $s+(int)$buyqty;

                    if($qtysum <= $Quantity){
                        // $session[$i]["qty"]=$qtysum;
    
                        $_SESSION['cart'][$i]["qty"]=$qtysum;
                    }else{
                        echo "<script>window.alert('Limit reached')</script>";
                    }
               
            }
        }
       
    }

      }else{
          $session_array= array(
              "id" => $ProductID,
              "name" => $ProductName,
              "image" => $FrontImage,
              "price" =>  $Price,
              "color" => $Color,
              "qty" => $_POST['txtbuyQty']
              
          );
          $_SESSION['cart'][]=$session_array;
          
      }


            
        
      
    }
    elseif(isset($_POST['btnBuyItNow'])){
        
        echo "<script>window.location='Checkout.php'</script>";
        if(isset($_SESSION['cart']))
      {
        unset($_SESSION['cart']);
        $session_array_id= array_column($_SESSION['cart'], "id");

        if(!in_array($ProductID, $session_array_id)) {
            
            $session_array= array(
                "id" => $ProductID,
                "name" => $ProductName,
                "image" => $FrontImage,
                "price" =>  $Price,
                "color" => $Color,
                "qty" => $_POST['txtbuyQty']
                
            );
            $_SESSION['cart'][]=$session_array;
        }else{
           
            $session = $_SESSION['cart'];

            for( $i =key($session); $i<= array_key_last($session);$i++){
                $id= $session[$i]["id"];
                $qty=$session[$i]["qty"];
                $buyqty=$_POST['txtbuyQty'];
                $qtysum =""; 
                if($id==$ProductID){
                    
                    $s= (int)$qty;
                    $qtysum = $s+(int)$buyqty;

                    if($qtysum <= $Quantity){
                        // $session[$i]["qty"]=$qtysum;
    
                        $_SESSION['cart'][$i]["qty"]=$qtysum;
                    }else{
                        echo "<script>window.alert('Limit reached')</script>";
                    }
               
            }
        }
       
    }

      }else{
          $session_array= array(
              "id" => $ProductID,
              "name" => $ProductName,
              "image" => $FrontImage,
              "price" =>  $Price,
              "color" => $Color,
              "qty" => $_POST['txtbuyQty']
              
          );
          $_SESSION['cart'][]=$session_array;
          
      }
      foreach($_SESSION['cart'] as $key => $value){
        $id= $value["id"];
        $name= $value["name"];
        $image= $value["image"];
        $color= $value["color"];
        $price= $value["price"];
        $qty= $value["qty"];
        $total_price =number_format($value["price"] * $value["qty"]);
        $ProductIDArray = array();

        $sum = $sum + $value["qty"] * $value["price"];
        $total_qty = $total_qty + $value["qty"];
        array_push($ProductIDArray,$id);
        $total=number_format($sum);
        $_SESSION['Qty']=$total;
        $_SESSION['ProductIDArray']=$ProductIDArray;
        $_SESSION['total_qty']=$total_qty;
      }
     
    }
    // =======shoppingcart count===
    function add($x){
        return $x + sizeof($_SESSION['cart']);
        
    }
  // ==========
    
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
    </style>

</head>
<body>
    <form action="ProductDetail.php?ProductID=<?php echo $ProductID?>" method="POST">
    
        <div class="container ">
        
            <span class='badge badge-warning' id='lblCartCount'> 
         
            <script>
                const result = <?php echo add(0)?> ;
                document.getElementById("lblCartCount").innerHTML = result;
                document.getElementById("lblCartCount1").innerHTML = result;
            </script>
            </span>
        <!-- </a> -->

            <div class="row">
                <div class="col-md-0 col-lg-1"></div>

                <div class="col-md-6 col-lg-5 " style="border-bottom: 2px solid #f2f2f2">
                    <div>
                        <h4 class=" fw-light text-capitalize my-5 text-lg">Verified Authentic</h4>
                    </div>

                    <div class="w-100">
                         <img src="<?php echo $FrontImage ?>" class="card-img-top img-fluid" alt="..." >
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-5" style="border-bottom: 2px solid #f2f2f2">
                    <div>
                         <h3 class="text-capitalize my-5 text-lg "><?php echo $ProductName?> </h3>
                    </div>

                    <div class="row mb-3 ">
                        <div class="col-4">
                            <label class=" col-form-label fw-light">Price:</label>
                        </div>
                        <div class="col-8">
                            <label class="col-form-label fw-bold"><?php echo $Price?>MMK</label>
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <div class="col-4">
                        <label class="col-form-label fw-light">Color:</label>
                        </div>
                        <div class="col-8">
                            <label class="col-form-label fw-bold"><?php echo $Color?></label>
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <div class="col-4">
                        <label class="col-form-label fw-light">Available Quantity:</label>
                        </div>
                        <div class="col-8">
                            <label class="col-form-label fw-bold">
                            <?php 
                            if($Quantity==0) 
                            {
                                echo "<b><del>Out of Stock.</del></b>";
                                exit();
                            }
                            else
                            {
                                echo "<b>$Quantity</b> Pcs";
                            }
                            ?>
                            </label>
                        </div>
                    </div>
                    
                    <div class="row mb-4 ">
                        <div class="col-4">
                        <label class="col-form-label fw-light">Quantity:</label>
                        </div>
                        <div class="col-8">
                            <!-- <label class="col-form-label fw-bold"> -->
                            <input type="number" value="1" style="width: 60px;" required name="txtbuyQty"  min="1" max="<?php echo $Quantity  ?>">
                
                            <!-- </label> -->
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <div class="col-5" >
                            <input type="submit" name="btnAddtoCart" style="width: 120px" class="btn btn-large btn-success" value="Add to Cart"/>
                        </div>
                        
                        <div class="col-7">
                        <input type="submit" name="btnBuyItNow" style="width: 120px" class="btn btn-large btn-success" value="Buy it now"/>
                            <!-- <button type="button" class="  btn btn-large btn-success" style="width: 120px">
                                <a href="ShoppingCart.php" class="text-decoration-none text-white"><span>Buy it now </span></a> -->
                            </button>
                        </div>
                    
                    </div>

                    
                </div>
                
                <div class="col-md-0 col-lg-1"></div>
            </div>

            <div class="row">
                <h3 class="text-capitalize my-5 text-lg">Product Details </h3>
                <div>
                    <p class="text-capitalize mb-3 text-lg"><?php echo $Description?> </p>
                </div>
            </div>
        </div>
    </form>

  
</body>
</html>

 
<?php
    include('footer.php');
?>