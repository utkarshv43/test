<?php
	session_start();
	ob_start();
	include 'dbconnect.php';
?>

<!DOCTYPE html>
<html> 
<head>
    <title>File Downloads</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.3/jquery.scrollTo.min.js"></script>
    <link href='css/bootstrap.css' rel='stylesheet'> 
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="eportal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

	<style>
		.logout{
			margin-right:3%;
		}
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
				  background-image: url(pics/home.jpg);
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php 
                                $query = "SELECT stu_name from student_login WHERE stu_id = " . $_SESSION['stu_id'];
                                $result = mysqli_query($conn, $query);
                                list($name) = mysqli_fetch_array($result);
                                echo "Hi, "; echo "<strong><font size = 3>"; echo $name; echo "</font></strong>";
                        ?>
                        
                    <span class="caret"></span>&nbsp;</a>
                    <ul class="dropdown-menu">
                    <li><a class = "text-center" href="mysHomed.php"><font color = "darkcyan">View Profile</font></a></li>
		            <li><a class="stu_mat text-center" data-toggle="modal" href="#myModal3"><font size="2px" color = "darkcyan">Change Password</font></a></li>
                    <li><a class = "text-center"><form method="POST"><input type="submit" value="Logout "style="color:white; background-color:darkcyan;border:2px solid black" name="Logout"/></form></a></li>		
                </ul>
                </li>
            </ul>
        </div>
    </nav>
    
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

    <script>
        $(window).load(function() {
            $(".se-pre-con").fadeOut(1500);;
        });
    </script>
	<br><br>
	<div class="row">
		<div class="container-fluid slide">
			<?php
				if(@$_GET['sub']!="") 
				{
					$subject = $_GET['sub'];
					$_SESSION['subject'] = $subject;
				}
				$subject = $_SESSION['subject'];
				$query = "SELECT file_id, file_name, file_course_code FROM file WHERE file_course_code = '$subject'";
				$result = mysqli_query($conn, $query) or die('Error, query failed');
				if(mysqli_num_rows($result)==0) 
				{
					echo "<br><br><br><p style=\"text-align:center\"><font color=\"darkcyan\" size=5px face = \"Comic sans MS\">Sorry mate, no contents uploaded for this subject!<br>Contact the concerned faculty to upload materials, or just come back later :)</font></p>";
					die();
				}
				echo "<form>";
				echo "<table class=\"table table-striped table-hover\" style=\"width:100%\">
					 <tr>
						<th>Course Code</th>
                        <th>File Name</th> 
                        <th></th> 
					 </tr>"; 
				while(list($id, $name, $sub) = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>"; echo $sub; echo "</td>";
                    echo "<td>"; echo $name; echo "</td>";
					?>
					<td><button class="btn-success" name="download" value="<?php echo $id; ?>" >Download</button></td>
					<?php
					echo "</tr>";
				}
 				echo "</table>";
				echo "</form>";
            ?>
		</div>
	</div>
</body>
</html>

<?php
	if(isset($_GET['download']))
	{
		$id = $_GET['download'];
		$query = "SELECT file_name, file_type, file_size, file_content FROM file WHERE file_id = '$id'";
		$result = mysqli_query($conn, $query) or die('Error retrieving files');
		list($name, $type, $size, $content) = mysqli_fetch_row($result);
		header("Content-type: $type");
		header("Content-Disposition: inline; filename=$name");
		header("Content-length: $size");
		ob_clean();
		flush();
		echo $content;
	}
?>
