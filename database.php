<?php
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS',"");
    define("DB_NAME",'anime_web');
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    if($mysqli-> connect_errno){
        die("connect error:".$mysqli->connect_errno);
    }
    return $mysqli;