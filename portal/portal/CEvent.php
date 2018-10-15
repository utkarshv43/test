<?php 
	session_start();
	include 'dbconnect.php';
	ob_start();
?>

<!DOCTYPE html>
<html> 
<head>
    <title>Circular and Events</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='css/bootstrap.css' rel='stylesheet'> 
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="eportal.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.3/jquery.scrollTo.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script> 
    <script src='js/bootstrap.js'></script> 
	<style>
        .heading{
            color: darkcyan;
            font: American Typewriter;
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
            <ul class="nav navbar-nav navbar-right"/>
        </div>
    </nav><br><br>
    
    <div class="container-fluid slide">
        <div class="row">
            <div class="col-xs-6">
                <h2 class="heading">CIRCULARS</h2>
                <?php
                    $query = "SELECT file_id, file_name FROM file WHERE file_category=1";
                    $result = mysqli_query($conn, $query) or die('Error, query failed');
                    if(mysqli_num_rows($result)==0) 
                    {
                        echo "<h3> No Circulars have been uploaded yet!</h3>";	
                    }
					else
					{
						echo "<form>";
						echo "<table class=\"table table-striped table-hover\" style=\"width:100%\">
								 <tr>
									<th>Name</th>
									<th></th> 
								 </tr>";
						while(list($id, $name) = mysqli_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>"; echo $name . " "; echo "</td>";
							?>
							<td><button class="btn-success" name="download" value="<?php echo $id; ?>" >Download</button></td>
						<?php
							echo "</tr>";
						}
						echo "</table>";
						echo "</form>";
					}
                ?>
            </div>
            
            <div class="col-xs-6">  
                <h2 class="heading">EVENTS</h2>
                <?php
				
                    $query = "SELECT file_id, file_name FROM file WHERE file_category=2";
                    $result = mysqli_query($conn, $query) or die('Error, query failed');
                    if(mysqli_num_rows($result)==0) 
                    {
                        echo "<h3> No Events have been uploaded yet!</h3>";	
					}
					else
					{
						echo "<form>";
						echo "<table class=\"table table-striped table-hover\" style=\"width:100%\">
								 <tr>
									<th>Name</th>
									<th></th> 
								 </tr>";
						while(list($id, $name) = mysqli_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>"; echo $name . " "; echo "</td>";
							?>
							<td><button class="btn-success" name="download" value="<?php echo $id; ?>" >Download</button></td>
							<?php
							echo "</tr>";
						}
						echo "</table>";
						echo "</form>";
					}
                ?>
            </div> 
        </div>
	</div>
    <script>
        $(window).load(function() {
                $(".se-pre-con").fadeOut(1500);;
        });
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
		header("Content-Disposition: attachment; filename=$name");
		header("Content-length: $size");
		ob_clean();
		flush();
		echo $content;
	}
?>
