<?php
require_once 'db_connect.php';
require_once 'autenticacao2.php';

$titulo = $_POST['titulo'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';
$usuario_id = $decoded->user_id;

$sql = "INSERT INTO Notas (titulo, conteudo, usuario_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $titulo, $conteudo, $usuario_id);

if ($stmt->execute()) {
    echo "Nota adicionada com sucesso";
} else {
    echo "Erro ao adicionar nota";
}
?>