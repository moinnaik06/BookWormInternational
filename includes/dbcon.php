<?php

$servername = "remotemysql.com";
$username = "byQ2iHdqai";
$password = "219xFEQgdb";
$dbname = "byQ2iHdqai";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

?>