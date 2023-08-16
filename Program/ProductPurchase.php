<?php  
session_start();  

	include('connect.php');
	include('AutoIDFunction.php');
  include('S_Header.php');

    // -------------------Product Purchase----
    $_SESSION['ProductID']=$_REQUEST['ProductID'];
    $ProductID=$_SESSION['ProductID'];

    $PurchaseID=AutoID('purchase','PurchaseID','PUR-',6);
    $Date=date('Y-m-d');
    $StaffName=$_SESSION['StaffName'];
    $StaffRole=$_SESSION['Role'];

    $query="SELECT * from product 
                WHERE ProductID= $ProductID";

$ret=mysqli_query($conn,$query);
$arr=mysqli_fetch_array($ret);

    $ProductName=$arr['ProductName'];
    $FrontImage=$arr['FrontImage'];



    if(!isset($_SESSION['StaffID'])) 
    {
        echo "<script>window.alert('Please Login first to continue.')</script>";
        echo "<script>window.location='StaffLogin.php'</script>";
    }



if(isset($_POST['btnadd']))
    {
        
      if(!isset($_SESSION['Purchase']))
      {
          
            
            $session_array= array(
                "productid" => $ProductID,
                "purchaseid" => $PurchaseID,
                "date" => $Date,
                "productname" => $ProductName,
                "image" => $FrontImage,
                "SupplierID" => $_POST['cboSupplierID'],
                "price" =>  $_POST['txtprice'],
                "qty" => $_POST['txtquantity']
                
                
            );
            $_SESSION['Purchase'][]=$session_array;
        }
               
    }
// ------------------------

    // ==============display none
    if(!isset($_POST['btnadd'])){
echo"
    <style>
    .hide {
        display: none;
    }
    </style>";
}elseif(isset($_POST['btnadd'])){
    echo"
        <style>
        .hi {
            display: none;
        }
        </style>";
    };

// ================

    // ================= Purchase Detai============
    $StaffID=$_SESSION['StaffID'];
    $StaffName=$_SESSION['StaffName'];
    $StaffRole=$_SESSION['Role'];






    if (!empty($_SESSION['Purchase'])) {
        foreach($_SESSION['Purchase'] as $key => $value){
           $ProductID= $value["productid"];
           $PurchaseID= $value["purchaseid"];
           $Date= $value["date"];
           $ProductName= $value["productname"];

           $FrontImage= $value["image"];
           $SupplierID= $value["SupplierID"];
           $price= $value["price"];
           $qty= $value["qty"];
           $subtotal=$price * $qty;
           $govtax= $subtotal * 0.05;
           $FinalTotal = $subtotal+ $govtax;
           $EachProductPrice = $FinalTotal/$qty;

            $query="SELECT * from supplier 
            WHERE SupplierID= $SupplierID";

            $qs=mysqli_query($conn,$query);
            $arr=mysqli_fetch_array($qs);

            $SupplierName=$arr['SupplierName'];
            $_SESSION['SupplierName'] = $SupplierName;


            if(isset($_POST['btnSave'])){

                $Status="Pending";

                $insert_Pur="INSERT INTO purchase
                             (`PurchaseID`, `PurchaseDate`, `SupplierID`,`StaffID`, `TotalAmount`, `TotalQuantity`, `GovTax`, `NetAmount`, `Status`)
                             VALUES 
                             ('$PurchaseID','$Date','$SupplierID','$StaffID','$subtotal','$qty','$govtax','$FinalTotal','$Status')";
            
                // print("insert purchase: ". $insert_Pur);
                
                $pu=mysqli_query($conn,$insert_Pur);
            



                $insert_PurDetail="INSERT INTO purchasedetail
                                    (`PurchaseID`, `ProductID`, `PurchasePrice`, `PurchaseQuantity`)
                                    VALUES 
                                    ('$PurchaseID','$ProductID','$price','$qty')";
                $purd=mysqli_query($conn,$insert_PurDetail);


                $updateQty="UPDATE product
                        SET Quantity=Quantity+'$qty',
                            Price = '$EachProductPrice'
                        WHERE ProductID='$ProductID'";

                $ret=mysqli_query($conn,$updateQty);

                if($ret){
                    unset($_SESSION['Purchase']);
                    echo "<script>window.alert('Purchase Process Completed')</script>";
                    echo "<script>window.location='ProductPurchaseDisplay.php'</script>";
                }else
                {
                    echo "<p>Something went wrong in Purchase Form :" . mysqli_error($conn) . "</p>";
                }
            
            }

        }
    }
    // =========================
    if(isset($_POST['btnCancel'])){
        unset($_SESSION['Purchase']);
        echo "<script>window.location='ProductPurchaseDisplay.php'</script>";
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
<form action="ProductPurchase.php?ProductID=<?php echo $ProductID?>" method="POST">
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center pb-2">
            
    <!-- <div class="container col-10 col-sm-6 col-xxl-4"> -->
            <!-- <div class="col-md-8 col-xl-6 offset-xl-1 "> -->
            <div class="col-md-8 col-xl-4 offset-xl-1 hi">
           
           <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa; border: 1px solid black;">
             <div class="p-2 me-3">
               <h4>Product Purchase</h4>
             </div>
             <div class="p-2 d-flex">
               <div class="col-7">PurchaseID</div>
      
               <div class="d-flex justify-content-start"><?php echo AutoID('purchase','PurchaseID','PUR-',6)  ?></div>
             </div>

             <div class="p-2 d-flex">
               <div class="col-7">Product Name</div>
               <input type="text" name="txtProductID" value="<?php echo $ProductID ?>" style="display:none;"/>
               <div class="d-flex justify-content-start"><?php echo $ProductName ?></div>
             </div>

             <div class="p-2 d-flex">
               <div class="col-7">Date</div>
               <div class="d-flex justify-content-start"><?php echo date('Y-m-d') ?></div>
             </div>

             <div class="p-2 d-flex">
               <div class="col-7">Staff</div>
               <div class="d-flex justify-content-start"><?php echo $_SESSION['StaffName'].' ('.$_SESSION['Role'].')'  ?></div>
             </div>

             <div class="p-2 d-flex">
               <div class="col-7">GOV Tax</div>
               
               <div class="d-flex justify-content-start">5% </div>
             </div>
             <hr>

             <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 "><b>SupplierID</b></div>
               <div class="col-12 col-sm-8 mb-3 ">
                <select class="form-control"  name="cboSupplierID" id="inputrole3" required>
                    <option value="<?php echo $SupplierID ?>">Select Supplier ID</option>
                    <?php   
                        $query="SELECT * FROM supplier ";
                        $ret=mysqli_query($conn,$query);
                        $count=mysqli_num_rows($ret);

                        for($i=0;$i<$count;$i++) 
                        { 
                            $arr=mysqli_fetch_array($ret);
                            $SupplierID=$arr['SupplierID'];
                            $SupplierName=$arr['SupplierName'];
                            echo "<option value='$SupplierID'>" . $SupplierID . ' ~ ' . $SupplierName . "</option>";
                        }

	                ?>
            
                </select>
                </div>
            </div>

            <div class=" row p-2 d-flex">
               <div class="col-12 col-sm-4 col-lg-4"><b>Price</b></div>
                <div class="col-12 col-sm-8 mb-3 col-lg-8 ">
                    <input type="number" value="<?php echo $price?>" name="txtprice" class="form-control" placeholder="0 MMK" autocomplete="off" required>
                </div>
            </div>

            <div class=" row p-2 d-flex">
                <div class="col-12 col-sm-4 "><b>Quantity</b></div>
                <div class="col-12 col-sm-8 mb-3 ">
                    <input type="number" value="<?php echo $qty?>" name="txtquantity" class="form-control" placeholder="0 Pcs" autocomplete="off" required>
                </div>
            </div>

      

            <div class="d-flex justify-content-end">
                <button type="submit" name="btnadd" class="btn btn-primary btn-sm btn-md btn-lg me-2">Purchase</button>
                <button type="reset" class="btn btn-primary btn-md btn-sm btn-lg">Clear</button>
            </div>

       
                            
        </div>
            
        
      </div>
      <div class="col-md-8 col-xl-6 offset-xl-1 hide">
           
           <div class='rounded d-flex flex-column p-2' style='background-color: #f8f9fa; border: 1px solid black;'>
            <div class='p-2 me-3'>
              <h4>Product Purchase Detail</h4>
            </div>
            <div class='p-2 d-flex'>
              <div class='col-7'>PurchaseID</div>
             
              <div class='d-flex justify-content-start'> <?php echo $PurchaseID ?></div>
            </div>

            <div class='p-2 d-flex'>
              <div class='col-7'>Product Name</div>
             
              <div class='d-flex justify-content-start'><?php echo $ProductName ?></div>
            </div>

            <div class='p-2 d-flex'>
              <div class='col-7'>Name</div>
           
              <div class='d-flex justify-content-start'><?php echo $Date ?></div>
            </div>

            <div class='p-2 d-flex'>
              <div class='col-7'>Staff Name</div>
            
              <div class='d-flex justify-content-start'><?php echo $StaffName .' (' . $StaffRole .')' ?></div>
            </div>

            <div class='p-2 d-flex'>
            <div class='col-7'>Supplier Name</div>
            
            <div class='d-flex justify-content-start'><?php echo            $_SESSION['SupplierName']; ?></div>
          </div>

          <div class='p-2 d-flex'>
            <div class='col-7'>Price</div>
            
            <div class='d-flex justify-content-start'><?php echo $price ?></div>
          </div>

          <div class='p-2 d-flex'>
            <div class='col-7'>Quantity</div>
            
            <div class='d-flex justify-content-start'><?php echo $qty?></div>
          </div>

          <div class='p-2 d-flex'>
            <div class='col-7'>SubTotal</div>
            
            <div class='d-flex justify-content-start'><?php echo $subtotal ?></div>
          </div>

          <div class='p-2 d-flex'>
            <div class='col-7'>GOV Tax (5%)</div>
            
            <div class='d-flex justify-content-start'><?php echo $govtax ?></div>
          </div>

          <div class='p-2 d-flex'>
            <div class='col-7'><b>Final Price</b></div>
            
            <div class='d-flex justify-content-start'><b >K<?php echo $FinalTotal ?></b></div>
          </div>

          <div class='d-flex justify-content-end'>
              <button type='submit' name='btnSave' class='btn btn-primary btn-md btn-sm btn-lg me-2'>Comfirm</button>
              <button type='submit' name='btnCancel' class='btn btn-primary btn-md btn-sm btn-lg'>Cancel</button>
          </div>

      
                           
       </div>
    </div>

  </div>

</section>
</form>
</body>
</html>
<?php  
include('footer_login.php');
?>