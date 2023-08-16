<?php  
session_start();  
include('connect.php');

$OrderID=$_REQUEST['OrderID'];

$update="UPDATE orders SET status='Approved' 
		 WHERE OrderID='$OrderID'";
$ret=mysqli_query($conn,$update);

if($ret)
{
	echo "<script>window.alert('Order Approved.')</script>";
	echo "<script>window.location='OrderSearch.php'</script>";
}
else
{
	echo "<p>Something went wrong in Order Aprroved :" . mysqli_error($conn) . "</p>";
}

?>