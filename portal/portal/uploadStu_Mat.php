<?php
	session_start();
	include 'dbconnect.php';
	$allowed = array('jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf', 'xls', 'xlsm', 'ppt', 'pptx');
	if(isset($_POST['submit2']))
	{
		if($_FILES['userfile2']['size'] > 0)
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
				$grp_code = $_SESSION['grp_code'];
				$description = $_POST['description'];
				
				$query = "INSERT INTO group_files (gf_file_name, gf_file_size, gf_file_type, gf_file_content, gf_category, gf_description, gf_fac_id, gf_grp_code, gf_date_upload) VALUES ('$fileName', '$fileSize', '$fileType', '$content', 3, '$description', '$StudentID', '$grp_code', '$upload_date')";
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