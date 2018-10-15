<?php
	session_start();
	include 'dbconnect.php';	
?>

<!DOCTYPE html>
<html>
<head>
	<title>File Uploads</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
        </div>
      </div>
    </nav>
    
    <div class="container-fluid bg-1 text-center"><br><br><br><br>
		<i class='glyphicon glyphicon-education slide'></i> 
        <h2 class="margin slide"><strong>Upload Home</strong></h2><br>
    </div>
    
        
    <div class="container-fluid bg-3 text-center slide">    
        <h3 class="margin"><strong>Upload document</strong></h3>
        <?php
            	if(isset($_GET['sub']))
		            $_SESSION['fac_course_code'] = $_GET['sub'];
                
                $query = "SELECT course_name FROM course WHERE course_code = '" . $_SESSION['fac_course_code'] . "'";
                $result = mysqli_query($conn, $query);
                list($course_name) = mysqli_fetch_array($result);
                echo "<h3> Course Name: <strong>"; echo $course_name; echo"</strong></h3>";
        ?>
        <hr><br>
        <div class="row slide">
            <p class="slide">Choose file to be uploaded!</p>
			<form method="POST" enctype="multipart/form-data" action="uploadFile.php"> 
                <label class="custom-file-upload btn btn-lg btn-info slide" for="userfile">
                    <input type="file" name="userfile" id="userfile"/>Choose File
                </label><br><br>
                <p class="slide">Now hit Upload to upload your document</p>
                <input class="btn-lg btn-success slide" name="upload" type="submit" id="upload" value=" Upload "/>
            </form><br><br>
            <p><font size=3px><strong> Thank you for uploading materials to help us students!</strong></font></p><br><hr>         
        </div> 
    </div>
        
    
        
	<footer class="container-fluid bg-4 text-center">
        <p><font size = "2">Developed by undergraduate students of CSE department.</font></p>
		<p><a href="http://www.rvce.edu.in/" target = "_blank"><font size=2px color="white">R.V. College of Engineering</font></a></p> 
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.3/jquery.scrollTo.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

    <script>
        $(window).load(function() {
            $(".se-pre-con").fadeOut(1500);;
        });
    </script>                
</body>
</html>
	
<?php

	if(isset($_GET['sub']))
		$_SESSION['fac_course_code'] = $_GET['sub'];
	
	if(isset($_POST['Logout']))
	{
		session_destroy();
		header("Location: index.php");
		exit;
	}
?> 


