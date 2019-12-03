




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
  <link href="../css/star_style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/avaliations.js"></script>



  

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">







</head>
<body>

<section id="nav-test">
  <div id="nav-container">
    <ul>
      <li class="nav-li"><a href="../index.php" style="text-decoration: none;">Inicio</a></li>
      <li class="nav-li"><a>Mecánicos</a></li>
      <li class="nav-li"><a href="contacto.php" style="text-decoration: none;">Contactános</a></li>
      <li class="nav-li"><a href="registro_mec.php" style="text-decoration: none;" target="_blank">Nuevo Mecánico</a></li>
       <?php if(!empty($user)): ?>


      <li><a><img  src="../<?php echo $user['foto']; ?>" width="42px" height="36px" /></a>
      <ul style="z-index: 100">
      <li><a><?= $user['usuario']; ?></a></li>
      <li style="margin-left: 0px;"><a href="logout.php">Logout</a></li>

      <?php else: ?>
        <li><a><img src="img/perfil.jpg" width="42px" height="36px" /></a>
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


<?php
error_reporting(E_ALL ^ E_NOTICE);
if(empty($user)): 
$mensaje = "Debe iniciar sesión para acceder";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = '../login.php';";
echo "</script>"; 
else:
endif; ?>



  
  
       <div id="busqueda">
        <form method="POST" action="search.php" class="form_box">
        <input type="search" name="search" id="search" placeholder="Buscar por nombre">
        <input type="search" style=" border: 0;background: none;margin: 20px auto;text-align: center;border: 2px solid #524949;
        padding: 6px 2px;width: 200px;outline: none;color: black;margin-left: 36px;border-radius: 16px;transition: 0.25s;"            
        name="search_zona" id="search_zona" placeholder="Buscar por zona de trabajo">
        <input type="search" name="search_seg" id="search_seg" placeholder="Buscar por seguro">
        <button type="submit" value="Submit" style="position: relative;
    
    padding: 10px 10px;
    border-radius: 6px;
    text-align: center;
    font-weight: bold;
    width: 100px;
    height: 40px;
    margin-left: 780px;
    margin-top: -50px;

    
    overflow: hidden;
    color:rgba(255,255,255,1);
    cursor: pointer;
    letter-spacing: 2px;
    box-shadow:inset 0 0 0 1px rgba(0,0,0,0.1);
    text-decoration: none;
    transition: all ease 0.5s;
    background:#328dd8;">
            Buscar
        </button>
      </form>
      </div>
    
    <div class="col-md-3 col-md-offset-3" id="result" style="position: absolute; margin-left: 20px; margin-top: 160px;">

<?php

//if(!isset($_POST['search'])) exit('No se recibió el valor a buscar');
//$search_seg = $_POST['search_seg'];

require_once 'functions/conn.php';
include_once "functions/rating_con.php";

function search()
{
  $mysqli = getConnexion();




  $search = $mysqli->real_escape_string($_POST['search']);
  $search_seg = $mysqli->real_escape_string($_POST['search_seg']);
  $search_zona = $mysqli->real_escape_string($_POST['search_zona']);
  
  $query = "SELECT id, nombre, apellido, email, foto,seguro, puntos, votos, zona FROM mecanico WHERE (nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR CONCAT_WS(' ', nombre, apellido ) LIKE  '%$search%') AND seguro LIKE '%$search_seg%' AND zona LIKE '%$search_zona%' ORDER BY puntos DESC";

  $res = mysqli_query($mysqli,$query); //Realiza la consulta a la base de datos
  //$rowcount=mysqli_num_rows($res);
  //printf("Result set has %d rows.\n",$rowcount);
  while ($row = mysqli_fetch_array($res)) {  //Obtiene una fila de resultados
    $calculo = ($row['puntos'] == 0) ? 0 : round(($row['puntos']/$row['votos']), 1);
    $rate_bg = (($calculo)/5)*100;
    $id = $row['id'];

    ?>

    <table cellspacing="10px">
    <tr>
    <td rowspan='4'>
      <img  src="../<?php echo $row['foto']; ?>" width="130px" height="130px" />
   
    </td>
    <td  style="padding-left: 30px"><?php echo "<b>Nombre:</b> $row[nombre] $row[apellido]" ?></td></tr>
    <tr><td  style="padding-left: 30px" ><?php echo"<b>Zona de trabajo:</b> $row[zona]" ?></td></tr>
    
    <tr><td  style="padding-left: 30px"><?php echo"<b>Compañia de Seguro:</b> $row[seguro]" ?></td></tr>
    <tr><td >

    
 


    <div class="result-container">
      <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
        <div class="rate-stars"></div>

    </div>
    </td>
    <td width="80px" style="margin-left: -50px;position: absolute;">
    <?php echo '<span>('.$row['votos'].'</span> votos)';?>

  </td>




</tr>

<tr>
  <td><a href="functions/single.php?id=<?php echo $row['id'];?>" target="_blank">  Votar </a></td>
  <td><a href="functions/perfil.php?id=<?php echo $row['id'];?>" target="_blank">Ver perfil</a></td>
</tr>


</table>

 

    
    <br>
    <br>
  
  <?php  
  };



 



}

search();

?>









    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>

</body>
</html>