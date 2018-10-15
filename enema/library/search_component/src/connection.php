<?php
//$conn = mysqli_connect("localhost", "root", "", "social");
$conn = mysqli_connect("111.118.215.253", "enemawwi_root", "shanuutkarsh123", "enemawwi_social");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}