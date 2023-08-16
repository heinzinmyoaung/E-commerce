<?php
session_start();

unset($_SESSION['StaffName']);

echo "<script>window.alert('Success : Logout')</script>";
echo "<script>window.location='StaffLogin.php'</script>";

?>
