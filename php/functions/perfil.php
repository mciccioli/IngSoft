<?php
	include_once "rating_con.php";
?>
<html lang="pt-BR">
<head>
	<meta charset=UTF-8>
	<title>Rubi</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="votar.js"></script> 
</head>

	<body>
<?php
	$id = (int)$_GET['id'];
	$query = $pdo->prepare("SELECT * FROM `mecanico` WHERE id = ?");
	$query->execute(array($id));
	while($row = $query->fetchObject()){
		
?>
<h1><?php echo $row->nombre." ".$row->apellido; ?> </h1>
<?php 
echo "<br>";
echo "<br>";

echo 'Email: '.$row->email; 
echo "<br>";
echo "<br>";
echo 'Nro. de teléfono: '.$row->celular; 
echo "<br>";
echo "<br>";
echo 'Género: '.$row->genero; 
echo "<br>";
echo "<br>";
echo 'Fecha de nacimiento: '.$row->fecha_nac;
echo "<br>";
echo "<br>";
echo 'DNI: '.$row->dni;
echo "<br>";
echo "<br>";
echo 'Zona de trabajo: '.$row->zona;
echo "<br>";
echo "<br>";
echo 'Seguro con el que trabaja: '.$row->seguro;
echo "<br>";
echo "<br>";
echo 'Se unió a Rubi el: '.$row->fecha_reg;







}
?>




</body>
</html>