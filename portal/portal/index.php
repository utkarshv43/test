<!DOCTYPE html>
<html lang="en">
<head>
	<title>Aranyaka - RVCE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="eportal.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
		}
	  .bg-4 {
		  padding-top: 0px;
		  padding-bottom: 2px;
		  background-color: darkcyan;
		  color: #fff;
		}
        #video-background {
            /*  making the video fullscreen  */
              position: fixed;
              right: 0; 
              bottom: 0;
              min-width: 100%; 
              min-height: 100%;
              width: auto; 
              height: auto;
              z-index: -100;
            }
	</style>
</head>

<body>
	<div class="se-pre-con"></div>
	<div class="container-fluid text-center ">
        <br>
		<h2 class="margin slide"><strong>Aranyaka</strong></h2>
		<img src="pics/rv.JPG" class="img-responsive img-circle margin1 slide" style="display:inline" alt="Bird" width="150" height="150">
		<h3 class="slide"><strong>R.V. College of Engineering, Bangalore</strong></h3>
        <video autoplay loop id="video-background" muted plays-inline preload="none" poster="pics/poster.jpg">
            <source src="https://player.vimeo.com/external/158148793.hd.mp4?s=8e8741dbee251d5c35a759718d4b0976fbf38b6f&profile_id=119&oauth2_token_id=57447761" type="video/mp4">
        </video>
	</div>

	<div class="container bg-3 text-center slide">
        <br><br>
		<h3 class="margin"><strong>Enter the E-Portal</strong></h3><hr><br>
		<div class="row slide">
			<div class="col-sm-6">
				<p>I'm a member of<strong> Faculty</strong> in <strong>RVCE, Bangalore</strong></p>
				<a href="myfLogind.php" class="btn btn-lg btn-success" role="button">Faculty Login</a>
				<a href="admin-login.php" class="btn btn-lg btn-danger" role="button" style="margin-left: 3%;">Admin Login</a>
                <br><br><hr>
			</div>
			<div class="col-sm-6">
                <p>I'm a <strong>Student</strong> of <strong>RVCE, Bangalore</strong></p>
				<a href="mysLogind.php" class="btn btn-lg btn-primary" role="button">Student Login</a>
                <br><br><hr>
			</div>
		</div>
        <br><br>
	</div>

   <div class="container bg-3 text-center slide">
        <h3 class="margin"><strong>Events and Circulars</strong></h3><hr><br>
        <div class="row slide">
            <a href="CEvent.php"><button class="btn-lg btn-success slide" id="click" name="click" value="View">View</button></a>
            <br><br><br>
        </div>
    </div>
	<br><br>

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
