<?php
$servername = "localhost";
$username = "root";
$password = "sua_senha";
$dbname = "base1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>