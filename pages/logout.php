<?php 
  session_start();
  session_unset();
  header("Location: /notup/pages/auth.html");
?>