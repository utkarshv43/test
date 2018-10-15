<?php
	ob_start();
	session_start();
	include 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Syllabus</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='css/bootstrap.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="eportal.css">
        <link rel="stylesheet" type="text/css" href="index.css">
		
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <script src='js/bootstrap.js'></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
		
		<style>
			.logout{
				margin-right:3%;
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
        </nav>
        <br>
        <br>
        <div class='row'>
            <div class="container-fluid">
                <h1>SYLLABUS INFORMATION</h1><hr>
                    <p><strong>The course names and course codes organised on the basis of semester and just for your department!</strong></p> 
                    <br>
                    <table class="table table-hover table-bordered slide">
                        <thead>
                            <tr>
                                <th>Course codes</th>
                                <th>Course title</th>  
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT course_code, course_name FROM course WHERE course_dept_code = '" . $_SESSION['fac_dept'] . "'";
                            $result = mysqli_query($conn, $query) or die('Error, query failed');
                            if(mysqli_num_rows($result)==0) 
                            {
                                echo "<p style=\"text-align:center\"><font color=\"darkcyan\" size=5px face = \"Comic sans MS\">Your college has no courses LOL</font></p>";
                                die();
                            }
                            while(list($code, $name) = mysqli_fetch_array($result))
                            {
                                echo "<tr>";
                                    echo "<td>"; echo $code; echo "</td>";
                                    echo "<td>"; echo $name; echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        ?>              
                        </tbody>
                    </table>
            </div>
            <div class='style1'>
			</div>
        </div>			

    <script>
        $(window).load(function() {
            $(".se-pre-con").fadeOut(1500);;
        });
    </script>

    </body>
</html>
