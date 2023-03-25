<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "userlogins";

if(!$con = mysqli_connect($dbhost, $dbuser,$dbpass, $dbname)){
    die("Failed to connect!");
}
