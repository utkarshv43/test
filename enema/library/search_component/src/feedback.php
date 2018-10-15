<?php
session_start();
include('connection.php');

$stars = $_REQUEST["stars"];

if(empty($stars)){
    echo json_encode("error");
}
else
{

    $getBooks = "SELECT average_rating from book where book_id = '".$_SESSION['book_id']."'";
    $books_result = mysqli_query($conn, $getBooks);
    //echo json_encode();
    $bookList = array();
    if (mysqli_num_rows($books_result) > 0) {
        while ($row = $books_result->fetch_row()) {
            $bookList[] = $row;
        }
        $current = $bookList[0][0];
        if ($current == null){
            $newValue = $stars;
        }else{
            $newValue = ($stars + $current)/2;
        }

        $newUpate = "UPDATE book SET average_rating = $newValue where book_id = '".$_SESSION['book_id']."'";
        $update_result = mysqli_query($conn, $newUpate);
        if($update_result == 1){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }

    } else {
        echo json_encode("error");
    }

}