<?php

include('connection.php');

$subject = $_REQUEST["subject"];
$search = $_REQUEST["search"];

if(empty($subject) or empty($search)){
    echo json_encode("error");
}
else
{
            $getBooks = "SELECT b.book_id,book_name,subject,author,description,average_rating,c.chapter_id,c.sub_topic,c.page_number,thumbnail_url,book_url from book as b JOIN chapter as c on b.book_id = c.book_id where b.subject = '$subject' AND c.sub_topic LIKE '%$search%' ORDER BY average_rating DESC";
            $books_result = mysqli_query($conn, $getBooks);
            //echo json_encode();
            if (mysqli_num_rows($books_result) > 0) {
                $book_data = mysqli_fetch_all($books_result);
                echo json_encode($book_data);

            } else {
                echo json_encode("empty");
            }

}
