<?php
require_once 'db_connect.php';

if (empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['name'])) {
    // Redireciona de volta para o formulário com uma mensagem de erro
    header("Location: ../pages/auth.html?error=emptyfields");
    exit();
}

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'];
$name = $_POST['name'];
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT id FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: ../pages/auth.html?error=userexists");
    exit();
} else {
    $sql = "INSERT INTO Usuarios (email, nome_usuario, senha_criptografada) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $name, $senha_criptografada);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['email'] = $email;
        header("Location: ../pages/dashboard.html");
        exit();
    } else {
        header("Location: ../pages/auth.html?error=sqlerror");
        exit();
    }
}
?>
