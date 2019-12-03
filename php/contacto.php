<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  require 'functions/database.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, usuario, password, foto FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>



<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <title>Rubi</title>
  

<!-- Latest compiled and minified CSS -->
  



  <link rel="stylesheet" href="../css/menu_style.css">

  <link rel="stylesheet" href="../css/busqueda.css">

  <link rel="stylesheet" type="text/css" href="../css/buscar.css" />
  



  <!-- <link href="php/style.css" rel="stylesheet" type="text/css" /> -->
  



  

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">




<style>
table{
	margin:auto;
	left:0;
}


</style>
</head>

<body>

<section id="nav-test">
  <div id="nav-container">
    <ul>
      <li class="nav-li"><a href="../index.php" style="text-decoration: none;">Inicio</a></li>
      <li class="nav-li"><a href="search.php" style="text-decoration: none;">Mecánicos</a></li>
      <li class="nav-li"><a>Contactános</a></li>
      <li class="nav-li"><a href="registro_mec.php" style="text-decoration: none;" target="_blank">Nuevo Mecánico</a></li>
       <?php if(!empty($user)): ?>


      <li><a><img  src="../<?php echo $user['foto']; ?>" width="42px" height="36px" /></a>
      <ul style="z-index: 100">
      <li><a><?= $user['usuario']; ?></a></li>
      <li style="margin-left: 0px;"><a href="logout.php">Logout</a></li>

      <?php else: ?>
        <li><a><img src="../img/perfil.jpg" width="42px" height="36px" /></a>
      <ul style="z-index: 100">
        <li><a href="login.php">Login</a></li>
            <li style="margin-left: 0px;"><a href="registro.php">Registrarse</a></li>
              <?php endif; ?>
        </ul>
    </li>
    </ul>
    <div id="line"></div>
  </div>
</section>




<div style="margin-top: 60px; margin-left: 20px; position: absolute;">
<form name="formulario_contacto" method="post" action="functions/enviar_mail.php">
<table width="500px">
<tr>
<td>
<label for="nombre">Nombre: *</label>
</td>
<td>
<input type="text" name="nombre" maxlength="50" size="25">
</td>
</tr>
<tr>
<td valign="top">
<label for="apellido">Apellido: *</label>
</td>
<td>
<input type="text" name="apellido" maxlength="50" size="25">
</td>
</tr>
<tr>
<td>
<label for="email">Dirección de E-mail: *</label>
</td>
<td>
<input type="text" name="email" maxlength="80" size="35">
</td>
</tr>
<tr>
<td>
<label for="tfno">Número de teléfono:</label>
</td>
<td>
<input type="text" name="tfno" maxlength="25" size="15">
</td>
</tr>
<tr>
  <td>Asunto:</td>
  <td><label for="asunto"></label>
    <input type="text" name="asunto" id="asunto"></td>
</tr>
<tr>
<td>
<label for="comments">Comentarios: *</label>
</td>
<td>
<textarea name="comentarios" maxlength="500" cols="30" rows="5"></textarea>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center">
<input type="submit" value="Enviar"  style="padding: 10px 10px;border-radius: 6px;text-align: center;font-weight: bold;width: 100px;    height: 40px;overflow: hidden;color:rgba(255,255,255,1);cursor: pointer;letter-spacing: 2px;box-shadow:inset 0 0 0 1px rgba(0,0,0,0.1);
    text-decoration: none;transition: all ease 0.5s;background:#328dd8;"   >
</td>
</tr>
</table>
</form>
</div>



</body>
</html>