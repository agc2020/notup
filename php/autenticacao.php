<?php
require_once 'db_connect.php';
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

$secret_key = "SUA_CHAVE_SECRETA";

// Suponha que $email e $senha sejam obtidos de um formulário de login
$email = $_POST['email'];
$senha = $_POST['senha'];

// Verificar usuário no banco de dados
$sql = "SELECT id, senha_criptografada FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha_criptografada'])) {
        // Usuário autenticado, gerar JWT
        $payload = array(
            "user_id" => $row['id'],
            "email" => $email,
            "exp" => time() + 3600
        );

        $jwt = JWT::encode($payload, $secret_key);
        echo $jwt;
    } else {
        echo "Senha incorreta";
    }
} else {
    echo "Usuário não encontrado";
}
?>
