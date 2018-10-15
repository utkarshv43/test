<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/search.css" type="text/css">


</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Online Library</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#">Upload Book</a></li>
        </ul>
    </div>
</nav>
<div class="panel panel-default col-md-offset-2 col-md-8">
    <div class="panel panel-body">
        <div class="row">
            <form class="col s12" name="book-upload" id="book-upload" method="post" enctype="multipart/form-data" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Book Name" name="book-name" id="book-name" type="text">
                        <label for="title">Book</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="subject" id="subject">
                            <option value="" disabled selected>Choose The Subject</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Computer Science">Computer Science</option>
                        </select>
                        <label>Subject</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Author Name" id="author" name="author" type="text">
                        <label for="email">Author</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea placeholder="Describe About The Book" id="description" name="description" class="materialize-textarea" data-length="500"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s6">
                        <div class="btn">
                            <span>Book Cover</span>
                            <input type="file" name="thumbnail" id="thumbnail">
                        </div>
                        <div class="file-path-wrapper">
                            <input placeholder="Select The Book Cover Image" class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn">
                            <span>Upload Book</span>
                            <input type="file"  name="book_url" id="book_url">
                        </div>
                        <div class="file-path-wrapper">
                            <input placeholder="Select The Book" class="file-path validate" type="text">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row col s12">
                    <a class="waves-effect waves-light blue-grey darken-3 btn" id="add-chapter-btn">Add A Chapter</a>
                </div>

                <div class="row col s12">
                    <ul id="chapter-list" class="col s12">

                    </ul>
                </div>
                <div class="row col s12">
                    <button class="btn waves-effect waves-light  pull-right" type="submit" name="submit" id="submit">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/upload-book.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

<script >

    $(document).ready(function() {
        $('select').material_select();
    });
    var topic_count = 0;
    $('#add-chapter-btn').click(function () {
       $('#chapter-list').append(
           '<li id="list'+topic_count+'">'+
        '<div class="input-field col s4">'+
            '<input id="chapter'+topic_count+'" name="chapter'+topic_count+'" type="text">'+
            '<label>Chapter</label>'+
        '</div>'+
        '<div class="input-field col s4">'+
        '<input id="sub-topic'+topic_count+'" name="sub-topic'+topic_count+'" type="text">'+
        '<label>Sub Topic</label>'+
        '</div>'+
        '<div class="input-field col s4">'+
            '<input id="pages'+topic_count+'" name="pages'+topic_count+'" type="text">'+
            '<label>Pages</label>'+
        '</div>'+
               '</li>'
       );
        topic_count++;
    });

    $("form#book-upload").submit(function(e) {
        e.preventDefault();
        var bookName = $('#book-name').val();
        var subject = $('#subject option:selected').val();
        var author = $('#author').val();
        var description = $('#description').val();
        var listLength = $('ul#chapter-list li').length;
        var book_url = $('#book_url').val();
        var thumbnail = $('#thumbnail').val();

        if (bookName == "" || subject == "" || author == "" || description == "" || book_url == "" || thumbnail == ""){
            $('input').css('border-bottom-color','#c62828 ');
            $('textarea').css('border-bottom-color','#c62828 ');
            Materialize.toast('You Cannot Keep Empty Fields', 4000);
        }else{

            var formData = new FormData(this);
            formData.append("listLength", listLength);

            $.ajax({
                url: 'src/file-upload.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    Materialize.toast('You Have Successfully Uploaded The Book.',2000,'',function() {
                        Materialize.toast('Refreshing Now..', 1000, '', function () {
                            window.location.href = "upload-book.php";
                        });
                    });

                },
                error: function (data) {
                    Materialize.toast('Error in Uploading...', 4000);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }


    });


</script>

</body>
</html>