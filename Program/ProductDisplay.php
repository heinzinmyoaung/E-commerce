<?php
 session_start();
    include('header.php');
   
	include('connect.php');
if(!isset($_SESSION['CustomerID'])){
    echo "<script>window.alert('Firstly You Must Login')</script>";
    echo "<script>window.location='CustomerLogin.php'</script>";
    exit();
}


$CustomerID=$_SESSION['CustomerID'];
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
        a {
            text-decoration: none;
            color: inherit;
        }
        a:hover {
            text-decoration: none;
            color: inherit;
        }
       
    </style>
</head>
<body>
    <form action="">
    <div class="container ">
    <div class="row d-flex justify-content-center">
    <?php  
	

	$query="SELECT * FROM product ORDER BY ProductID DESC";
	$ret=mysqli_query($conn,$query);
	$count=mysqli_num_rows($ret);
	if($count < 1) 
	{
		echo "<p>No Product Found.</p>";
		exit();
	}

for($a=0;$a<$count;$a+=4) 
{ 
	$query1="SELECT * FROM product 
			 ORDER BY ProductID DESC
			 LIMIT $a,4";
	$ret1=mysqli_query($conn,$query1);
	$count1=mysqli_num_rows($ret1);

	echo "<tr>";
	for($b=0;$b<$count1;$b++) 
	{ 
		$arr=mysqli_fetch_array($ret);
		$ProductID=$arr['ProductID'];
		$ProductName=$arr['ProductName'];
		$Price=$arr['Price'];
		$Image1=$arr['FrontImage'];
        $Quantity=$arr['Quantity'];
		
		$Price=$arr['Price'];
?>
        <!-- <div class="card-group"> -->
        
        
            <div class="card col-8 col-sm-4 col-md-3 col-lg-3 col-xl-2 m-3" >
            <a href="ProductDetail.php?ProductID=<?php echo $ProductID?>">
                <div style="background: #fff; class="h-50">
                <img src="<?php echo $Image1 ?>" class="card-img-top img-fluid" alt="..." >
                </div>
                
                <div class="card-body">
                    <h6 style="margin-bottom: 14px;"><?php echo $ProductName?></h6>
                    <lable class="card-text text-warning" style="font-size: 20px;">K<?php echo $Price?></lable>
                    <p class="" style="margin-bottom: 8px;">Stock: <?php echo $Quantity?></p>
                </div>  
                    
                </a>
            </div>
            
        
        <?php
    }
}
?>
    </div>
    </div>
    </form>

</body>
</html>
<br>
<br>
<br>

<?php
    include ('footer.php');
?>