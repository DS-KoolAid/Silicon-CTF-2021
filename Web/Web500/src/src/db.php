<?php

// error_reporting(0);
require_once("config.php"); // DB config



$db = new mysqli($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DBNAME);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  
  function check_errors($var) {
    if ($var === false) {
      die("Error. Please contact CTF administrator. (seems to be a db problem)");
    }
  }

function retreive_user_hash($uname){

    global $db;
    $statement = $db->prepare(
      "SELECT pw_hash FROM login_table WHERE name = ?"
    );
    check_errors($statement);
    $statement->bind_param("s", $uname);
    check_errors($statement->execute());
    $res = $statement->get_result();
    check_errors($res);
    $pw_hash = $res->fetch_assoc();
    $statement->close();
    return $pw_hash['pw_hash'];

}

function get_otp_date($uname){
  global $db;
    $statement = $db->prepare(
      "SELECT otp_date FROM login_table WHERE name = ?"
    );
    check_errors($statement);
    $statement->bind_param("s", $uname);
    check_errors($statement->execute());
    $res = $statement->get_result();
    check_errors($res);
    $ts = $res->fetch_assoc();
    $statement->close();
    return $ts['otp_date'];
}

function load_flag(){
    global $db;
    $statement = $db->prepare(
      "SELECT flag FROM flag_t WHERE id=1"
    );
    check_errors($statement);
    check_errors($statement->execute());
    $res = $statement->get_result();
    check_errors($res);
    $flag = $res->fetch_assoc();
    $statement->close();
    return $flag['flag'];
}