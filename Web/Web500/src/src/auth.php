<?php

require_once("db.php");

function check_login($uname, $psw){

    $comp1=hash("sha256",$psw);
    $comp2=retreive_hash($uname);
    if ($comp1 == $comp2){
        return true;
    }
    else{
        return false;
    }

}

 function check_one_time_login($uname,$otp,$id, $e){
     if (!check_email($e)){
         return false;
     }
     $code = substr(hash("md5",$id . retreive_hash($uname) . get_otp_date($uname) . $e),0,10);
     echo '<!--  authorization_code: '.$code . ' -->'; 
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

function check_email($e){
    if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        return false; 
      }
      else{
          if (str_contains($e,'@galacticempire.com'))
          {
              return true;
          }
          else{
              return false;
          }
      }
}