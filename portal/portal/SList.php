<?php
	session_start();
	include 'dbconnect.php';
	
	$semester = $_GET['q'];
	$query = "SELECT c.course_name, c.course_code FROM course c, dept_sem_course d WHERE d.dsc_course_code=c.course_code AND d.dsc_stu_dept_code = '" . $_SESSION['stu_dept'] . "' AND d.dsc_sem_code = " . $semester;     
	$result = mysqli_query($conn, $query) or die("Error");
	if(mysqli_num_rows($result)==0)
	{
		echo "No subject for this semester!";
		die();
	}
	echo "<ul>";
	while(list($course_name,$course_code) = mysqli_fetch_array($result))
	{
		?>
			<li><?php echo $course_name;?>&nbsp;&nbsp;<a class="btn btn-success" href="download.php?sub=<?php echo $course_code;?>" >Download</a></li><hr>
		<?php
	}
	echo "</ul>";
?>
	 