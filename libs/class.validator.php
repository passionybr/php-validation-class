<?php
class Validations {
    /*
     * Validate user input empty or not
     *  
     */
    public function required($str){
        return $str ? 1 : 0;
    }
    /*
     * Validate email format
     *  
     */
    public function email($str){
        return (filter_var($str, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
    }
    
    /*
     * Validate max length
     *  
     */
    public function max_length($str,$options=array()){
        $maxValue = $options['condition'];
        return ( strlen($str) > $maxValue ) ? 0 : 1;
    }
    /*
     * Validate  min length
     *  
     */
    public function min_length($str,$options=array()){
        $minValue = $options['condition'];
        return ( strlen($str) < $minValue ) ? 0 : 1;
    }
    
    /*
     * Check input field value matches with exact length 
     *  
     */
    public function exact_len($str,$options=array()){
        $exactLength = $options['condition'];
        return ( strlen($str) == $exactLength ) ? 1 : 0;
        
    }
    
    /*
     * Check whether input value is exist between given range 
     * 
     */
    public function between($str,$options=array()){
        list($min,$max) = explode("-",$options['condition']);
        return ($min <= $str && $max >= $str) ? 1 : 0;
    }
    
    /*
     *  Check given string contains only alphabets 
     */
    public function alphaonly($str){
        return ( ctype_alpha($str) ) ? 1 : 0;
    }
    
    /*
     *  Check given string contains only digits
     */
    public function digits($str){
        return (ctype_digit($str)) ? 1 : 0;
    }
    
    /*
     *  Check given string contains only alphabets & digits 
     */
    public function alphanumonly($str){
        return (ctype_alnum($str)) ? 1 : 0;
    }
    
    /*
     *  Check given string contains only alphabets & digits & special characters with specified length
     */
    public function splalphanumonly($str,$options){
        $spl_chars = $alpha = $num = '';
        if(!empty($options)){
            if(isset($options['condition']['spl_chars'])) $spl_chars = $options['condition']['spl_chars'];
            if(isset($options['condition']['alpha'])) $alpha = $options['condition']['alpha'];
            if(isset($options['condition']['num'])) $num = $options['condition']['num'];
//            echo $spl_chars . $alpha . $num;
            $alphaCond = "/[a-zA-Z]{". $alpha ."}+/";
            $numCond = "/[0-9]{". $num ."}+/";
            $splCharsCond = "/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:'\<\>,\.\?\\\]{" . $spl_chars ."}+/";
            return (preg_match($alphaCond, $str) && preg_match($numCond, $str) && preg_match($splCharsCond, $str))  ? 1 : 0;
        } else {
            $alphaNumCond = '/[a-zA-Z]+\d+/';
            $splCharsCond = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
            return (preg_match($alphaNumCond, $str) && preg_match($splCharsCond, $str)) ? 1 : 0;
        }
    }
    
    /*
     *  Check uploaded file extensions
     */
    public function valid_extensions($str,$options=array()){
        $info = new SplFileInfo($str);
        return in_array($info->getExtension(),$options['condition']) ? 1 : 0;
    }
    
    /*
     *  Check given value is float number or not
     */
    public function floatonly($str){
        return (is_float($str)) ? 1 : 0;
    }
    
    /*
     * Check given ip is valid or not
     */
    public function check_ip($str){
        return ( !filter_var($str, FILTER_VALIDATE_IP) === false) ? 1 : 0;
    }
    
    /*
     * Check given ip matches with either IPV4 or IPV6
     */
    public function ip_type($str,$options=array()){
        $type = $options['condition'];
        if($type == 4){
            return (  !filter_var($str, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) === false) ? 1 : 0;
        } else if($type == 6){
            return (!filter_var($str, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) === false) ? 1 : 0;
        }  
         
    }
    
    /*
     * Check date format
     * 
     */
    public function date_format($str,$options=array()){
        $format = $options['condition'];
        $d = DateTime::createFromFormat($format, $str);
        return $d && $d->format($format) === $str ? 1 : 0;
    }
    
    /*
     * Validate given date is below min date or  not
     * 
     */
    public function min_date($str,$options=array()){
        $minDate = $options['condition'];
        $strObj = new DateTime($str);
        $minDateObj = new DateTime($minDate);
        $interval = $minDateObj->diff($strObj);
        $res = $interval->format('%R%a');
        return (strpos($res,"+") > -1 ) ? 1 : 0;
    }
    
    /*
     * Validate given date is below max date or  not
     * 
     */
    public function max_date($str,$options=array()){
        $minDate = $options['condition'];
        $strObj = new DateTime($str);
        $minDateObj = new DateTime($minDate);
        $interval = $minDateObj->diff($strObj);
        $res = $interval->format('%R%a');
        return (strpos($res,"-") > -1 ) ? 1 : 0;
    }
   
    /*
     * Validate given string matches with specified format 
     * 
     */
    public function check_format($str,$options=array()){
        $format = $options['condition'];
        $cond = "/$format$/";
        return ( preg_match($cond,$str ))  ? 1 : 0;
    }
    
    
}
?>