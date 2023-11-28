<?php
require_once 'db_connect.php'; // Assegure-se de que este arquivo existe e está correto

$NewEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$newPassword = $_POST['newPassword'];
$password = $_POST['password'];
session_start();
$email = $_SESSION['email'];


$sql = "SELECT id, senha_criptografada FROM usuarios WHERE email = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['senha_criptografada'])) {
    $sql_update = "UPDATE usuarios SET senha_criptografada = ?, email = ? WHERE email = ?;";
    $stmt2 = $conn->prepare($sql_update);
    $senha_criptografada = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt2->bind_param("sss", $senha_criptografada, $NewEmail, $email);
    if($stmt2->execute()){
      $_SESSION['email'] = $NewEmail;
      header("Location: ../pages/settings.php");
    }
  } 
}
?>