<?php
require_once 'db_connect.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'];
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT id FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Usuário já cadastrado com este e-mail.";
    exit;
} else {
    $sql = "INSERT INTO Usuarios (email, senha_criptografada) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha_criptografada);

    if ($stmt->execute()) {
        echo "Usuário criado com sucesso";
    } else {
        echo "Erro ao criar usuário";
    }
}
?>
