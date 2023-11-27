<?php
require_once 'db_connect.php';

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
	setcookie("Error", "User already registered with this email.", time()+3, "/");
	header("Location: /notup/pages/auth.html");
} else {
	$sql = "INSERT INTO Usuarios (email, nome_usuario, senha_criptografada) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $email, $name, $senha_criptografada);

	if ($stmt->execute()) {
		echo "Usuário criado com sucesso";
		session_start();
		$_SESSION['email'] = $email;
		header("Location: /notup/pages");
		die();
	} else {
		setcookie("Error", "Error creating user.", time()+3);
		header("Location: /notup/pages/auth.html");
	}
}
?>
