<?php
session_start();

unset($_SESSION['CustomerID']);
echo "<script>window.alert('Success : Logout')</script>";
echo "<script>window.location='CustomerLogin.php'</script>";

?>