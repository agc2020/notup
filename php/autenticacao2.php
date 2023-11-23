<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;

$secret_key = "SUA_CHAVE_SECRETA";

$jwt = getallheaders()['Authorization'] ?? '';

if (!$jwt) {
    http_response_code(401);
    echo "Acesso negado. Token não fornecido.";
    exit;
}

try {
    $decoded = JWT::decode($jwt, $secret_key);
    
} catch (Exception $e) {
    http_response_code(401);
    echo "Acesso negado: " . $e->getMessage();
    exit;
}
?>
