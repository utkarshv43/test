<?php
	session_start();
	include 'dbconnect.php';
	$allowed = array('jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf', 'xls', 'xlsm', 'ppt', 'pptx', 'xlsx');
	if(isset($_POST['submit']))	
	{
		if($_FILES['userfile']['size'] > 0 or $_POST['submit']==1)
		{	
			$fileName = NULL;
			$fileSize = NULL;
			$fileType = NULL;
			$content = NULL;
			
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				
				$file_ext = explode(".", $fileName);
				$file_ext = strtolower(end($file_ext));
					
			if(in_array($file_ext, $allowed) or $_POST['submit']==1)
			{
				if($fileName!="")
				{
					$fp = fopen($tmpName, 'r');
					$content = fread($fp, filesize($tmpName));
					$content = addslashes($content);
					fclose($fp);
					if(!get_magic_quotes_gpc())
						$fileName = addslashes($fileName);
				}
						
				$grp_code = $_SESSION['grp_code'];
				$TeacherID = $_SESSION['fac_id'];
				$upload_date = date("Y-m-d");
				$description = $_POST['description'];
				$category = $_POST['submit'];

				$query = "INSERT INTO group_files (gf_file_name, gf_file_size, gf_file_type, gf_file_content, gf_category, gf_description, gf_fac_id, gf_grp_code, gf_date_upload) VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$category', '$description', '$TeacherID', '$grp_code', '$upload_date')";
				mysqli_query($conn, $query) or die('Error, query failed'); 
				echo "<script type='text/javascript'>alert('File $fileName uploaded');</script>";
				
				$query = "UPDATE faculty_login SET assignment_count = assignment_count+1 WHERE fac_id = " . $_SESSION['fac_id'];
				mysqli_query($conn, $query);
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