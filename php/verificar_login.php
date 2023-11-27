<?php
require_once 'db_connect.php'; // Assegure-se de que este arquivo existe e está correto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        setcookie("Error", "Password not provided.", time()+3, "/");
        header("Location: /notup/pages/auth.html");
        exit;
    }
    
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "SELECT id, senha_criptografada FROM usuarios WHERE email = ?;"; //AND senha_criptografada = ?
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo "Erro na preparação da consulta.";
        setcookie("Error", "Error preparing the query.", time()+3, "/");
        header("Location: /notup/pages/auth.html");
        exit;
    }

    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        http_response_code(500);
        echo "Erro ao executar a consulta.";
        setcookie("Error", "Error executing the query.", time()+3, "/");
        header("Location: /notup/pages/auth.html");
        exit;
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row['senha_criptografada'])) {
            http_response_code(200);
            session_start();
            $_SESSION['email'] = $email;
            header("Location: /notup/pages");
        } else {
            http_response_code(401);
            echo "Credenciais inválidas.";
            setcookie("Error", "Invalid credentials.", time()+3, "/");
            header("Location: /notup/pages/auth.html");
        }
    } else {
        http_response_code(401);
        echo "Credenciais inválidas.";
        echo $senha_criptografada;
        setcookie("Error", "Invalid credentials.", time()+3, "/");
        header("Location: /notup/pages/auth.html");
    }

    $stmt->close();
    $conn->close();
}
?>
