<?php
// Check if running on Railway (environment variables will exist there)
if (getenv("MYSQLHOST")) {
    // RAILWAY CONFIG (Online Hosting)
    $host = getenv("MYSQLHOST");
    $user = getenv("MYSQLUSER");
    $pass = getenv("MYSQLPASSWORD");
    $db   = getenv("MYSQLDATABASE");
    $port = getenv("MYSQLPORT");

    $conn = new mysqli($host, $user, $pass, $db, $port);
} else {
    // LOCALHOST CONFIG (XAMPP)
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "spinwheel_db";

    $conn = new mysqli($host, $user, $pass, $db);
}

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
