<?php
class FormRules {
    
    public function loginFormRules(){
        $loginRulesMsgs = array(
                'rules' => Array(
                    'email' => Array(
                        'required' => true,
                        'remote' => array(true,'email_check') 
                    ),
                   'password' => Array(
                        'required' => true,
                        'min_length'=> 5,
                        'max_length'=> 10,
                        'splalphanumonly'=> array(true,array('spl_chars'=>2,'alpha'=>5,'num'=>3))
                    ),
                    'gender' => array(
                        'required' => true
                    ),
                    'hobbies' => array(
                        'required' => true
                    ),
                    'prof_pic' => array(
                        'required' => true,
                        'valid_extensions' => array(true,array('jpg'))
                    ),
                    'ip_add' => array(
                        'required' => true,
                        'check_ip' => true,
                        'ip_type' => 4
                    ),
                    'dob' => array(
                        'required' => true,
                        'date_format'=> "Y-m-d",
                        'min_date' => '2016-07-06',
                        'max_date' => '2016-07-12'
                    ),
                    'pincode' => array(
                        'required' => true,
                        'digits'=> true
                    ),
                    'phone' => array(
                        'required' => true,
                        'check_format'=> '[0-9]{3}-[0-9]{3}-[0-9]{4}'
                    ),
                    'age' => array(
                        'required' => true
                    )
                ),
                'messages' => Array(
                    'email' => Array(
                        'required' => 'Please enter your Email Address',
                        'remote' => 'Email is already exist'
                    ),
                    'password' => Array(
                        'required' => 'Please enter your password',
                        'min_length' => 'password must be atleast 5 characters',
                        'max_length' => 'password must be maximum 10 characters',
                        'splalphanumonly'=> 'Password does not match required criteria'
                    ),
                    'gender' => array(
                        'required' => "Please select Gender"
                    ),
                    'hobbies' => array(
                        'required' => "Please select hobbies"
                    ),
                    'prof_pic' => array(
                        'required' => "Please select image",
                        'valid_extensions' => "Please select only jpg format"
                    ),
                    'ip_add' => array(
                        'required' => "Please enter ip address",
                        'check_ip' => "Please enter correct IP format",
                        'ip_type' => 'Please enter IPV4 Format only'
                    ),
                    'dob' => array(
                        'required' => "Enter DOB",
                        'date_format' => "Pleace enter correct date format",
                        'min_date' => "Please enter future date ",
                        'max_date' => 'Please enter below futrue date'
                    ),
                    'pincode' => array(
                        'required' => "Enter pincode",
                        'digits'=> 'Enter digits only'
                    ),
                    'phone' => array(
                        'required' => "Enter phone number",
                        'check_format'=> 'Enter correct format '
                    ),
                    'age' => array(
                        'required' => "Please select age"
                    )
                )
            );
       return $loginRulesMsgs; 
    }
}

/*
 * Validate email
 * 
 */
function email_check($str){
    // Replace $email_array with DB query response
    $email_array = array('sample@tastytuts.net');
    return in_array($str,$email_array)  ? 0 : 1;
}


?>
