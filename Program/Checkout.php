<?php 
	session_start(); 
  include('header.php');

    $qty= $_SESSION['Qty'];
    $total_qty=$_SESSION['total_qty'];
    $ProductIDArray=$_SESSION['ProductIDArray'];
  

	include('connect.php');
	include('AutoIDFunction.php');
   $a="";
if(isset($_SESSION['CustomerID'])) 
{
	if(!isset($_SESSION['cart'])) 
	{
		echo "<script>window.alert('Your Shopping  is Empty')</script>";
		echo "<script>window.location='ProductDisplay.php'</script>";
	}


$CustomerID = $_SESSION['CustomerID'];
$query="Select * From customer
	    Where CustomerID= $CustomerID";
$ret=mysqli_query($conn,$query);
$row=mysqli_fetch_Array($ret);

$CustomerName = $row ['CustomerName'];
}
else         
{
	    echo "<script>window.alert('Login Again')</script>";
		echo "<script>window.location='Login.php'</script>";
}


if(isset($_POST['btnCheckout'])) 
{
  if(isset($_POST['rdoPaymentOption'])){
	//Orders--------------------------------------------------

	$txtOrderID=$_POST['txtOrderID'];
	$txtOrderDate=$_POST['txtOrderDate'];
	$rdoPaymentOption=$_POST['rdoPaymentOption'];
	$txtphone=$_POST['txtphone'];
	$txtaddress=$_POST['txtaddress'];
	$txtCardInfo="Pay with ".$_POST['rdoPaymentOption']."";
  $txtOrderProductID=$_POST['txtOrderProductID'];

	//----------------------------------------------
	$CustomerID=$_SESSION['CustomerID'];
    
	$Status="Pending";
	$query="INSERT INTO orders
			(OrderID, OrderDate, CustomerID, TotalAmount, TotalQuantity, 
		    Status, PaymentOption, DeliveryPhone, DeliveryAddress, CardNo)
			VALUES 
			('$txtOrderID','$txtOrderDate','$CustomerID','$qty','$total_qty',
		    '$Status','$rdoPaymentOption','$txtphone','$txtaddress','$txtCardInfo')";
	$ret=mysqli_query($conn,$query);

	//Payment--------------------------------------------------

	
	$query_payment="INSERT INTO payment
					(`OrderID`, `TotalAmount`)
					VALUES 
					('$txtOrderID','$qty')";
	$ret=mysqli_query($conn,$query_payment);
					

    $session = $_SESSION['cart'];


	for($i =key($session); $i<= array_key_last($session);$i++) 
	{ 
		$ProductID=$session[$i]['id'];
		$Price=$session[$i]['price'];
		$BuyQuantity=$session[$i]['qty'];

    $Total_Price=$Price*$BuyQuantity;
    
		

  $insert_ODetail="INSERT INTO orderproduct
    (`OrderID`, `ProductID`,`Quantity`,`Price`)
    VALUES 
    ('$txtOrderID','$ProductID','$BuyQuantity','$Total_Price')";
  $ret=mysqli_query($conn, $insert_ODetail);
  
  $updateQty="UPDATE product
     SET Quantity = Quantity - '$BuyQuantity'
     WHERE ProductID = '$ProductID'";
  $ret=mysqli_query($conn,$updateQty);
	
	}


	if($ret)
	{
		unset($_SESSION['cart']);
		echo "<script>window.alert('Checkout Process Complete')</script>";
		echo "<script>window.location='ProductDisplay.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Checkout Form :" . mysqli_error($conn) . "</p>";
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
    <link rel="stylesheet" href="./fontawesome-free-6.1.2-web/css/all.min.css">
    <style>


#sticky-div {
   position : sticky;
 bottom:0;
 top:30px

}
    </style>

</head>
<body style="background-color: #eee;">
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center">
          <div class="col-md-7 col-xl-5 mb-4 mb-md-0 p-2 " style="background-color: #f8f9fa; border: 1px solid black;">
            <div class="py-2 d-flex flex-row">

            </div>
            <h4 class="mb-5">Payment Information</h4>
            

            <form action="Checkout.php" method="POST" class="pb-3">

                <div class="row mb-3">
                    <label for="inputphonenumber3" class="col-lg-3 col-form-label">Delivery Phone</label>
                    <div class="col-lg-9">
                    <input type="text" name="txtphone" class="form-control " placeholder="Phone Number" id="inputphonenumber3" autocomplete="off" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="inputphonenumber3" class="col-lg-3 col-form-label">Address</label>
                    <div class="col-lg-9">
                    <textarea class="form-control" name="txtaddress" id="exampleFormControlTextarea1" rows="3" placeholder="Delivery Address" required></textarea>
                    </div>

                
                </div>

                <div class="d-flex flex-row pb-3">
                  <div class="d-flex align-items-center p-3">
                  <input class="form-check-input" type="radio" name="rdoPaymentOption"  value="COD" required/>
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0"><i class="fa-solid fa-money-bill-1 fa-lg  text-primary pe-2"></i>Cash On Delivery</p>
                   
                  </div>
                </div>

                <div class="d-flex flex-row pb-3">
                  <div class="d-flex align-items-center p-3">
                  <input class="form-check-input" type="radio" name="rdoPaymentOption" value="VISA"  required/>
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0">
                      <i class="fab fa-cc-visa fa-lg text-dark pe-2"></i>Visa Debit Card
                    </p>
                   
                  </div>
                </div>

                <div class="d-flex flex-row ">
                  <div class="d-flex align-items-center p-3">
                    <input class="form-check-input" type="radio" name="rdoPaymentOption" value="Mastercard" required/>
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0">
                      <i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>Mastercard Office
                    </p>
                   
                  </div>
                </div>

                
            <div class="my-4">
              <input type="submit" value="Proceed to payment" class="btn btn-primary btn-block btn-lg" name="btnCheckout" />
            </div>
             

              

            
            
          </div>

          <div class="col-md-5 col-xl-4 offset-xl-1 ">
           
            <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa; border: 1px solid black;">
              <div class="p-2 me-3">
                <h4>Summary</h4>
              </div>
              <div class="p-2 d-flex">
                <div class="col-7">OrderID</div>
                <input type="text" name="txtOrderID" value="<?php echo AutoID('orders','OrderID','OR-',6) ?>" style="display:none;"/>
                <div class="d-flex justify-content-start"><?php echo AutoID('orders','OrderID','OR-',6) ?></div>
              </div>

              <div class="p-2 d-flex">
                <div class="col-7">OrderDate</div>
                <input type="text" name="txtOrderDate" value="<?php echo date('Y-m-d') ?>" style="display:none;"/>
                <div class="d-flex justify-content-start"><?php echo date('Y-m-d') ?></div>
              </div>

              <div class="p-2 d-flex">
                <div class="col-7">Name</div>
                <input type="text" name="txtCusName" value="<?php echo $CustomerName ?>" style="display:none;"/>
                <div class="d-flex justify-content-start"><?php echo $CustomerName ?></div>
              </div>

              <div class="p-2 d-flex">
                <div class="col-7">Total Quantity</div>
                <input type="text" name="txtTotalQuantity" value="<?php echo $total_qty ?>" style="display:none;"/>
                <div class="d-flex justify-content-start"><?php echo $total_qty ?></div>
              </div>

              <div class="p-2 d-flex">
                <div class="col-7"><b>Total Price</b></div>
                <input type="text"  name="txtTotalAmount" value="<?php echo $qty?>" style="display:none;"/>
                <div class="d-flex justify-content-start"><b ><?php echo $qty?></b></div>
              </div>

              <input type="text" name="txtOrderProductID" value="<?php echo AutoID('orders','OrderProductID','OP-',6) ?>" style="display:none;"/>
              </form>

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