<?php 
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
		$fac_name = $filesop[0];  
		$fac_username = $filesop[1];
		$fac_password = md5($filesop[2]);
		$fac_dept_code = $filesop[3];
		$fac_position = $filesop[4];
		$material_count = $filesop[5];
		$assignment_count = $filesop[6];
		$fac_circular_event_access = $filesop[7];
		$fac_active = $filesop[8];
		//echo "INSERT INTO student_login(stu_name, stu_usn, stu_password, stu_dept_code, stu_sem_code, stu_section, stu_active) VALUES ('$stu_name', '$stu_usn', '$stu_password', '$stu_dept_code', '$stu_sem_code', '$stu_section', '$stu_active')";die;
		
		//echo "INSERT INTO `student_login` (`stu_name`, `stu_usn`, `stu_password`, `stu_dept_code`, `stu_sem_code`, `stu_section`, `stu_active`) VALUES ('qwwefhnfgn', 'wegfjgfjhgjqwe', 'qew', 'cv', '5', 'wqeqwe', '127')";die;
		//echo "INSERT INTO `student_login` (`stu_name`, `stu_usn`, `stu_password`, `stu_dept_code`, `stu_sem_code`, `stu_section`, `stu_active`) VALUES ('qwwefhnfgn', 'wegfjgfjhgjqwe', 'qew', 'cv', '5', 'wqeqwe', '127')";die;
		
		$sql = mysqli_query($conn,"INSERT INTO `faculty_login` (`fac_name`, `fac_username`, `fac_password`, `fac_dept_code`, `fac_position`, `material_count`, `assignment_count`, `fac_circular_event_access`) VALUES ('$fac_name', '$fac_username', '$fac_password', '$fac_dept_code', '$fac_position', '$material_count', '$assignment_count', '$fac_circular_event_access')");

		if($sql)
			echo "You database has imported successfully";
		else
			echo "Sorry! There is some problem.";
	}
}