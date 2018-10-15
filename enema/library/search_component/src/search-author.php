<?php

include('connection.php');

$author = $_REQUEST["author"];
$search = $_REQUEST["search"];

if(empty($author)){
    echo json_encode("error");
}
else {
    if($search == ""){
        $getBooks = "SELECT * from book where author = '$author' ORDER BY average_rating DESC";
        $books_result = mysqli_query($conn, $getBooks);
        $bookList = array();
        if (mysqli_num_rows($books_result) > 0) {
            while ($row = $books_result->fetch_row()) {
                $bookList[] = $row;
            }
            echo json_encode($bookList);

        } else {
            echo json_encode("empty");
        }
    }else{
        $getBooks = "SELECT * from book where author = '$author' AND book_name LIKE '%$search%' ORDER BY average_rating DESC";
        $books_result = mysqli_query($conn, $getBooks);
        $bookList = array();
        if (mysqli_num_rows($books_result) > 0) {
            while ($row = $books_result->fetch_row()) {
                $bookList[] = $row;
            }
            echo json_encode($bookList);

        }else {
            echo json_encode("empty");
        }
    }


}
