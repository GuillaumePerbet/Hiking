<?php

//check if $param is a non empty string
//retrun true or false
function check_string($param){
    return (!empty($param) && is_string($param));
}

//check if $param is convertible to a positive integer
//return integer or false
function check_number($param){
    if (is_numeric($param)){
        //convert to rounded integer
        $param = (int) floatval($param);
        if($param >= 0){
            return $param;
        }
        else{
            return false;
        }
    }else{
        return false;
    }
}

//check if $param is convertible to future date
//return corresponding timestamp or false
function check_date($param){
    $param = strtotime($param);
    if($param > time()){
        return $param;
    }else{
        return false;
    }
}