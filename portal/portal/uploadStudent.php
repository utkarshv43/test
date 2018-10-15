<?php
	session_start();
	include 'dbconnect.php';
	$allowed = array('jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf', 'xls', 'xlsm', 'ppt', 'pptx');
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
						
				$StudentID = $_SESSION['stu_id'];
				$upload_date = date("Y-m-d");
				$as_num = $_POST['submit'];
				$grp_code = $_SESSION['grp_code'];

				$query = "INSERT INTO assignments (as_file_name, as_file_size, as_file_type, as_file_content, as_num, as_stu_id, as_grp_code, as_date_upload) VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$as_num', '$StudentID', '$grp_code', '$upload_date')";
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