<?php
require_once 'db_connect.php';

use \Firebase\JWT\JWT;

$secret_key = "SUA_CHAVE_SECRETA";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id, senha_criptografada FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha_criptografada'])) {
        
        $payload = array(
            "user_id" => $row['id'],
            "email" => $email,
            "exp" => time() + 3600
        );

        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        echo $jwt;
    } else {
        echo "Senha incorreta";
    }
} else {
    echo "Usuário não encontrado";
}
