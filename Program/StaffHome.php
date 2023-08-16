<?php  
session_start();
include('S_Header.php');
?>
<html>
<head>
	<title>Welcome : <?php echo $_SESSION['StaffName'] ?> | Home</title>

	<style type="text/css" media="screen">
		ul a {
			color: #0099ff;
			text-decoration: underline;
		}
		p a {
			color: #0099ff;
			text-decoration: underline;
		}
	</style>
</head>
<body>
<form>
	<br><br><br><br>
<p><h3>Welcome : <?php echo $_SESSION['StaffName'] ?> </h3></p><br><br>
<h4>Manage all the form </h4><br><br>

<ul>
<a href="Brand.php">Manage Brand</a></ul>

<ul>
<a href="Category_Entry.php">Manage Category</a></ul>

<ul>
<a href="Product_Entry.php">Manage Product</a></ul>

<ul><a href="Supplier.php">Supplier Register</a></ul>
<ul><a href="Product_Purchase.php">Product Purchase</a></ul>

<ul>
<a href="purchasereport.php">Purchase Reporting</a></ul>
<br><br><br><br><br><br>

</form>
<div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
            <div class="col-lg-12">
                <h5 class="mb-3"><a href="ProductDisplay.php" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>
            </div>
              <div class="col-md-2 col-lg-2 col-xl-2">
              <a href="Brand.php">Manage Brand</a>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2">
              <a href="Brand.php">Manage Brand</a>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2">
              <a href="Brand.php">Manage Brand</a>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2  ">
            
              <a href="Brand.php">Manage Brand</a>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2 my-3 ">
               <a href="Brand.php">Manage Brand</a>
              </div>
</body>
</html>
<?php  
include('footer_login.php');
?>