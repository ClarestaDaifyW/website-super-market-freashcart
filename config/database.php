<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce_db"; // ← sesuai dengan yang ada di MySQL

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
