<?php 
/* Developer: Ehtesham Mehmood Site: PHPCodify.com Script: Import Excel to MySQL using PHP and Bootstrap File: import.php */ 
// Including database connections 
require_once 'dbconnect.php';

if(isset($_POST["submit"]))
{
	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	$c = 0;
	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
		//print_r($filesop);die;
		$stu_name = $filesop[0];  
		$stu_usn = $filesop[1];
		$stu_password = md5($filesop[2]);
		$stu_dept_code = $filesop[3];
		$stu_sem_code = $filesop[4];
		$stu_section = $filesop[5];
		$stu_active = $filesop[6];
		//echo "INSERT INTO student_login(stu_name, stu_usn, stu_password, stu_dept_code, stu_sem_code, stu_section, stu_active) VALUES ('$stu_name', '$stu_usn', '$stu_password', '$stu_dept_code', '$stu_sem_code', '$stu_section', '$stu_active')";die;
		
		//echo "INSERT INTO `student_login` (`stu_name`, `stu_usn`, `stu_password`, `stu_dept_code`, `stu_sem_code`, `stu_section`, `stu_active`) VALUES ('qwwefhnfgn', 'wegfjgfjhgjqwe', 'qew', 'cv', '5', 'wqeqwe', '127')";die;
		//echo "INSERT INTO `student_login` (`stu_name`, `stu_usn`, `stu_password`, `stu_dept_code`, `stu_sem_code`, `stu_section`, `stu_active`) VALUES ('qwwefhnfgn', 'wegfjgfjhgjqwe', 'qew', 'cv', '5', 'wqeqwe', '127')";die;
		
		$sql = mysqli_query($conn,"INSERT INTO `student_login` (`stu_name`, `stu_usn`, `stu_password`, `stu_dept_code`, `stu_sem_code`, `stu_section`, `stu_active`) VALUES ('$stu_name', '$stu_usn', '$stu_password', '$stu_dept_code', '$stu_sem_code', '$stu_section', '$stu_active')");
		

		if($sql)
			echo "You database has imported successfully";
		else
			echo "Sorry! There is some problem.";
	}
}