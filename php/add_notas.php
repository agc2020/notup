<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['email']) || empty($_POST['titulo']) || empty($_POST['conteudo'])) {
    header("Location: ../pages/dashboard.html?error=emptyfields");
    exit();
}

$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$email = $_SESSION['email'];

// Obter ID do usuário
$sql = "SELECT id FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $usuario_id = $row['id'];

    // Inserir a nota
    $sql = "INSERT INTO Notas (titulo, conteudo, usuario_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $conteudo, $usuario_id);

    if ($stmt->execute()) {
        header("Location: ../pages/dashboard.html?success=noteadded");
        exit();
    } else {
        header("Location: ../pages/dashboard.html?error=sqlerror");
        exit();
    }
} else {
    header("Location: ../pages/dashboard.html?error=nouser");
    exit();
}
?>
