<?php
//------------- 1) Check if Railway DB exists -------------
$host = getenv("MYSQLHOST") ?: "localhost";
$user = getenv("MYSQLUSER") ?: "root";
$pass = getenv("MYSQLPASSWORD") ?: "";
$db   = getenv("MYSQLDATABASE") ?: "spinwheel_db";
$port = getenv("MYSQLPORT") ?: 3306;

//------------- 2) Connect -------------
$conn = new mysqli($host, $user, $pass, $db, $port);

//------------- 3) Check connection -------------
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
