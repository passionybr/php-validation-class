<?php 

//$str =  <<< PP
//[QUOTE=" name : Max-Fischer,post : 486662533,member : 123 "]I don't so much dance as rhythmically convulse.[/QUOTE]
//PP;
//
//preg_match_all('/^\[QUOTE=\"(.*?)\"\](?:.*?)]$/', $str, $matches);
//preg_match_all('/([a-zA-Z0-9]+)\s+:\s+([a-zA-Z0-9]+)/', $matches[1][0], $result);
//
//$your_data = array_combine($result[1],$result[2]);
//
//echo "<pre>";
//print_r($matches);
//exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <h2>Registration Form</h2>
        <form role="form" action="" method="post" id="loginForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="usr">Email:</label>
                <input type="text" name="email" id="email" value="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="text" name="password" id="password" value="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="email">Date of Birth:</label>
                <input type="text" name="dob" id="dob" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="mbl">Mobile:</label>
                <input type="text" name="phone" id="phone" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">IP Address:</label>
                <input type="text" name="ip_add" id="ip_add" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="mbl">Pincode:</label>
                <input type="text" name="pincode" id="pincode" value="" class="form-control" />
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="radio">
                    <label><input type="radio" name="gender" id="gender" value="male" />Male</label>
                </div>
                <div class="radio">
                    <label>  <input type="radio" name="gender" id="gender" value="female" />Female</label>
                </div>
            </div>

            <div class="form-group">
                <label>Hobbies</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="hobbies" id="hobbies" value="chess" />Chess</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="hobbies" id="hobbies" value="cricket" />Cricket</label>
                </div>
            </div>
             <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" name="prof_pic" id="prof_pic">
            </div>
            <div class="form-group">
                <label for="sel1">Select list:</label>
                <select class="form-control" id="age" name="age">
                    <option value="">Select One</option>
                    <option value="1">10</option>
                    <option value="2">20</option>
                    <option value="3">30</option>
                    <option value="4">40</option>
                </select>
            </div>
            <input type="button" id="submit" class="btn btn-info" value="Submit Button">
        </form>
        <br>
    </div>
    <div class="col-lg-2"></div>
</body>
</html>


<script>
$(function(){
     
    $('#submit').click(function(){
        //Set upload file name as hidden variable
        $( "#loginForm input").each(function(){
            if($(this).attr('type') === 'file'){
                $('#prof_pic_name').remove();
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var fileData = '';
                var fileData = $("#"+id).prop("files")[0];
                if(typeof fileData === 'object'){
                    var fileField = '<input type="hidden" id="prof_pic_name" name="'+ name +'" value="'+ fileData.name +'">';
                }   
                $( "#loginForm" ).append(fileField);
            }
        });
        $.ajax({
            'type':'post',
            'url':'ajax_call.php',
            'data': {fdata:$( "#loginForm" ).serialize()},
            success:function(r){
                if(r !== true) {
                    $('.error').remove();
                    $.each(jQuery.parseJSON(r), function(name,errMsgObj){
                        $.each((errMsgObj), function(errType,errMsg){
                            var inputType = $('#'+name).attr('type');
                            if(inputType == 'radio' || inputType == 'checkbox'){
                                var errText = '<label class="error">' + errMsg + '</label>';
                                $(errText).insertAfter( $('#'+name).parent().parent().parent().last());
                            } else { 
                                $('#'+name).after('<label class="error">' + errMsg + '</label>' );
                            }
                        });
                    }); 
                } else {
                    $( "#loginForm" ).submit();
                }
            }
        });
    });
});    
</script>