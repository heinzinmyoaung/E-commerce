<?php 
include('connect.php');

$BrandID=$_REQUEST['BrandID'];

$delete="DELETE FROM brand WHERE BrandID='$BrandID'";
$ret=mysqli_query($conn,$delete);

if($ret) 
{
	echo "<script>window.alert('Brand Successfully Deleted.')</script>";
	echo "<script>window.location='BrandRegister.php'</script>";
}
else
{
	echo "<p>Something went wrong in Brand_Delete : " . mysql_error($conn) . "</p>";
}
?>