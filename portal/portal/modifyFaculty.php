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
        <title>Modify Faculty</title>
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
				  background-image: url(pics/home1.jpg);
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
                            $query = "SELECT admin_name from admin WHERE admin_id = " . $_SESSION['admin_id'];
                            $result = mysqli_query($conn, $query);
                            list($name) = mysqli_fetch_array($result);
                            echo "Hi, " .  "<strong><font size = 3>" . $name . "</font></strong>";
                    ?>

                <span class="caret"></span>&nbsp;</a>
                <ul class="dropdown-menu">
                    <li><a href="#home"><font color = "darkcyan">Profile</font></a></li>
                    <li><a class = ""><form method="POST"><input type="submit" value="Logout "style="color:white; background-color:darkcyan;border:2px solid black" name="Logout"/></form></a></li>
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    

    <div class="container-fluid bg-1 text-center"><br><br><br>
        <i class='glyphicon glyphicon-education slide'></i>
        <h2 class="margin slide"><strong>Administrator Home</strong></h2><br>
    </div>
    
    <div class="container-fluid bg-3">
        <h3 class="margin slide text-center"><strong>Modify Faculty</strong></h3><hr><br>
        
        <form class="form-horizontal" method="POST">
                
              <div class="form-group">
                <label class="control-label col-sm-2" for="usn">Enter Faculty's username:</label>
                <div class="col-sm-10">
                  <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                </div>
              </div>
            
              <div class="form-group">
                <label class="control-label col-sm-2" for="field">Enter Field to change:</label>
                <div class="col-sm-10">
                  <select name="field">
                      <option value="fac_username">Username</option>
                      <option value="fac_name">Name</option>
                      <option value="fac_position">Position</option>
                      <option value="fac_password">Password</option>
                      <option value="fac_circular_event_access">Circular access</option>
                      <option value="fac_dept_code">Department</option>
                      <option value="fog_grp_code">Other Groups</option>
                      <option value="fsg_ss_code">Section Groups</option>
                      <option value="fac_active">Active</option>
                      
                  </select>

                </div>
              </div>
            
             <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Submit" name="submit" class = "btn btn-lg btn-success"> 
                </div>
              </div>
            
        </form>
             
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


    if(isset($_POST['Logout']))
        {
            session_destroy();
            header("Location: index.php");
            exit;
        }

    if (isset($_POST['submit']))
    {
    //    if (isset($_POST["taskOption"]))
    //    {
    //      $user = $_POST["taskOption"];
    //      echo $user;
    //      echo " is your username";
    //    } 
    //    else 
    //    {
    //      $user = null;
    //      echo "no username supplied";
    //    }


          $_SESSION['modify_field'] = $_POST["field"];
          $_SESSION['username'] = $_POST["username"];   

          echo $_SESSION['modify_field'];
    //      echo $_SESSION['usn'];

          header("Location: modifyAttrFaculty.php");
}

?>