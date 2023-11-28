<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../css/index.css">
  <title>Notup</title>
</head>
<body>
  <?php 
    require_once '../php/db_connect.php';
    $sql = "SELECT * FROM Usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    session_start();
    $stmt->bind_param("s", $_SESSION['email']);
    
    if (!$stmt->execute()) {
      http_response_code(500);
      echo "Erro ao executar a consulta.";
      setcookie("Error", "Error executing the query.", time()+3, "/");
      header("Location: ../pages");
      exit;
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    }

  ?>

  <div class="top_bar">
    <img src="../public/logo_notup.png" alt="logo_notup">
    <nav></nav>

    <button id="user_settings">
      <img src="../public/user.jpg" alt="user" class="user_img">
      <div id="user_modal">
        <a href="settings.php" class="option">
          <span class="material-symbols-outlined">settings</span>
          <p>settings</p>
        </a>
        <a href="logout.php" class="option">
          <span class="material-symbols-outlined">logout</span>
          <p>logout</p>
        </a>
      </div>
    </button>
  </div>

  <div class="content_wrapper">
    <div class="nav_options">
      <div class="option">
        <span class="material-symbols-outlined">add</span>
        <p>add new note</p>
      </div>
      <div class="option">
        <span class="material-symbols-outlined">visibility</span>
        <p>show notes</p>
      </div>
    </div>

    <div class="workspace settings_workspace">
      <div class="title_settings">
        <h2><?php echo $row['nome_usuario']?> </h2>
        <div>
          <button id="save" class="save">Salvar</button>
          <button id="delete" class="delete">Excluir conta</button>
        </div>
      </div>

      <form method="post" id="form_update" action="../php/updateUser.php">
        <label for="email" class="form-label">Email address</label>
        <input value="<?php echo htmlspecialchars($row['email']); ?>" type="email" class="form-control" id="idMail" name="email" placeholder="name@example.com">
        
        <label for="password" class="form-label">New PassWord</label>
        <input type="password" class="form-control" id="idNewPass" name="newPassword">
      </form>

    </div>
  </div>

  <div id="confirm_modal" class="confirm_modal">
    <h6>Confirme sua senha para salvar as alterações</h6>
    <input type="password" class="form-control" id="idPass" name="password">
    <button id="confirm" class="confirm">confirmar</button>
  </div>

  <div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
    <svg style="width: 20px;" xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" fill="#ea868f"/>
    </svg>
    <div id="error_notify"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
  <script src="../js/settings.js"></script>
</body>
</html>