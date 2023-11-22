<?php
require_once 'db_connect.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'];
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuarios (email, senha_criptografada) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha_criptografada);

if ($stmt->execute()) {
    echo "Usuário criado com sucesso";
} else {
    echo "Erro ao criar usuário";
}
?>