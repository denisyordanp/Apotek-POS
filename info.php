<?php 

$servername = "localhost";
$username = "root";
$password = "20191027";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "MYSQL Connected successfully";

phpinfo() ?>