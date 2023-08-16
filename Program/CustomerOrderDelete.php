<?php
	include('connect.php');
    $OrderID = $_REQUEST['orderdetail'];

if($_REQUEST['orderdetail']){
    
             $update="UPDATE orders SET status='Canceled' 
             WHERE OrderID='$OrderID'";

    $ret=mysqli_query($conn,$update);

    if($ret){
    echo "<script>window.alert('Order Cancel Completed')</script>";
    echo "<script>window.location='ProductDisplay.php'</script>";
    }else {
    echo "<p>Something went wrong : " . mysqli_error($conn) . "</p>";
    }

}else{
    echo "<script>window.alert('Error to order Cancel')</script>";
    echo "<script>window.location='ProductDisplay.php'</script>";
    echo "<p>Something went wrong : " . mysqli_error($conn) . "</p>";
}
?>