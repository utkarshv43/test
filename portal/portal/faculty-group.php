<?php
	ob_start();
	session_start();
	include 'dbconnect.php';
	
	if(@$_SESSION['faculty'] == "")
	{
		header("Location: index.php");
		exit;
	}
	if(isset($_GET['grp_code']))
		$_SESSION['grp_code'] = $_GET['grp_code'];
?>

<!DOCTYPE html> 
<html>
    <head>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your Group</title>
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
			  .disabled {
				  pointer-events: none;
				  cursor: default;
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
            .bs-example{
                    margin-top: 10%;
                }
            .well{
                color: black;
            }
		</style>

		<script>
			function validatePassword() {
				var current_pw,new_pw,confirm_pw;

				current_pw = document.frmChange.current_pw;
				new_pw = document.frmChange.new_pw;
				confirm_pw = document.frmChange.confirm_pw;
				//alert(new_pw.value);
				//alert(confirm_pw.value);

				if(new_pw.value != confirm_pw.value) {
					//new_pw.value="";
					//confirm_pw.value="";
					alert("Passwords Dont Match");
					return false;
				} 	
				return true;
			}
		</script>
    </head>

<body>
	
<script>
    $(document).ready(function(){
        $(".abc").click(function() {
            var val = $(this).attr('value');
            $("#submit").val(val);
        });
    });
</script>

<script>
    function del(id)
    {
        if (confirm("Confirm?") == true) {
            location.assign("DelFacAssignment.php?id="+id);
        } 
        else {
            die();
        }
    }
</script>

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
                        echo "Welcome " .  "<strong><font size = 3>" . $name . "</font></strong>";
                    ?>
                    <span class="caret"></span>&nbsp;
                </a>
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

<?php
    $group_code = $_SESSION['grp_code'];
    $query = "SELECT grp_name FROM groups WHERE grp_code = '$group_code'";
    $result = mysqli_query($conn, $query);
    $name = mysqli_fetch_row($result)[0];
?>

    <div id="myModal3" class="modal fade bs-example text-center" style="margin-top:20%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Password Settings</h4>
                    </div>
					<form name="frmChange" method="POST" onsubmit="return validatePassword()">
						<div class="modal-body"> 						
								<input type="password" name="current_pw" id="current_pw" class="form-control" placeholder="Current Password" maxlength="100" required />
								<input type="password" name="new_pw" id="new_pw" class="form-control" placeholder="New Password" maxlength="100" required />
								<input type="password" name="confirm_pw" id="confirm_pw" class="form-control" placeholder="Confirm Password" maxlength="100" required />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" name="submit3" id="submit3" class="btn btn-success">Change</button>
						</div>
					</form><br>
                </div>
            </div>
    </div>   

<div class="container-fluid bg-1 text-center"><br><br><br>
    <font size=50><i class='glyphicon glyphicon-globe slide'></i></font>
    <h2 class="margin slide"><strong><?php echo $name; ?></strong></h2><br>
</div>

<ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#ass">Assignments</a></li>
    <li><a data-toggle="tab" href="#ann">Announcements</a></li>
    <li><a data-toggle="tab" href="#mat">Materials</a></li>
</ul>

<div id="myModal" class="modal fade bs-example text-center">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Upload</h4>
            </div>
            <form method="POST" enctype="multipart/form-data" action="uploadFaculty.php" autocomplete="off">
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

<div class="tab-content">
    <div id="ass" class="tab-pane fade in active">
        <div class="container-fluid bg-3 text-center">
            <h3 class="margin slide"><strong>Assignments</strong></h3>
            <p><font size=3px>Here you can view all the assignments assigned to your group.</font></p>
            <div class="row slide">
                <a class="btn btn-info abc" data-toggle="modal" href="#myModal" value="0">+Add Assignment</a><br><br>
                <table class="table table-hovered table-striped">
                    <tr>
                        <th class="text-center">Date of Upload</th>
                        <th class="text-center">Uploaded by</th>
                        <th class="text-center">Assignment name</th>
                        <th></th>
                    </tr>
                    <?php
                        include 'dbconnect.php';
                        $grp_code = $_SESSION['grp_code'];
                        $query = "SELECT gf_id, gf_description, gf_date_upload, gf_fac_id FROM group_files WHERE gf_grp_code = '$grp_code' AND gf_category=0";
                        $result = mysqli_query($conn, $query);
                        while(list($id, $description, $date, $faculty_id) = mysqli_fetch_array($result))
                        {
                            $query1 = "SELECT fac_name FROM faculty_login WHERE fac_id='$faculty_id'";
                            $result1 = mysqli_query($conn, $query1);
                            list($faculty_name) = mysqli_fetch_array($result1);

                            echo "<tr><td>" . $date . "</td> ";
                            echo "<td>" . $faculty_name . "</td> ";
                            echo "<td>" . $description . "</td> ";
                            ?>
                            <td>
                                <a class="btn btn-primary" href="submission.php?gf_id=<?php echo $id;?>">View Submissions</a>&nbsp;&nbsp;
                                <?php
                                    if($faculty_id == $_SESSION['fac_id'])
                                    {
                                        ?>
                                        <button class="btn-danger btn-md" id= <?php echo $id; ?> onclick="del(this.id)">Delete Assignment</button>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-danger disabled">Delete Assignment</a>
                                        <?php
                                    }
                            echo "</td></tr>";
                        }
                    ?>
                </table><br>
            </div>
        </div>
    </div>

    <div id="ann" class="tab-pane fade">
        <div class="container-fluid bg-3 text-center">
            <h3 class="margin slide text-center"><strong>Announcements</strong></h3>
            <p class="text-center"><font size=3px>Here you can see all the announcements.</font></p>
            <div class="row slide">
                <a class="btn btn-info abc text-center" data-toggle="modal" href="#myModal" value="1">+Add Announcement</a><br><br>
                <table class="table table-hovered table-striped">
                    <tr>
                        <th class="text-center">Announcements</th>
                    </tr>
                </table>
                    <?php
                        include 'dbconnect.php';
                        $query = "SELECT gf_id, gf_description, gf_date_upload, gf_fac_id FROM group_files WHERE gf_grp_code = '$grp_code' AND gf_category=1";
                        $result = mysqli_query($conn, $query);
                        while(list($id, $description, $date, $faculty_id) = mysqli_fetch_array($result))
                        {
                            $query1 = "SELECT fac_name FROM faculty_login WHERE fac_id='" . $faculty_id . "'";
                            $result1 = mysqli_query($conn, $query1);
                            list($faculty_name) = mysqli_fetch_array($result1);  
                            echo "<br><div class=\"well\"><strong><h3 class=\"xxx\">" . $date . "</strong> by <strong>" . $faculty_name . "</strong></h3><br>" . $description . "<br><br>";                                    

                            if($faculty_id == $_SESSION['fac_id'])
                            {
                                ?>
                                <button class="btn-danger btn-md" id= <?php echo $id; ?> onclick="del(this.id)">Delete Announcement</button></div><br>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a class="btn btn-danger disabled">Delete Announcement</a></div><br>
                                <?php
                            }
                        }
                    ?>
            </div>
        </div>
    </div>

    <div id="mat" class="tab-pane fade">
        <div class="container-fluid bg-3 text-center">
            <h3 class="margin slide text-center"><strong>Materials</strong></h3>
            <p><font size=3px>Here you can view all the private materials your group is associated with.</font></p>
            <div class="row slide">
                <a class="btn btn-info abc" data-toggle="modal" href="#myModal" value="2">+Add Material</a><br><br>
                <table class="table table-hovered table-striped">
                    <tr>
                        <th class="text-center">Date of Upload</th>
                        <th class="text-center">Uploaded by</th>
                        <th class="text-center">Material name</th>
                        <th></th>
                    </tr>
                    <?php
                        include 'dbconnect.php';
                        $query = "SELECT gf_id, gf_file_name, gf_description, gf_date_upload, gf_fac_id FROM group_files WHERE gf_grp_code = '$grp_code' AND (gf_category=2 OR gf_category=3)";
                        $result = mysqli_query($conn, $query);
                        while(list($id, $name, $description, $date, $faculty_id) = mysqli_fetch_array($result))
                        {
                            $query1 = "SELECT fac_name FROM faculty_login WHERE fac_id='" . $faculty_id . "'";
                            $result1 = mysqli_query($conn, $query1);
                            list($faculty_name) = mysqli_fetch_array($result1);

                            echo"<form>";
                            echo "<tr><td>" . $date . "</td> ";
                            echo "<td>" . $faculty_name . "</td> ";
                            echo "<td>" . $description . "</td> ";
                            ?>
                            <form><td><button class="btn btn-success" name="download" value="<?php echo $id; ?>">Download file</button></form>&nbsp;&nbsp;
                            <?php
                                if($faculty_id == $_SESSION['fac_id'])
                                    {
                                        ?>
                                        <button class="btn-danger btn-md" id= <?php echo $id; ?> onclick="del(this.id)">Delete Material</button>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-danger disabled">Delete Material</a>
                                        <?php
                                    }
                            echo "</td></tr>";
                        }
                    ?>
                </table><br>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid bg-4 text-center">
    <p><font size = "2">Developed by undergraduate students of CSE department.</font></p>
    <p><a href="http://www.rvce.edu.in/" target = "_blank"><font size=2px color="white">R.V. College of Engineering</font></a></p>
</footer>

<script>
    $(window).load(function() {
        $(".se-pre-con").fadeOut(1500);;
    });
</script>
</body>
</html>

<?php
	if(isset($_POST['submit3']))
	{
		$query = "SELECT fac_password FROM faculty_login WHERE fac_id = '" . $_SESSION['fac_id'] . "'";
		$result = mysqli_query($conn, $query) or die();
		list($password) = mysqli_fetch_row($result);
		if(md5($_POST['current_pw']) == $password)
			mysqli_query($conn, "UPDATE faculty_login set fac_password = '". md5($_POST['new_pw']) . "' WHERE fac_id = '" . $_SESSION['fac_id'] . "'");
		else
			echo "<script>alert(\"Incorrect Password\")</script>";
	}

	if(isset($_POST['Logout']))
	{
		session_destroy();
		header("Location: index.php");
		exit;
	}
    
    if(isset($_GET['download']))
	{
		$id = $_GET['download'];
		$query = "SELECT gf_file_name, gf_file_type, gf_file_size, gf_file_content FROM group_files WHERE gf_id = '$id'";
		$result = mysqli_query($conn, $query) or die('Error retrieving files');
		list($name, $type, $size, $content) = mysqli_fetch_row($result);
		header("Content-type: $type");
		header("Content-Disposition: inline; filename=$name");
		header("Content-length: $size");
		ob_clean();
		flush();
		echo $content;
	}

	ob_end_flush();
?>
