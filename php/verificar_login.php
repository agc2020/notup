<?php
require_once 'db_connect.php'; // Certifique-se de que este arquivo existe e está correto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setcookie("Error", "Invalid email format.", time()+3, "/");
        header("Location: ../pages/auth.html");
        exit();
    }

    $senha = $_POST['senha'] ?? '';
    if (empty($senha)) {
        setcookie("Error", "Password not provided.", time()+3, "/");
        header("Location: ../pages/auth.html");
        exit();
    }

    $sql = "SELECT id, senha_criptografada FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        setcookie("Error", "Error preparing the query.", time()+3, "/");
        header("Location: ../pages/auth.html");
        exit();
    }

    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        setcookie("Error", "Error executing the query.", time()+3, "/");
        header("Location: ../pages/auth.html");
        exit();
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row['senha_criptografada'])) {
            session_start();
            $_SESSION['email'] = $email;
            header("Location: ../pages/index.php");
            exit();
        } else {
            setcookie("Error", "Invalid credentials.", time()+3, "/");
            header("Location: ../pages/auth.html");
        }
    } else {
        setcookie("Error", "Invalid credentials.", time()+3, "/");
        header("Location: ../pages/auth.html");
    }

    $stmt->close();
    $conn->close();
}
?>
