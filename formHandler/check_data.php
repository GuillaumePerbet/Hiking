<?php

//check if $param is a non empty string
//return string or false
function check_string($param){
    if (!empty($param) && is_string($param)){
        return $param;
    }else{
        return false;
    }
}

//check if $param is a non empty string
//return formated name or false
function check_name($param){
    if (!empty($param) && is_string($param)){
        return ucwords(strtolower($param)," -_.\t\r\n\f\v");
    }else{
        return false;
    }
}

//check if $param is convertible to a positive integer
//return rounded integer or false
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

//check if $param matches a phone number format
//return formated phone number or false
function check_phone($param){
    $regex = "#^[+]?[(]?[0-9]{0,4}[)]?[-\s\./0-9]*$#";
    if (preg_match($regex,$param)){
        return preg_replace("#[\(\)\-\s\./]#","",$param);
    }else{
        return false;
    }

}

//check if $param is convertible to date in future
//return corresponding timestamp or false
function check_date($param){
    $param = strtotime($param);
    if($param > time()){
        return $param;
    }else{
        return false;
    }
}

//check if $id correspond to an entry in $table of $pdo database
//return id if found or false
function check_id($id,$pdo,$table){
    $sql = "SELECT id FROM $table WHERE id=?";
    $req = $pdo->prepare($sql);
    $req -> execute([$id]);
    $res = $req->fetch();
    $req -> closeCursor();
    if ($res !== false){
        return $res["id"];
    }else{
        return false;
    }
}