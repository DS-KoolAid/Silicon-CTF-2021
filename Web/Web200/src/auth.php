<?php


function check_login($uname, $psw){

    if ($uname === "stormtrooper2" && $psw === "StormTrooperRulez"){
        return true;
    }
    else{
        return false;
    }

}
