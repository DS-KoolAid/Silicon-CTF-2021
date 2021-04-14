<?php

require_once("db.php");

function check_login($uname, $psw){

    $comp1=hash("md5",$psw);
    $comp2=retreive_hash($uname);
    if ($comp1 == $comp2){
        return true;
    }
    else{
        return false;
    }

}

 function check_one_time_login($uname,$otp,$gen_date){
     $otp_gen_date = get_otp_date($uname);
     $code = substr(hash("md5",$uname . retreive_hash($uname) . $gen_date),0,10);
    if ($code == $otp){
        return true;
    }
    else{
        return false;
    }
 }

function retreive_hash($uname){
    $pw_hash=retreive_user_hash($uname);
    return $pw_hash;
}

function set_password($uname,$psw){
    $psw_hash=hash("sha256",$psw);
    set_password($uname,$psw_hash);
}
