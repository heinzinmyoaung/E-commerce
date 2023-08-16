<?php 
include('connect.php');

$CategoryID=$_REQUEST['CategoryID'];

$delete="DELETE FROM category WHERE CategoryID='$CategoryID'";
$ret=mysqli_query($conn,$delete);

if($ret) 
{
	echo "<script>window.alert('Category Successfully Deleted.')</script>";
	echo "<script>window.location='CategoryRegister.php'</script>";
}
else
{
	echo "<p>Something went wrong in CategoryDelete : " . mysql_error($conn) . "</p>";
}
?>