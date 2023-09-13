<?php 

	session_start();
	$conn = mysqli_connect("localhost","root","","brod-revised");
	if(!$conn) {
		exit();
	}
	
?>