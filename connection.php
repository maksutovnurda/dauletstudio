<?php
$servername = "localhost"; // name of server
$username = "root"; //name of user
$password = ""; //pass
$name_db = "dauletstudio"; //name of table

$conn = new mysqli($servername, $username, $password, $name_db);
$conn->set_charset( 'utf8' ); 
/*
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
    echo "Connection Successfullllly"; 
    
$servername = "srv-pleskdb38.ps.kz:3306";
$username = "nurda_nurdaul1";
$password = "151314551241Bb";
$name_db = "nurdaul1_nublog"; */
 ?>