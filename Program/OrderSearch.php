
<?php  

session_start(); 

include('S_Header.php');
include('connect.php');


if(isset($_POST['btnSearch'])) 
{
	$SearchType=$_POST['rdosearch'];

	if($SearchType==="1") 
	{

unset ($_SESSION["From"]);
unset ($_SESSION["To"]);
		$OrderID=$_POST['cboOrderID'];
        $_SESSION['OrderID']=$OrderID;

		$Squery="SELECT o.*, c.CustomerID,c.CustomerName 
				FROM orders o,customer c 
				WHERE o.OrderID='$OrderID'
				AND o.CustomerID=c.CustomerID";
	}
	elseif($SearchType==="2") 
	{
unset ($_SESSION["OrderID"]);
		$From=date('Y-m-d',strtotime($_POST['txtfrom']));
		$To=date('Y-m-d',strtotime($_POST['txtto']));

        $_SESSION['From']=$From;
        $_SESSION['To']=$To;

		$Squery="SELECT o.*, c.CustomerID,c.CustomerName 
				FROM orders o,customer c 
				WHERE o.OrderDate BETWEEN '$From' AND '$To'
				AND o.CustomerID=c.CustomerID";
	}
}
elseif(isset($_POST['btnShowAll'])) 
{
    unset ($_SESSION["OrderID"]);
unset ($_SESSION["From"]);
unset ($_SESSION["To"]);
	$Squery="SELECT o.*, c.CustomerID,c.CustomerName 
			FROM orders o,customer c 
			WHERE o.CustomerID=c.CustomerID";
}
else
{
	$TodayDate=date('Y-m-d');

	$Squery="SELECT o.*, c.CustomerID,c.CustomerName 
			FROM orders o,customer c 
			WHERE o.OrderDate='$TodayDate'
			AND o.CustomerID=c.CustomerID";
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css">
    <script type="text/javascript" src="DatePicker/datepicker.js"></script>

</head>
<body>
<script>
  	$(document).ready( function () {
		$('#example').DataTable();
	} );
</script>

    <div class="container col-10 col-sm-6 col-lg-6">
        <div class="border rounded mt-5 bg-light">
        <div class="text-center">
            <h2 class="text-capitalize my-5 text-lg">Order Search</h2>
        </div>
        <form action="OrderSearch.php" method="POST" class="mx-3">

        <div class="row mb-3">
            <div class="col-lg-4 col-12 mb-3">
            <input type="radio" name="rdosearch" value="1" checked/>Search by ID: <br/>
            </div>
            <div class="col-lg-8 col-12">
                <select name="cboOrderID">
                <option>Choose OrderID</option>
                    <?php 
                    $query="SELECT o.*,c.CustomerID,c.CustomerName 
                            FROM orders o, customer c
                            WHERE o.CustomerID=c.CustomerID";
                    $ret=mysqli_query($conn, $query);
                    $count=mysqli_num_rows($ret);

                    for($i=0;$i<$count;$i++) 
                    { 
                        $arr=mysqli_fetch_array($ret);

                        $OrderID=$arr['OrderID'];
                        $CustomerName=$arr['CustomerName'];

                        echo "<option value='$OrderID'>" . $OrderID . ' - ' . $CustomerName . "</option>";
                    }
                    ?>
                </select>
            </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                <input type="radio" name="rdosearch" value="2"/>Search by Date:<br/>
                </div>
                
                <div class=" row col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                        
                        <label for="" style="width:50px">From :</label>
                        <input type="text" style="width: 120px" name="txtfrom" value="<?php echo date('Y-m-d') ?>" onFocus="showCalender(calender,this)" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                    <label for="" style="width:50px"> To :</label>
                    <input type="text" style="width: 120px" name="txtto" value="<?php echo date('Y-m-d') ?>" onFocus="showCalender(calender,this)"/>
                </div>
                </div>
            
            </div>


            <div class='d-flex justify-content-end mb-3'>
              <button type='submit' name='btnSearch' class='btn btn-primary btn-sm  me-2'>Search</button>
              <button type='submit' name='btnShowAll' class='btn btn-primary btn-sm  me-2'>Show All</button>
            </div>


        
     

        </div>
    </div>
    <?php  
        $result=mysqli_query($conn, $Squery);
        $count=mysqli_num_rows($result);
                    
     

        if($count==0) 
        {
            echo " <p>No Order Result Found.</p>";
            include('footer_login.php');
            exit();
        }
    ?>
<div class="container">
    
    <div class="row mt-3">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                    <th>OrderID</th>
                    <th>OrderDate</th>
                    <th>CustomerName</th>
                    <th>TotalAmount</th>
                    <th>TotalQuantity</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        for ($i=0;$i<$count;$i++) 
                        { 
                            $arr=mysqli_fetch_array($result);
                            

                            $OrderID=$arr['OrderID'];
                            $OrderDate=$arr['OrderDate'];
                            $CustomerName=$arr['CustomerName'];
                            $TotalAmount=$arr['TotalAmount'];
                            $TotalQuantity=$arr['TotalQuantity'];
                            $Status=$arr['Status'];

                            echo "<tr>";
                                echo "<td>$OrderID</td>";
                                echo "<td>$OrderDate</td>";
                                echo "<td>$CustomerName</td>";
                                echo "<td>$TotalAmount</td>";
                                echo "<td>$TotalQuantity</td>";
                                echo "<td>$Status</td>";
                                if ($arr['Status'] == "Pending") {

                                echo "<td> 
                                        
                                        <a href='OrderAccept.php?OrderID=$OrderID' class='btn btn-primary mb-2'>Accept</a> 
                                        <a href='OrderCancel.php?OrderID=$OrderID' class='btn btn-danger mb-2'>Cancel</a> 
                                </td>";
                                }elseif ($arr['Status'] == "Canceled"){
                                    echo "<td> 
                                    
                                        <p class='text-danger'>Canceled</> 
                                </td>";

                                }else {
                                    echo "<td> 
                                    
                                        <p class='text-success'>Accepted</> 
                                </td>";
                                }
                            echo "</tr>";	
                        }
                    ?>
                    
                </tbody>
             <button></button>
            </table>
              
        </div>
        <div class='d-flex justify-content-center mb-4'>
              
              <a href="Csv.php" class='btn btn-success  btn-md me-2'  >Eport to CSV</a>
  
          </div>
        </form>
          
    </div>
</div>
   
   
</body>
</html>

<?php
include('footer_login.php');
?>