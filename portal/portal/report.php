<?php
	ob_start();
	session_start();
	include 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reports</title>
        <link href='css/bootstrap.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="eportal.css">
		<style>
			  body {
				  font-family: American Typewriter;
				  line-height: 1.8;
				  color: #f5f6f7;
			  }
			  p {
				  font-size: 23px;
			  }
			  .margin {
				  margin-bottom: 30px;
				  font-size: 50px;
			  }
			  .margin1 {
					margin-bottom: 13px;
			  }
			  .bg-1 {
				  background-image: url(pics/home2.png);
				  background-size: cover;
				  color: #ffffff;
				  background-attachment: fixed;
				  background-position: center;
				  background-repeat: no-repeat;
			  }
			  .bg-2 {
				  background-color: #474e5d;
				  color: #ffffff;
			  }
			  .bg-3 {
				  background-color: #ffffff;
				  color: darkcyan;
				  padding-bottom: 10px;
			  }
			  .xxx{
					color: darkcyan;
			  }
			  .bg-4 {
				  padding-top: 0px;
				  padding-bottom: 2px;
				  background-color: darkcyan;
				  color: #fff;
			  }
			  .dropsize{
					width: 40%;
					margin-left: 30%;
					margin-right: 30%;
			  }
            h2, h3 {
                color:black;
            }
		</style>
    </head>

<body>
    <div class="se-pre-con"></div>
    <nav class="navbar navbar-inverse navbar-fixed-top">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-left" href="http://www.rvce.edu.in/" target = "_blank"><img src="pics/rv.JPG" class="img-circle" height=50 ondragstart="return false;" alt="logo"/></a>
          <a href="index.php" class="navbar-brand"><strong>#E-PORTAL</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class=""><a href="index.php">Home</a></li> 
			<li class=""><a href="report.php">Reports</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php 
                            $query = "SELECT admin_name from admin WHERE admin_id = " . $_SESSION['admin_id'];
                            $result = mysqli_query($conn, $query);
                            list($name) = mysqli_fetch_array($result);
                            echo "Welcome " .  "<strong><font size = 3>" . $name . "</font></strong>";
                    ?>

                <span class="caret"></span>&nbsp;</a>
                <ul class="dropdown-menu">
                    <li><a class = "text-center" href="myaHomed.php"><font color = "darkcyan">View Profile</font></a></li>
		            <li><a class="stu_mat text-center" data-toggle="modal" href="#myModal3"><font size="2px" color = "darkcyan">Change Password</font></a></li>
                    <li><a class = "text-center"><form method="POST"><input type="submit" value="Logout "style="color:white; background-color:darkcyan;border:2px solid black" name="Logout"/></form></a></li>		
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid bg-1 text-center"><br><br><br>
        <i class='glyphicon glyphicon-education slide'></i>
        <h1 class="margin slide"><strong>Reports</strong></h1><br>
    </div>
    
    <div id="myModal" class="modal fade bs-example text-center" style="margin-top:20%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Your Submission</h4>
                    </div>
					<form method="POST" enctype="multipart/form-data" action="uploadStudent.php" autocomplete="off">
						<div class="modal-body"> 						
                            <label class="custom-file-upload btn btn-lg btn-info slide" for="userfile">
                                <input type="file" name="userfile" id="userfile"/>Choose File
                            </label><br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" name="submit" id="submit" value="" class="btn btn-success">Upload</button>
						</div>
					</form><br>
                </div>
            </div>
        </div>   
	
	
	<div class="row">
        <div class="text-center">
            <h2 style="margin-top:3%">Select a Department:</h2>
            <h4 class="slide"><em>Generate a Report for each department</em></h4><hr><br>
			<form method="post">
			<select class="form-control col-md-6 slide dropsize" name="department" id="department" onkeyup="func()" onkeydown="func()">
                              <option value="">Select Department</option>
                              <option value="cse">Computer Science Engineering</option>
                              <option value="ece">Electronics and Communucations</option>
                              <option value="cv">Civil Enginering</option>
                              <option value="me">Mechanical Engineering</option>
                              <option value="is">Information Science</option>
                              <option value="eee">Electrical Engineering</option>
                              <option value="ch">Chemical Engineering</option>
			</select>     
                <input class="btn-md btn-success slide" name="dept" type="submit" id="dept" value=" Get Report " style="margin-top: 2%; margin-bottom:4%;"/>
                </form><br>
        </div>
	</div>
    
    <footer class="container-fluid bg-4 text-center">
        <p><font size = "2">Developed by undergraduate students of CSE department.</font></p>
        <p><a href="http://www.rvce.edu.in/" target = "_blank"><font size=2px color="white">R.V. College of Engineering</font></a></p>
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(window).load(function() {
            $(".se-pre-con").fadeOut(1500);;
        });
    </script>
    
</body>
</html>

<?php

	if(isset($_POST['department']))
	{
		$dept_code = $_POST['department'];
		$query = "SELECT fac_name, material_count, assignment_count FROM faculty_login WHERE fac_dept_code = '$dept_code'";
		//echo $query;
		$result = mysqli_query($conn, $query);
		$col = "Name" . "\t" . "Materials Added" . "\t" . "Assignments Given" . "\t";
		$data = '';
		while($row = mysqli_fetch_row($result))
		{
			$rowData = '';
			foreach ($row as $value)
			{
				$value = '"' . $value . '"' . "\t";
				$rowData .=$value;
			}
			$data .=trim($rowData) . "\n"; 
		}
		header("Content-type: application/octet-stream");  
		header("Content-Disposition: attachment; filename=Report.xls");  
		header("Pragma: no-cache");  
		header("Expires: 0");  
		ob_clean();
		flush();
		echo ucwords($col) . "\n" . $data . "\n"; 
	}

?>

<?php
	if(@$_SESSION['admin'] == "")
	{
		header("Location: index.php");
		exit;
	}
	if(isset($_POST['Logout']))
	{
		session_destroy();
		header("Location: index.php");
		exit;
	}
	ob_end_flush();
?>
