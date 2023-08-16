<?php 
 
// Load the database configuration file
session_start(); 
include('connect.php');
 
// $OrderID=$_SESSION['OrderID'];


// Fetch records from database 
// $_SESSION['From']=$From;
if(isset($_SESSION['OrderID'])){
    $OrderID=$_SESSION['OrderID'];

    $Squery="SELECT o.*, c.CustomerID,c.CustomerName 
    FROM orders o,customer c 
    WHERE o.OrderID='$OrderID'
    AND o.CustomerID=c.CustomerID";
unset ($_SESSION["OrderID"]);
}
elseif(isset($_SESSION['From']))
{
    $From=$_SESSION['From'];
$To =$_SESSION['To'];
    $Squery="SELECT o.*, c.CustomerID,c.CustomerName 
				FROM orders o,customer c 
				WHERE o.OrderDate BETWEEN '$From' AND '$To'
				AND o.CustomerID=c.CustomerID";

        unset ($_SESSION["From"]);
        unset ($_SESSION["To"]);
}

elseif(!isset($_SESSION['OrderID'],$_SESSION['From']))
{
    $Squery="SELECT o.*, c.CustomerID,c.CustomerName 
			FROM orders o,customer c 
			WHERE o.CustomerID=c.CustomerID";
}
else{}



$result=mysqli_query($conn, $Squery);
$count=mysqli_num_rows($result);


if($count > 0){ 
    $delimiter = ","; 
    $filename = "order" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('OrderID', 'OrderDate', 'Customer Name', 'Total Amount', 'Total Quantity', 'Status',); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row=mysqli_fetch_array($result)){ 
        // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['OrderID'], $row['OrderDate'], $row['CustomerName'], $row['TotalAmount'], $row['TotalQuantity'], $row['Status']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 





 
?>
