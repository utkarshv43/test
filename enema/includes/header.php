<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $userEmail = $_SESSION['log_email'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
     header("location: register.php");
}
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Welcome to EnEma</title>
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/enema.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
    <script src="assets/js/jcrop_bits.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
    <link rel="shortcut icon" type="image/jpeg" href="assets/images/icons/favicon.jpeg"/>
</head>
<body>
    
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">EnEmafeed!</a>
        </div>

        <div class="search">
            <form action="search.php" method="GET" name="search_form">
                <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search...." autocomplete="off" id="search_text_input">
                <div class="button_holder">
                    <img src="assets/images/icons/search.jpg">
                </div>
            </form>

            <div class="search_results">
            </div>
            <div class="search_results_footer_empty">
            </div>


        </div>




        <nav>
            <?php
                //Unread messages
                $messages = new Message($con, $userLoggedIn);
                $num_messages = $messages->getUnreadNumber();

                //Unread notification
                $notifications = new Notification($con, $userLoggedIn);
                $num_notifications = $notifications->getUnreadNumber();

                //Unread messages
                $user_obj = new User($con, $userLoggedIn);
                $num_requests = $user_obj->getNumberOfFriendRequests();
            ?>



            <a href="<?php echo $userLoggedIn; ?>">
                <?php echo $user['first_name']; ?>
            </a>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
                <i class="fas fa-envelope"></i> Message
                <?php
                    if($num_messages > 0)
                    echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
                ?>
            </a>
            <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
                <i class="fas fa-bell"></i> Notifications
            <?php
                if($num_notifications > 0)
                echo '<span class="notification_badge" id="unread_notifications">' . $num_notifications . '</span>';
            ?>
            </a>
            <a href="requests.php"><i class="fas fa-users"></i> Requests
            <?php
                if($num_requests > 0)
                echo '<span class="notification_badge" id="unread_requests">' . $num_requests . '</span>';
            ?>
            </a>
            <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            <a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </nav>

        <div class="dropdown_data_window" style="height: 0px" border: none;></div>
        <input type="hidden" id="dropdown_data_type" value="">
    </div>

    <script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing posts
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

                var pageName; //Holds name of page to send ajax request to
                var type = $('#dropdown_data_type').val();

                if(type == 'notification')
                    pageName = "ajax_load_notifications.php";
                else if(type = 'message')
                    pageName = "ajax_load_messages.php";

				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage
						$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage

						$('.dropdown_data_window').append(response);
					}
				});

			} //End if

			return false;

		}); //End (window).scroll(function())


	});

	</script>

    
    <div class="wrapper">
    
    

