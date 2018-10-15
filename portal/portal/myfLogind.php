<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
?>

<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Faculty Login</title> 
        <link href='css/bootstrap.css' rel='stylesheet'> 
        <link rel="stylesheet" type="text/css" href="eportal.css">
        <link rel="stylesheet" type="text/css" href="index.css">
		
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
		</style>
			
	</head>
	
    <body>
		<div class="se-pre-con"></div>
		<!--
        <div class="container-fluid">
			<div class="row">
				<div class='col-xs-12'>
					<div class="style"> 
						<div class='navbar navbar-inverse navbar-fixed-top'>
							<ul class="nav navbar-nav">
								<li><a class="btn navbar-btn" href="index.php">Go Back</a></li>
								<li class="titlenav"><strong><font size=6px>#E-Portal</font></strong></li>
								<li><a class="navbar-btn btn btn-success" href="index.php">HOME</a></li>
							</ul>	
						</div>
					</div>
				</div>
			</div>
		</div>
        -->
        
                
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
     
                </ul>
            </div>
        </nav>
	
        <div class="container-fluid bg-1 text-center"><br><br><br>
            <i class='glyphicon glyphicon-education slide'></i> 
            <h2 class="margin slide"><strong>Welcome, Faculty of RVCE!</strong></h2><br>
        </div>

        <div class="container-fluid bg-3 text-center slide">    
			<h3 class="margin"><strong>Login</strong></h3><hr><br>
            <div class="row slide">
				<form method="POST"> 	
                    <p>User Email: </p> 
					<div class="form-group dropsize slide">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input name="user" id="user" class="form-control" placeholder="Your Email" maxlength="40" required />
						</div>
					</div><br>
					
                    <p>Password:</p>
					<div class="form-group dropsize slide">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input type="password" name="pass" id="pass" class="form-control" placeholder="Your Password" maxlength="30" required />
						</div>
                    </div><br><hr>
					
					<p id="validate" style="text-align:center"></p>
              
					<div class="form-group">
						<input type="submit" value="Login" name="submit" class = "btn btn-lg btn-success"/> 
					</div>     
				</form>
            </div>
        </div>
		
        <footer class="container-fluid bg-4 text-center">
			<p><font size = "2">Developed by undergraduate students of CSE department.</font></p>
            <p><a href="http://www.rvce.edu.in/" target = "_blank"><font size=2px color="white">R.V. College of Engineering</font></a></p>
        </footer>
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.3/jquery.scrollTo.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>            
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script> 
		<script src='js/bootstrap.js'></script> 
        <script>
            $(window).load(function() {
                $(".se-pre-con").fadeOut(1500);;
            });
        </script> 
    </body> 
</html>

<?php
	// it will never let you open index(login) page if session is set
	if (@$_SESSION['faculty'] != "") 
	{
		header("Location: myfHomed.php");
		exit;
	} 
	 
	$error = false;
	 
	
    if( isset($_POST['submit']) ) 
	{	 	 
		// prevent sql injections/ clear user invalid inputs
		$user = trim($_POST['user']);
		$user = strip_tags($user);
		$user = htmlspecialchars($user);
		 
		// prevent sql injections / clear user invalid inputs
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
	  
		// if there's no error, continue to login
		if (!$error) 
		{
			$pass = md5($pass);
			$query = mysqli_query($conn, "SELECT fac_id, fac_dept_code FROM faculty_login WHERE fac_password='$pass' AND fac_username='$user'");
			$no_of_rows = mysqli_num_rows($query); 
		 
			if($no_of_rows==1) 
			{
				$row = mysqli_fetch_assoc($query);
				$_SESSION['faculty']=$user;
				$_SESSION['fac_id']=$row["fac_id"];
				$_SESSION['fac_dept']=$row["fac_dept_code"];
                $_SESSION['dept']=$row["fac_dept_code"];
				if (@$_SESSION['faculty'] != "") 
				{ 
					header("Location: myfHomed.php");
					exit;
				}
			}
			else 
			{
				echo "<script>
						document.getElementById(\"validate\").innerHTML = \"Invalid Credentials\";
					  </script>";
				die();
			}
			 
			//mysqli_close($conn);		 
		}
	}
	ob_end_flush(); 
?> 