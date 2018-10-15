<?php
    $fileName1 = $_FILES["thumbnail"]["name"]; // The file name
    $fileTmpLoc1 = $_FILES["thumbnail"]["tmp_name"]; // File in the PHP tmp folder

    $fileName2 = $_FILES["book_url"]["name"]; // The file name
    $fileTmpLoc2 = $_FILES["book_url"]["tmp_name"]; // File in the PHP tmp folder

    if (!$fileTmpLoc1) { // if file not chosen
        echo "error";
    }
    else if (!$fileTmpLoc2) { // if file not chosen
        echo "error";
    }
    else if(move_uploaded_file($fileTmpLoc1, "../assets/thumbnail/$fileName1")){

        if(move_uploaded_file($fileTmpLoc2, "../assets/pdf/$fileName2")){

            include('connection.php');

            $bookName = $_POST['book-name'];
            $subject = $_POST['subject'];
            $author = $_POST['author'];
            $description = $_POST['description'];

            $getBooks = "INSERT INTO book VALUES (null,'$bookName','$subject','$author','$description',null,'$fileName1','$fileName2')";
            $books_result = mysqli_query($conn, $getBooks);
            if($books_result){
                $book_id = "SELECT book_id FROM book WHERE book_name = '$bookName' AND subject = '$subject' AND author = '$author'";

                $book_id_result = mysqli_query($conn, $book_id);

                if(mysqli_num_rows($book_id_result) > 0){
                    $book_id_data = mysqli_fetch_all($book_id_result);
                    $id = $book_id_data[0][0];
                    $status = 1;
                    for($x = 0; $x < $_POST['listLength'];$x++){
                        $chapter = $_POST['chapter'.$x];
                        $subTopic = $_POST['sub-topic'.$x];
                        $pages = $_POST['pages'.$x];
                        $chapters = "INSERT INTO chapter VALUES ($id,$chapter,'$subTopic',$pages)";
                        $chapters_result = mysqli_query($conn, $chapters);
                        if($chapters_result){
                            $status = 1;
                        }else{
                            $status = 0;
                            break;
                        }
                    }

                    if($status){
                        echo json_encode("success");
                    }else{
                        echo json_encode("error");
                    }

                }else{
                    echo json_encode("error");
                }
            }else{
                echo json_encode("error");
            }



        } else {
             echo "error";
         }
    } else {
        echo "error";

    }


// take the thumnail name
// insert bookdetails into db
//get bookid
//insert chapter details using book id