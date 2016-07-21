<?php
//$loginRules = str_replace(array("\r", "\n",' '), '', $loginRules );
require_once 'libs/validate.php';
$formData = $_POST['fdata'];
parse_str($formData, $formDataArray);
echo $response = validate('loginFormRules',$formDataArray);

?>