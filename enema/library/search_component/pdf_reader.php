<?php
session_start();
if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $userEmail = $_SESSION['log_email'];
    $file = 'assets/pdf/' . $_SESSION['url'];
    $filename = 'assets/pdf/'.$_SESSION['url'];
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
    header('Accept-Ranges: bytes');
    @readfile($file);
}
else {
    header("location: ../../register.php");
}
?>
