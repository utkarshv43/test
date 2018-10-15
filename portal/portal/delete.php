<?php
    session_start();
	ob_start();
    include 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="eportal.css">
	<link rel="stylesheet" type="text/css" href="index.css">

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
                                echo "Hi, "; echo "<strong><font size = 3>"; echo $name; echo "</font></strong>";
                        ?>
                        
                    <span class="caret"></span>&nbsp;</a>
                    <ul class="dropdown-menu">
                        <li><a href="#home"><font color = "darkcyan">Profile</font></a></li>
                        <li><a class = ""><form method="POST"><input type="submit" value="Logout " style="color:white; background-color:darkcyan;border:2px solid black" name="Logout"/></form></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.3/jquery.scrollTo.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

	<script>
		$(window).load(function() {
			$(".se-pre-con").fadeOut(1500);;
		});
	</script>
    <br><br>
    <div class="container-fluid slide">
        <div class="row">
            <?php
                $Tid = $_SESSION['fac_id'];
                $query = "SELECT file_id, file_course_code, file_name FROM file WHERE file_fac_id = '$Tid' AND file_category=0";
                $result = mysqli_query($conn, $query) or die('Error, query failed');

                if(mysqli_num_rows($result)==0) 
                {
					echo "<p style=\"text-align:center\"><font color=\"darkcyan\" size=5px face = \"Comic sans MS\">Sir/Ma'am, no course material has been uploaded by you!</font></p>";
                    die();
                }
				
                echo "<table class=\"table table-striped table-hover\" style=\"width:100%\">
                         <tr>
                            <th>Course Code</th>
                            <th>File Name</th> 
                            <th></th>
                            <th></th>
                         </tr>";
                while(list($id, $sub, $name) = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>"; echo $sub; echo "</td>";
                    echo "<td>"; echo $name; echo "</td>";
                    ?>
                    <form><td><button class="btn-success" name="download" value="<?php echo $id; ?>" >View</button></td></form>
                    <td><button class="btn-danger" id= <?php echo $id; ?> onclick="del(this.id)">Delete</button></td>
                <?php
                    echo "</tr>";
                }
                ?>
                <?php 
                echo "</table>";
            ?>
        </div>
	</div>

	<script>
		function del(id)
		{
			if (confirm("Confirm") == true) {
				location.assign("DeleteFile.php?id="+id);
			} 
			else {
				die();
			}
		}
	</script>
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