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
        <title>Faculty Home</title>
        <link href='css/bootstrap.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="eportal.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
			  .xxx{
					color: darkcyan;
			  }
			  .bg-4 {
				  padding-top: 0px;
				  padding-bottom: 2px;
				  background-color: darkcyan;
				  color: #fff;
			  }
			  .bs-example{
                    margin-top: 10%;
              }
			  .dropsize{
					width: 40%;
					margin-left: 30%;
					margin-right: 30%;
			  }
		</style>
        
		<script>
			function sub_list(str)
			{
				if (str == "")
				{
					document.getElementById("sublist").innerHTML = "";
					return;
				}
				else
				{
					//alert(str);
					if (window.XMLHttpRequest)
					{
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					}
					else
					{
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200)
						{
							document.getElementById("sublist").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","FList.php?q="+str,true);
					xmlhttp.send();
				}
			}
		</script>
		
		<script>
			$(document).ready(function(){
				$(".abc").click(function() {
					var val = $(this).attr('value');
					$("#submit").val(val);
				});
			});
		</script>
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
                            $query = "SELECT fac_name from faculty_login WHERE fac_id = " . $_SESSION['fac_id'];
                            $result = mysqli_query($conn, $query);
                            list($name) = mysqli_fetch_array($result);
                            echo "Hi, " .  "<strong><font size = 3>" . $name . "</font></strong>";
                    ?>

                <span class="caret"></span>&nbsp;</a>
                <ul class="dropdown-menu">
                    <li><a class = "text-center" href="myfHomed.php"><font color = "darkcyan">View Profile</font></a></li>
		            <li><a class="stu_mat text-center" data-toggle="modal" href="#myModal3"><font size="2px" color = "darkcyan">Change Password</font></a></li>
                    <li><a class = "text-center"><form method="POST"><input type="submit" value="Logout "style="color:white; background-color:darkcyan;border:2px solid black" name="Logout"/></form></a></li>		
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid bg-1 text-center"><br><br><br><br>
        <i class='glyphicon glyphicon-education slide'></i>
        <h2 class="margin slide"><strong>Faculty Home</strong></h2><br>
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


    <ul class="nav nav-tabs nav-justified">
          <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
          <li><a data-toggle="tab" href="#upload">Upload Documents</a></li>
          <li><a data-toggle="tab" href="#groups">My Groups</a></li>
          <li><a data-toggle="tab" href="#delete">Delete Documents</a></li>
          <?php
            $query = "SELECT fac_circular_event_access FROM faculty_login WHERE fac_id = " . $_SESSION['fac_id'];
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            if($row[0]==1)
            {
                ?>
                     <li><a data-toggle="tab" href="#circular">Events and Circulars</a></li>
                <?php
            }
    ?>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <div class="container-fluid bg-3">
                    <h3 class="margin slide text-center"><strong>Profile Home</strong></h3><hr><br>
                        <div class="row slide">

                            <p class='text-center'><font size=3px>Here you can view all the information about you.</font></p><br>
                            <?php
                                $query = "SELECT fac_name, fac_position, fac_dept_code FROM faculty_login WHERE fac_id = " . $_SESSION['fac_id'];
                                $result = mysqli_query($conn, $query);
                                list($name, $pos, $dept) = mysqli_fetch_array($result);
                                echo "<div class=\"container-mid\">
                                        <table class=\"table slide\" style=\"width:100%\">
                                             <tr>

                                             </tr>";
                                echo "<tr>
                                        <td><font size = 6><strong> Name:</strong></font></td><td class=\"text-center\"><font size = 6>" . " " . $name . "</font></td></tr>";
                                echo "<tr>
                                        <td><font size = 6><strong> Position:</strong></font></td><td class=\"text-center\"><font size = 6>" . " " . $pos . "</font></td></tr>";
                                $query1 = "SELECT dept_name FROM department WHERE dept_code = '" . $dept . "'";
                                $result1 = mysqli_query($conn, $query1);
                                $dept = mysqli_fetch_row($result1)[0];
                                echo "<tr>
                                        <td><font size = 6><strong> Department:</strong></font></td><td class=\"text-center\"><font size = 6>" . " " . $dept . "</font></td></tr>";
                                echo "  </table>
                                    </div>";
                            ?>
                        </div>
            </div>
        </div>

        <div id="upload" class="tab-pane fade">
            <div class="container-fluid bg-3 text-center">
                <h3 class="margin slide"><strong>Upload documents</strong></h3><hr><br>
                <div class="row slide">
                    <p class="slide">Select Semester:</p>
                    <select class="form-control col-md-6 slide dropsize abc" name="semester" onclick="sub_list(this.value)" onkeyup="sub_list(this.value)" onkeydown="sub_list(this.value)" onchange="sub_list(this.value)">
                        <option value="">Select Semester</option>
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                        <option value="3">Third Semester</option>
                        <option value="4">Fourth Semester</option>
                        <option value="5">Fifth Semester</option>
                        <option value="6">Sixth Semester</option>
                        <option value="7">Seventh Semester</option>
                    </select><br><br>
                    <p><font size=3px>Select a semester and then pick the desired course</font></p><hr>
                    <div id="sublist"></div><br>
                    <p>To see information about syllabus <a href="infotable.php" target="_blank" class="btn btn-md btn-info">Click Here</a></p><br>
                </div>
            </div>
        </div>

        <div id="groups" class="tab-pane fade">
            <div class="container-fluid bg-3">
                    <div class="row slide">
                        <h3 class="margin slide text-center"><strong>My Groups</strong></h3><hr>
                        <p class='text-center'><font size=3px>Here you can view all the groups you are associated with.</font></p>
                            <br>
                            <?php 
                                $query = "SELECT g.grp_code, g.grp_name from groups g, faculty_section_groups fsg WHERE fsg.fsg_fac_username = '" . $_SESSION['faculty'] . "' AND g.grp_code = fsg.fsg_ss_code";

                                $result = mysqli_query($conn, $query);
                                echo "<div class=\"container-mid\">";
                                echo "<p class=\"slide text-center\"><strong>Class Groups</strong></p>";
                                echo "<table class=\"table table-striped table-hover\" style=\"width:100%\">
                                         <tr>
                                            <th>Group Names</th>
                                            <th> </th> 
                                         </tr>";
                                while(list($group_codes, $group_names) = mysqli_fetch_array($result))
                                {
                                    echo "<tr>";
                                    echo "<td>"; echo $group_names; echo "</td>";
                                    echo "<td><a href=\"faculty-group.php?grp_code=$group_codes\">Enter Group </a></td>";
                                    echo "</tr>";
                                }
                                echo "</table><hr>";                            
                                $query = "SELECT g.grp_code, g.grp_name from groups g, faculty_other_groups fog WHERE fog.fog_fac_username = '" . $_SESSION['faculty'] . "' AND g.grp_code = fog.fog_grp_code";
                                $result = mysqli_query($conn, $query);
                                if(mysqli_num_rows($result)!=0)
                                {
                                    echo "<p class=\"slide text-center\"><strong>Other Groups</strong></p>";
                                    echo "<table class=\"table table-striped table-hover\" style=\"width:100%\">
                                             <tr>
                                                <th>Group Names</th>
                                                <th> </th> 
                                             </tr>";
                                    while(list($group_codes, $group_names) = mysqli_fetch_array($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>"; echo $group_names; echo "</td>";
                                        echo "<td><a href=\"faculty-group.php?grp_code=$group_codes\">Enter Group </a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</table><hr>";
                                }
                                echo "</div>";
                            ?>
                        </div>
            </div>
        </div>
        <div id="delete" class="tab-pane fade">
                <div class="container-fluid bg-3 text-center">
                    <h3 class="margin slide"><strong>Delete Documents</strong></h3><hr><br>
                        <div class="row slide">
                            <a href="delete.php"><button class="btn-lg btn-danger slide" id="click" name="click" value="Delete">Delete Contents</button></a><br><br>
                            <p><font size=3px>Here you can view all the materials uploaded by members of faculty,<br> with the additional feature of deleting the ones uploaded by you</font></p>
                <br>
                        </div>
                </div>
        </div>

         <div id="circular" class="tab-pane fade">
                <?php
                    $query = "SELECT fac_circular_event_access FROM faculty_login WHERE fac_id = " . $_SESSION['fac_id'];
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($result);
                    if($row[0]==1)
                    {
                        ?>
                       <div class="container-fluid bg-3 text-center">
                        <h3 class="margin slide"><strong>Upload Extra Curriculars</strong></h3><hr><br>
                            <div class="container-fluid bg-3 text-center slide">

                            <div class="row slide">
                                <div class=col-xs-6>
                                    <h2 class="xxx">Upload Circulars</h2>
                                    <a class="btn btn-info btn-lg abc" data-toggle="modal" href="#myModal" value="1">Upload Circular</a><br><br>
                                </div>
                                <div class=col-xs-6>
                                    <h2 class="xxx">Upload Events</h2>
                                    <a class="btn btn-info btn-lg abc" data-toggle="modal" href="#myModal" value="2">Upload Event</a><br><br>		
                                </div>
                            </div><br><br>

                            <div class="container-fluid bg-3 text-center slide">
                                <div class="row slide">
                                    <div class=col-xs-6>
                                        <h2 class="xxx">Delete Circulars</h2>
                                        <a href="CircularDelete.php"><button class="btn-lg btn-danger slide"  name="click" value="Delete">Delete Circular</button></a>
                                    </div>
                                    <div class=col-xs-6>
                                        <h2 class="xxx">Delete Events</h2>
                                        <a href="EventDelete.php"><button class="btn-lg btn-danger slide"  name="click" value="Delete">Delete Event</button></a>
                                    </div>
                                </div>
                            </div><br><br>
                        </div>
                            <?php
                        }
                    ?>
                        </div>
            </div>
    </div>

    <div id="myModal" class="modal fade bs-example text-center">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Upload</h4>
                </div>
                <form method="POST" enctype="multipart/form-data" action="uploadCEvent.php">
                    <div class="modal-body"> 
                        <div class="form-group">
                            <label for="description" class="control-label"><font color="darkcyan">Description</font></label>
                            <textarea type="text" name="description" class="form-control" id="description"></textarea>
                        </div>

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
	if(@$_SESSION['faculty'] == "")
	{
		header("Location: myfLogind.php");
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