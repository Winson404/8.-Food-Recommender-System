
<?php 
	session_start();
	$conn = mysqli_connect("localhost","root","","prototype");
	if(!$conn) {
		exit();
	}
?>