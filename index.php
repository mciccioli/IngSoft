<?php
  session_start();
  require 'php/functions/database.php';
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
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Rubi</title>
  <link rel="stylesheet" href="css/menu_style.css">
  <link rel="stylesheet" href="css/nivo-slider.css">
  <link rel="stylesheet" href="themes/default/default.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
  <script src="js/jquery.nivo.slider.js"></script>

  <script type="text/javascript"> 
    $(window).on('load', function() {
        $('#slider').nivoSlider(); 
    }); 
  </script>

</head>

<body>
<section id="nav-test">
  <div id="nav-container">
    <ul>
      <li class="nav-li active-nav"><a>Inicio</a></li>
      <li class="nav-li"><a href="php/search.php" style="text-decoration: none;">Mecánicos</a></li>
      <li class="nav-li"><a href="php/contacto.php" style="text-decoration: none;">Contactános</a></li>
      <li class="nav-li"><a href="php/registro_mec.php" style="text-decoration: none;" target="_blank">Nuevo Mecánico</a></li>
      <?php if(!empty($user)): ?>


      <li><a><img  src="<?php echo $user['foto']; ?>" width="42px" height="36px" /></a>
      <ul style="z-index: 100">
      <li><a><?= $user['usuario']; ?></a></li>
      <li style="margin-left: 0px;"><a href="php/logout.php">Logout</a></li>

      <?php else: ?>
        <li><a><img src="img/perfil.jpg" width="42px" height="36px" /></a>
      <ul style="z-index: 100">
        <li><a href="php/login.php">Login</a></li>
            <li style="margin-left: 0px;"><a href="php/registro.php" target="_blank">Registrarse</a></li>
              <?php endif; ?>
        </ul>
    </li>
    </ul>
    <div id="line"></div>
  </div>
</section>

<!--
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script  src="js/menu_script.js"></script>
-->


<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">     
        <a href="https://www.toyota.com.ar/modelos/etios/2018/etios-hatchback" target="_blank"><img src="img/etiosp.jpg" alt="Obtene tu nuevo Etios" title="#htmlcaption1" />    </a>
        <a href="https://www.peugeot.com.ar/gama/descubri-nuestros-vehiculos/peugeot-208.html" target="_blank"><img src="img/peugeotp.png" alt="Nuevo Peugeot a un precio imperdible" title="#htmlcaption2" /> </a>
        <a href="https://www.maugerirepuestos.com.ar/" target="_blank"><img src="img/repuestosp.jpg" alt="Compra repuestos de primera marca para tu auto" title="#htmlcaption3" /> </a>    
    </div> 
    
  </div>






</body>
</html>