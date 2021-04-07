<?php

require_once("db.php");

function check_login($uname, $psw){

    $comp1=substr(hash("sha256",$psw),0,8);
    $comp2=retreive_hash($uname);
    if ($comp1 == $comp2){
        return true;
    }
    else{
        return false;
    }

}

function retreive_hash($uname){
    $ps_hash=substr(retreive_user_hash($uname),0,8);
    return $pw_hash;
}

function set_password($uname,$psw){
    $psw_hash=hash("sha256",$psw);
    set_password($uname,$psw_hash);
}
