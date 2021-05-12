<?php


function check_login($uname, $psw){

    if ($uname === "temp_login" && $psw === "StormTrooperRulez"){
        return true;
    }
    else{
        return false;
    }

}
