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
      header("Location: /notup/pages");
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
        <a class="option">
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

    <div class="workspace">
      <h2><?php echo $row['nome_usuario']?></h2>

      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="idMail" name="email" placeholder="name@example.com">

      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="idMail" name="email" placeholder="name@example.com">

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>
</html>