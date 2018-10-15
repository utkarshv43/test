/**
 * Created by Hashan on 1/4/2018.
 */
$(document).ready(function() {
    $('#search-button').click(function () {
        searchProcess();
    });

    $('#search-box').bind("keypress",function (e) {
        if(e.which == 13) {
            e.preventDefault();
            searchProcess();
        }
    });
});


function searchProcess() {
    var subject = document.getElementById("dropdownMenu1").value;

    $.ajax({
        type: 'post',
        url: 'src/search-subject.php',
        dataType: 'json',
        data: {'subject' : subject},
        success: function( response ) {
            if(response!="error" && response != null) {
                $('#result-viewer').css('visibility','visible');
                if(response == "empty"){
                    $('#result-count').text("No");
                }else{
                    $('#result-count').text(response.length);
                }
                $('#search-text').text(subject);
                $('#result-section').empty();
                if(response != "empty"){
                    $.each(response, function (key, value) {

                        $('#result-section').append(

                            '<article class="search-result row">'+
                            '<div class="col-xs-12 col-sm-12 col-md-2">'+
                            '<a href="#" title="thumbnail" class="thumbnail"><img src="assets/thumbnail/'+ value[6] +'" alt="iamge" /></a>'+
                            '</div>'+
                            '<div class="col-xs-12 col-sm-12 col-md-2">'+
                            '<ul class="meta-search">'+
                            '<li><i class="glyphicon glyphicon-book"></i> <span class="font-color">'+ value[2]+'</span></li>'+
                            '<li><i class="glyphicon glyphicon-user"></i> <span class="font-color">'+ value[3]+'</span></li>'+
                            '<li><i class="glyphicon glyphicon-ok"></i> <span class="font-color">'+ value[5]+'</span></li>'+
                            '</ul>'+
                            '</div>'+
                            '<div class="col-xs-12 col-sm-12 col-md-8">'+
                            '<h3><a href="reader.php?id='+ value[0] +'&book='+ value[7] +'&page=0" title="">'+ value[1]+'</a></h3>'+
                            '<p class="font-color" style="margin-top: 20px; margin-bottom: 20px">'+ value[4]+'</p>'+
                            '<span class="plus"><a href="reader.php?id='+ value[0] +'&book='+ value[7] +'&page=0" title="book">Read More</a></span>'+
                            '</div>'+
                            '<span class="clearfix border"></span>'+
                            '</article>'
                        );
                    });
                }

            }
        },
        error:function(x,e) {
            if (x.status==0) {
                alert('You are offline!!\n Please Check Your Network.');
            } else if(x.status==404) {
                alert('Requested URL not found.');
            } else if(x.status==500) {
                alert('Internel Server Error.');
            } else if(e=='parsererror') {
                alert('Error.\nParsing JSON Request failed.');
            } else if(e=='timeout'){
                alert('Request Time out.');
            } else {
                alert('Unknow Error.\n'+x.responseText);
            }
        }
    });
}
