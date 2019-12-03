<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    header('Location: /tpinge');
  }
  require 'functions/database.php';
  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, usuario, password FROM users WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /tpinge");
    } else {
      $message = 'Usuario o contraseña incorrecta';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rubi</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
-->

</head>

 <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

<body>
    <form action="login.php" method="POST" class="form-box animated fadeInUp">
        <h1 class="form-title">SignIn</h1>
        <input name="usuario" type="text" placeholder="Usuario" autofocus>
        <input name="password" type="password" placeholder="Contraseña">
        <button type="submit" value="Submit">
            Login
        </button>
    </form>
</body>

</html>
