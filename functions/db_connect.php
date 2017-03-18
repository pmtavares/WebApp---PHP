<?php
// declare the variables for the connection
$hostname = "localhost";
$database = "academyint";
$username = "root";
$password = "";

//Make the connection
$connection = mysqli_connect($hostname, $username, '', $database) or die(mysql_error());

//Establish the character set:
mysqli_set_charset($connection, 'utf8');

?>