<?php 
include("includes/header.php");
 


if(isset($_POST['post'])){
    
	$uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/images/posts/";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
				//image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}

	if($uploadOk) {
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], 'none', $imageName);
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}

}


 ?>     
	<div class="user_details column" style="position: fixed; z-index: 1;">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>

	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
			<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>

		</form>

		<div class="posts_area"></div>
		<img id="#loading" src="assets/images/icons/loading.gif">


	</div>
	<div class="user_details column" style="position: fixed; margin-top: 170px; z-index: 1;">
		<h4 style="
            background-color: #0a9891;
            margin-top: 0px;
            font-size: 20px;
            text-align: center;
            color: #fff;
            height: 30px;
        ">Smart Library</h4>
        <div class="library">
        	<a href="" id="ePortalSwitch" name="ePortalSwitch">E-Portal</a>
        	<hr>
        	<a href="library/search_component/search.php">Search By Topic</a>
        	<hr>
        	<a href="library/search_component/search-author.php">Search By Author</a>
        	<hr>
        	<a href="library/search_component/search-subject.php">Search Books</a>
        </div>
	</div>

    <div class="user_details column" style="margin-top: 445px; position: fixed; height: 250px; overflow: scroll; z-index: 1;">

		<h4 style="
            background-color: #0a9891;
            margin-top: 0px;
            font-size: 20px;
            text-align: center;
            color: #fff;
            height: 30px;
        ">Popular Words</h4>

		
			<?php 
			echo "<div class='trends' id='scroll_words'>";
			$query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");

			foreach ($query as $row) {
				
				$word = $row['title'];
				$word_dot = strlen($word) >= 14 ? "..." : "";

				$trimmed_word = str_split($word, 14);
				$trimmed_word = $trimmed_word[0];

				echo "<div style'padding: 1px'>";
				echo $trimmed_word . $word_dot;
				echo "<br></div><br>";


			}


			?>
		</div>


	</div>
</div>

	<script>
            var div = document.getElementById("scroll_words");
            div.scrollTop = div.scrollHeight;
    </script>
	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';
	var userEmail = '<?php echo $userEmail; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())

		//when e portal is clicked
		$("#ePortalSwitch").on('click',function () {
			$.ajax({
				type: 'post',
				url: 'includes/handlers/ePortalSwitch.php',
				dataType: 'json',
				data: {'email':userEmail},
				success: function(response) {
					if(response == "error"){
						alert("You Do Not Have an E-Portal Profile");
					}else if(response == "student"){
						window.location.href = "http://localhost/dashboard/portal/portal/mysHomed.php";
					}else if(response == "faculty"){
						window.location.href = "http://localhost/dashboard/portal/portal/myfHomed.php";
					}else if(response == "admin"){
						window.location.href = "http://localhost/dashboard/portal/portal/myaHomed.php";
					}

				},
				error: function (error) {
					console.log("Error : " + error);
				}
			});
		});


	});

	</script>




	</div>
</body>
</html>