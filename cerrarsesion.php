<?php
session_start();

if(isset($_SESSION['valida'])){
	session_destroy();
echo "<script>window.location.href=\"login\";</script>";
}


 ?>