<?php
echo $Id = $_GET['ID'];
$con=mysqli_connect('localhost','root','','umeshmedico');
mysqli_query($con , " DELETE FROM tbluser WHERE Id = $Id ");
header("location:users.php");
?>