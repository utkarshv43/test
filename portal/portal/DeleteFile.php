<?php
	include 'dbconnect.php';
	session_start();
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$query = "DELETE FROM file WHERE file_id = '$id'";
		mysqli_query($conn, $query) or die("Failed to Delete!");
		$query = "UPDATE faculty_login SET material_count=material_count-1 WHERE fac_id = " . $_SESSION['fac_id'];
		mysqli_query($conn, $query);
	}
?>
<script>
	history.go(-1);
</script>