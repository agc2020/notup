<?php
require_once 'db_connect.php';
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../pages/auth.html");
    exit();
}

$email = $_SESSION['email'];

$sql = "DELETE FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    session_destroy();
    header("Location: ../pages/auth.html?success=accountdeleted");
    exit();
} else {
    header("Location: ../pages/dashboard.html?error=sqlerror");
    exit();
}
?>
