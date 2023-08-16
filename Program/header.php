
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Feane </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<!--owl slider stylesheet -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<!-- nice select  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
<!-- font awesome style -->
<link href="css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="./fontawesome-free-6.1.2-web/css/all.min.css">
<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Custom styles for this template -->
<link href="./m_css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="./m_css/responsive.css" rel="stylesheet" />

<style>
      <style>
        .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount, #lblCartCount1 {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
}
    </style>
</style>
</head>

<body>

       <!-- header section strats -->
    <header class="header_section" style="background: #222831;">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="ProductDisplay.php">
            <span>
              Alie
            </span>
          </a>

          <div class="hid user_option">
            
          <a href="ShoppingCart.php" class="user_link">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class='badge badge-warning' id='lblCartCount1'> 

                <?php if (isset($_SESSION['cart'])) { ?> 
                 <?php $b =sizeof($_SESSION['cart']);
                 echo"
                 
                  <script>
                        document.getElementById('lblCartCount1').innerHTML = $b;
                 </script>";?>
              <?php }  
              else { ?> 
                 <?php 
                 echo"
                 
                  <script>
                        document.getElementById('lblCartCount1').innerHTML = 0;
                 </script>";?>
              <?php } ?> 
               
         </span>
              </a>
</div>


          <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="" aria-expanded="false"> </span>
          </button> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="" aria-expanded="false"> </span>
          </button>

 
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item ">
                <a class="nav-link" href="ProductDisplay.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="CustomerOrder.php">Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Contact.php">Contact</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="book.html">Book Table</a>
              </li> -->
            </ul>
            <div class="user_option">
             

              <a href="ShoppingCart.php" class="user_link">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class='badge badge-warning' id='lblCartCount'> 

                <?php if (isset($_SESSION['cart'])) { ?> 
                 <?php $a =sizeof($_SESSION['cart']);
                 echo"
                 
                  <script>
                        document.getElementById('lblCartCount').innerHTML = $a;
                 </script>";?>
              <?php }  
              else { ?> 
                 <?php 
                 echo"
                 
                  <script>
                        document.getElementById('lblCartCount').innerHTML = 0;
                 </script>";?>
              <?php } ?> 
               
         </span>
              </a>
                
                
           
              <a href="CustomerLogout.php" class="order_online">
                Logout
              </a>
            </div>
              </div>
          </div>
        </nav>
      </div>
    </header>
 
<br >
<br >
<br>
    <!-- end header section -->
   

  <!-- footer section -->
  <!-- footer section -->



</body>

</html>