<?php
require_once 'db_connect.php';
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;

$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Formato de email inválido.";
    exit;
}

$senha = $_POST['senha'] ?? '';
if (empty($senha)) {
    http_response_code(400);
    echo "Senha não fornecida.";
    exit;
}

$sql = "SELECT id, senha_criptografada FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500); 
    echo "Erro na preparação da consulta.";
    exit;
}

$stmt->bind_param("s", $email);
if (!$stmt->execute()) {
    http_response_code(500); 
    echo "Erro ao executar a consulta.";
    exit;
}

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha_criptografada'])) {
        $payload = [
            "user_id" => $row['id'],
            "email" => $email,
            "exp" => time() + 3600
        ];

        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        http_response_code(200);
        echo "<script>window.location.href = '../pages/dashboard.html';</script>";
    } else {
        http_response_code(401);
        echo "Credenciais inválidas.";
    }
} else {
    http_response_code(401);
    echo "Credenciais inválidas.";
}
?>
