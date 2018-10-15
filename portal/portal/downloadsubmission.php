<?php
    ob_start();
    include 'dbconnect.php';
	if(isset($_POST['download']))
	{
		$id = $_POST['download'];
		//echo "hi " . $id;
		$query = "SELECT as_file_name, as_file_size, as_file_type, as_file_content FROM assignments WHERE as_id = '$id'";
		$result = mysqli_query($conn, $query) or die('Error retrieving files');
		list($name, $type, $size, $content) = mysqli_fetch_row($result);
		header("Content-type: $type");
		header("Content-Disposition: inline; filename=$name");
		header("Content-length: $size");
		ob_clean();
		flush();
		echo $content;
        
        echo "<script>
            history.go(-1);
            </scirpt>";
	}
?>