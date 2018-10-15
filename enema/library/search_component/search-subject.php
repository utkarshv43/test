<?php
require '../../config/config.php';
include("../../includes/classes/User.php");
include("../../includes/classes/Post.php");
include("../../includes/classes/Message.php");
include("../../includes/classes/Notification.php");

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $userEmail = $_SESSION['log_email'];
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
<div class="top_bar">
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
<div class="panel panel-default" style="min-height: calc(100vh); background: #1d1f1ec4">
    <div class="panel panel-body" style="margin-top: 50px; background: #4b4d4c">
        <form class="navbar-form" role="search">
            <div class="col-md-6">

                <div class="col-md-offset-7">
                    <select style=" background: #4b4d4c; color: #fff" class="form-control" name="subject" id="dropdownMenu1" tabindex="1">
                        <?php
                        include('src/connection.php');

                        $sql = "SELECT DISTINCT subject FROM book";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo '<option value="'. $data['subject'] .'">' . $data['subject'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div style=" background: #4b4d4c; color:#fff" type="button" class="btn btn-default search-button col-md-2" id="search-button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>

            </div>
        </form>

    </div>
    <div class="container" id="result-viewer" style="visibility: hidden">

        <hgroup class="mb20">
            <h1>Search Results</h1>
            <h2 class="lead"><strong style="color: #3fbf9c;" id="result-count">-</strong> results were found for the search for <strong style="color: #3fbf9c;" id="search-text">--</strong></h2>
        </hgroup>

        <section class="col-xs-12 col-sm-6 col-md-12" id="result-section">

        </section>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/search-subject.js" type="text/javascript"></script>
</body>
</html>