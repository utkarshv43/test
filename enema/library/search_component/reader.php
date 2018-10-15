<?php
require '../../config/config.php';
include("../../includes/classes/User.php");
include("../../includes/classes/Post.php");
include("../../includes/classes/Message.php");
include("../../includes/classes/Notification.php");

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $userEmail = $_SESSION['log_email'];
    $_SESSION['url'] = $_GET['book'];
    $_SESSION['book_id'] = $_GET['id'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("location: ../../register.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/search.css" type="text/css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../../assets/js/enema.js"></script>
</head>
<body>
<div class="top_bar" style="position: relative">
    <div class="logo">
        <a href="../../index.php">EnEmafeed!</a>
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



        <a href="<?php echo("../../" . $userLoggedIn); ?>">
            <?php echo $user['first_name']; ?>
        </a>
        <a href="../../index.php"><i class="fas fa-home"></i></a>
        <a href="../../settings.php"><i class="fas fa-cog"></i></a>
        <a href="../../includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </nav>

    <div class="dropdown_data_window" style="height: 0px" border: none;></div>
    <input type="hidden" id="dropdown_data_type" value="">
</div>
<div class="container" style="z-index: 3">
    <div style="position:absolute; height: 100vh; width: 83%; background: white;opacity:0.1;z-index: 999;"></div>
    <iframe id="readerFrame" style="width: 100%; height: 100vh" src="pdf_reader.php#page=<?php echo $_GET['page']?>"></iframe>
</div>
<div class="btn btn-default col-md-offset-11 col-md-1 pull-right" id="feedback_button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></div>
<div class="feedback-form" style="display: none;z-index: 999 !important;">
    <div class="container" style="padding: 0">
        <div class="row" style="padding: 0; margin-top: -10px">
            <h5>Provide Your FeedBack Here</h5>
        </div>
        <div class="row lead">
            <div id="stars" class="starrr"></div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/starPlugin.js" type="text/javascript"></script>
<script src="js/feedback.js" type="text/javascript"></script>

</body>
</html>