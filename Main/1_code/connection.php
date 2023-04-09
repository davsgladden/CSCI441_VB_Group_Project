<?php

$dbhost = 'agricomdb.mysql.database.azure.com';
$dbuser = 'AgriComAdmin';
$dbpass = 'Udstmpg1OoGydF35';
$dbname = 'agricomdb';

if(!$con = mysqli_connect($dbhost, $dbuser,$dbpass, $dbname)){
    die("Failed to connect!");
}
