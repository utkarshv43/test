<?php
	include 'dbconnect.php';
	$id = $_GET['id'];
	$query = "UPDATE assignments SET as_verify = 1 WHERE as_id = '$id'";
	mysqli_query($conn, $query);
?>