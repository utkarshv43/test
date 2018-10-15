<?php

include('connection.php');

$subject = $_REQUEST["subject"];

if(empty($subject)){
    echo json_encode("error");
}
else {
    $getBooks = "SELECT * from book where subject = '$subject' ORDER BY average_rating DESC";
    $books_result = mysqli_query($conn, $getBooks);
    //echo json_encode();
    $bookList = array();
    if (mysqli_num_rows($books_result) > 0) {
        while ($row = $books_result->fetch_row()) {
            $bookList[] = $row;
        }
        echo json_encode($bookList);

    } else {
        echo json_encode("empty");
    }



}
