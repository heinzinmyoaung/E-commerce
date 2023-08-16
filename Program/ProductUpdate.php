<?php  
session_start();
include('S_Header.php');
include('connect.php');



if (isset($_REQUEST['ProductID'])) {
    $ProductID = $_REQUEST['ProductID'];

    $Select="SELECT * FROM product
    WHERE ProductID=$ProductID";

    $ret=mysqli_query($conn,$Select);
    $arr=mysqli_fetch_array($ret);

    $txtProductID=$arr['ProductID'];
    $txtProductName=$arr['ProductName'];
    $txtPrice=$arr['Price'];
    $txtQuantity=$arr['Quantity'];
    $txtColor=$arr['Color'];

}


if(isset($_POST['btnupdate'])) 
{
  

    $txtProductID=$_POST['txtProductID'];
    $txtProductName=$_POST['txtProductName'];
    $txtPrice=$_POST['txtPrice'];
    $txtQuantity=$_POST['txtQuantity'];
    $txtColor=$_POST['txtColor'];

    $Update="UPDATE product
            SET ProductName='$txtProductName',
                Price='$txtPrice',
                Quantity='$txtQuantity',
                Color='$txtColor'
            WHERE ProductID='$txtProductID'";

        $U_ret=mysqli_query($conn,$Update) or die(mysqli_error($conn));

        if ($U_ret)
        {
        echo "<script>window.alert('Success!')</script>";
        echo "<script>window.location='ProductPurchaseDisplay.php'</script>";
        }
        else
        {
        echo "mysqli_error($conn)";
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
      
        #panel,#aa,#aa1,#aa2 {
            display: none;
        }
    </style>
</head>
<body style="background-color: #eee;">
<form action="ProductUpdate.php" method="POST">
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

            <input type="text" value="<?php echo $txtProductID?>" name="txtProductID" class="form-control" style="display:none;" >

            <div class=" row p-2 ">
               <div class="col-12 col-sm-4 col-lg-4"><b>Name</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <a href="#" class="text-decoration-none text-reset" id="no" onclick="refreshBlock('panel','Cal','no')">
                    <h5><?php echo $txtProductName?></h5>
                </a>
                <div id="panel">
                    <input type="text" value="<?php echo $txtProductName?>" name="txtProductName"  class="form-control"  id="Cal" autocomplete="off" required>
                </div>
                </div>   
            </div>

            <div class=" row p-2 ">
               <div class="col-12 col-sm-4 col-lg-4"><b> Price</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <a href="#" class="text-decoration-none text-reset" id ="cc" onclick="refreshBlock('aa','bb','cc')">
                    <h5>K<?php echo $txtPrice?></h5>
                </a>
                <div id="aa">
                <input type="text" value="<?php echo $txtPrice?>" name="txtPrice" id="bb" class="form-control"  autocomplete="off" required>
                </div>
                </div>   
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b> Quantity</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <a href="#" class="text-decoration-none text-reset" id="cc1" onclick="refreshBlock('aa1','bb1','cc1')">
                    <h5><?php echo $txtQuantity?> pcs</h5>
                </a>
                <div id="aa1">
                <input type="text" value="<?php echo $txtQuantity?>" name="txtQuantity" class="form-control"  id="bb1" autocomplete="off" required>
                </div>
                </div>
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b> Color</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                <a href="#" class="text-decoration-none text-reset" id="cc2" onclick="refreshBlock('aa2','bb2','cc2')">
                    <h5><?php echo $txtColor?></h5>
                </a>
                <div id="aa2">
                <input type="text" value="<?php echo $txtColor?>" name="txtColor" class="form-control"  id="bb2" autocomplete="off" required>
                </div>
                </div>
            </div>



          
          <div class='d-flex justify-content-end mb-3'>
              <button type='submit' name='btnupdate' class='btn btn-primary  me-2'>Update</button>
              <!-- <button type='submit' name='btnCancel' class='btn btn-primary btn-md btn-sm btn-lg'>Cancel</button> -->
              <a href="ProductPurchaseDisplay.php" class="btn btn-primary">Cancel</a>
          </div>
                           
       </div>
    </div>

  </div>
  </div>
  </div>
  </div>

</section>

<script>

function refreshBlock(s1,s2, s3 ) {
  document.getElementById(s1).style.display = "block";
  document.getElementById(s2).value = "";
  document.getElementById(s3).style.display = "none";
}
</script>
</form>
</body>
</html>
<?php  
include('footer_login.php');
?>