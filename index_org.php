<?php 
//echo "--------------------<br>";
//$key   = '1E63-DE12-22F3-1FEB-8E1D-D31F';
//$regex = '/[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}$/';
//
//$key   = 'ACOPY67A89E';
//$regex = '/[A-Z]{5}[0-9]{4}[A-Z]{1}$/';
//
//$key   = '999-123-1234';
//$regex = '/[0-9]{3}-[0-9]{3}-[0-9]{4}$/';
//
//
//if (preg_match($regex, $key)) {
//    echo 'Passed';
//} else {
//    echo 'Wrong key';
//}        
    //    exit;
?>
<!--<div class="col-sm-9">
<select class="form-control select" name="view" id ="view" tabindex="15">
<option <?php if($default_view_rev == '-1') {echo "selected = 'selected'";}?> value="-1">Select Default View</option>
<option <?php if($default_view_rev == 'Administrators'){ echo "selected = 'selected'";} ?> value="Administrators">Administrator</option>
<option <?php if ($default_view_rev == 'Maintenance') { echo "selected = 'selected'"; }?> value="Maintenance">Maintenance</option>
<option <?php if ($default_view_rev == 'Monitoring') { echo "selected = 'selected'"; }?> value="Monitoring">Monitoring</option>
<option <?php if ($default_view_rev == 'Reporting') {echo "selected = 'selected'"; }?> value="Reporting">Reporting</option>
</select>
</div>-->


<h3>Login Form </h3>
<form action="" method="post" id="loginForm" enctype="multipart/form-data">
    <label> Email</label>
    <input type="text" name="email" id="email" value="" />
    <br><br>
    <label> Password</label>
    <input type="text" name="password" id="password" value="" /><br>
    
    <label> Male</label>
    <input type="radio" name="gender" id="gender" value="male" />
    <label> Female</label>
    <input type="radio" name="gender" id="gender" value="female" /><br>

    <h4>Hobbis </h4>
    <label> Chess</label>
    <input type="checkbox" name="hobbies" id="hobbies" value="chess" />
    <label> Cricket</label>
    <input type="checkbox" name="hobbies" id="hobbies" value="cricket" /><br>

    <input type="file" name="prof_pic" id="prof_pic">
    <br>
    <label> Ip address</label>
    <input type="text" name="ip_add" id="ip_add" value="">
    <br>
    <label> Phone</label>
    <input type="text" name="phone" id="phone" value="">
    
    <br>
    <label> Pincode</label>
    <input type="text" name="pincode" id="pincode" value="">
    
    <br>
    <label> Date of Birth</label>
    <input type="text" name="dob" id="dob" value="">
    
    <br><input type="button" name="submit" id="submit" value="Submit" />
</form>


<script src="jquery.min.js"> </script>

<script>
$(function(){
     
    $('#submit').click(function(){
        //Set upload file name as hidden variable
//        $( "#loginForm input").each(function(){
//            if($(this).attr('type') === 'file'){
//                $('#prof_pic_name').remove();
//                var id = $(this).attr('id');
//                var name = $(this).attr('name');
//                var fileData = '';
//                var fileData = $("#"+id).prop("files")[0];
//                if(typeof fileData === 'object'){
//                    var fileField = '<input type="hidden" id="prof_pic_name" name="'+ name +'" value="'+ fileData.name +'">';
//                }   
//                $( "#loginForm" ).append(fileField);
//            }
//        });
        $.ajax({
            'type':'post',
            'url':'ajax_call.php',
            'data': {fdata:$( "#loginForm" ).serialize()},
            success:function(r){
                $('.error').remove();
                $.each(jQuery.parseJSON(r), function(name,errMsgObj){
                    var i = 1;
                    $.each((errMsgObj), function(errType,errMsg){
                        if(i === 1){
                            $('#'+name).after('<label class="error">' + errMsg + '</label>' );
                            i++;
                        }        
                    });
                }); 
            }
        });
    });
});    
</script>