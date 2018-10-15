<?php
	session_start();
	include 'dbconnect.php';
	$allowed = array('jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf', 'xls', 'xlsm');
	if(isset($_POST['submit']))
	{
		if($_FILES['userfile']['size'] > 0)
		{	
			$fileName = $_FILES['userfile']['name'];
			$tmpName  = $_FILES['userfile']['tmp_name'];
			$fileSize = $_FILES['userfile']['size'];
			$fileType = $_FILES['userfile']['type'];
			
			$file_ext = explode(".", $fileName);
			$file_ext = strtolower(end($file_ext));
			
			if(in_array($file_ext, $allowed))
			{
				$fp = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
				if(!get_magic_quotes_gpc())
					$fileName = addslashes($fileName);
				
				$Category = $_POST['submit'];
				$TeacherID = $_SESSION['fac_id'];
				$upload_date = date("Y-m-d");
				$query = "INSERT INTO file (file_fac_id, file_name, file_size, file_type, file_content, file_category, file_date_upload) VALUES ('$TeacherID', '$fileName', '$fileSize', '$fileType', '$content', '$Category', '$upload_date')";

				mysqli_query($conn, $query) or die('Error, query failed'); 
				echo "<script type='text/javascript'>alert('File $fileName uploaded');</script>";
			}
			else
				echo "<script type='text/javascript'>alert('FileType Not Supported');</script>";
			
			mysqli_close($conn);
		}
		else
			echo "<script type='text/javascript'>alert('Please Choose a File to Upload');</script>";
		
		echo "<script>
			history.go(-1);
		</script>";
	} 
?> 
