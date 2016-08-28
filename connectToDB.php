<?php

$username = "gkrgedon_admin";
$password = "admin";
$hostname = "localhost";

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
$selected = mysql_select_db("gkrgedon_gkr",$dbhandle) or die("Could not select database");

?>