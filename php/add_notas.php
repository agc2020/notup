<?php
require_once 'db_connect.php';

// Suponha que esses dados venham de um formulário
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$usuario_id = $_POST['usuario_id']; // ID do usuário autenticado

$sql = "INSERT INTO Notas (titulo, conteudo, usuario_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $titulo, $conteudo, $usuario_id);

if ($stmt->execute()) {
    echo "Nota adicionada com sucesso";
} else {
    echo "Erro: " . $conn->error;
}
?>
