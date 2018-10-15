<?php
include("../../config/ePortalConfig.php");
$email = $_REQUEST["email"];

$getStudent = "SELECT * FROM student_login WHERE stu_usn = '$email'";
$studentResult = mysqli_query($switchCon, $getStudent);

//echo json_encode();
if (mysqli_num_rows($studentResult) > 0) {
    $row = mysqli_fetch_assoc($studentResult);
    $_SESSION['student'] = $email;
    $_SESSION['stu_id'] = $row["stu_id"];
    $_SESSION['stu_dept'] = $row["stu_dept_code"];
    $_SESSION['stu_sem'] = $row["stu_sem_code"];
    $_SESSION['stu_section'] = $row["stu_section"];
    echo json_encode("student");

} else{
    $getFaculty = "SELECT * FROM faculty_login WHERE fac_username = '$email'";
    $facultyResult = mysqli_query($switchCon, $getFaculty);

    if (mysqli_num_rows($facultyResult) > 0) {
        $row = mysqli_fetch_assoc($facultyResult);
        $_SESSION['faculty']=$email;
        $_SESSION['fac_id']=$row["fac_id"];
        $_SESSION['fac_dept']=$row["fac_dept_code"];
        $_SESSION['dept']=$row["fac_dept_code"];
        echo json_encode("faculty");
    }
    else{
        $getAdmin = "SELECT * FROM admin WHERE admin_user = '$email'";
        $adminResult = mysqli_query($switchCon, $getAdmin);

        if (mysqli_num_rows($adminResult) > 0) {
            $row = mysqli_fetch_assoc($adminResult);
            $_SESSION['admin'] = $email;
            $_SESSION['admin_id'] = $row["admin_id"];
            echo json_encode("admin");
        }
        else{
            echo json_encode("error");
        }
    }
}

?>
