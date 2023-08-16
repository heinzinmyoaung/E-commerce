<?php
    if(isset($_POST['btnupdate'])){
        $a = $_POST['txtproductname'];

        echo $a;
    }
?>

<!DOCTYPE html>
<html>
<head>
<style>
#panel, .flip {
  font-size: 16px;
  padding: 10px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
  border: solid 1px #a6d8a8;
  margin: auto;
}

#panel {
  display: none;
}
</style>
</head>
<body>
    <form action="b.php" method="post">

<p class="flip" onclick="myFunction()">Click to show panel</p>

<div id="panel">
<input type="text" value="a" name="txtproductname" class="form-control" id="cl" autocomplete="off" required>

</div>
<button type='submit' name='btnupdate' class='btn btn-primary btn-md btn-sm btn-lg me-2'>update</button>


<script>
function myFunction() {
  document.getElementById("panel").style.display = "block";
  document.getElementById("cl").value = "";
}
</script>
</form>
</body>
</html>


