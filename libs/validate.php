<?php
require_once 'class.validator.php';
require_once realpath(__DIR__.'/../class.rules.php');
 
function validate($funName,$formDataArray){
    $formRulesObj = new FormRules();
    $validator = new Validations();
    $loginRules = $formRulesObj->$funName();
    $response = $status = '';
    foreach($loginRules['rules'] as $name=>$conds){
        foreach($conds as $cond=>$value){
            $valueOptions = array();
            if(is_array($value)){
                $valueOptions = $value;
                if($valueOptions[0] === true){
                   if(is_array($valueOptions[1])){
//                        print_r($valueOptions[1]);
                        $options = array('condition'=>$valueOptions[1]);
                        if(isset($formDataArray[$name])) $status = $validator->$cond($formDataArray[$name],$options);
                        if($status == 0){
                            $response[$name][$cond] = $loginRules['messages'][$name][$cond];
                        }
                   } else {
                        $status = $valueOptions[1]($formDataArray[$name]);
                        if($status == 0){
                             $response[$name][$cond] = $loginRules['messages'][$name][$cond];
                        }
                   }
                }
            } else if($value === true || $value != ''){
                $options = array('condition'=>$value);
                if(isset($formDataArray[$name])) $status = $validator->$cond($formDataArray[$name],$options);
                if($status == 0){
                    $response[$name][$cond] = $loginRules['messages'][$name][$cond];
                }
            }
        }
    }
    if(!empty($response)){
        // Set only one error message for each input field
        foreach($response as $k=>$resp){
            if(is_array($resp) && count($resp) > 1){
                $new_res[$k][key($resp)]  = $a = array_shift($resp);
            } else {
                $new_res[$k] = $resp;
            }
        }
        return $errorMsgs = json_encode($new_res);
    } else {
        return true;
    }
    
}
?>