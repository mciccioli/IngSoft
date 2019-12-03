<?php
	include_once "rating_con.php";
?>
<html lang="pt-BR">
<head>
	<meta charset=UTF-8>
	<title>Rubi</title>
	<link href="../../css/star_style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/votar.js"></script> 
</head>

	<body>
<?php
	$id = (int)$_GET['id'];
	$query = $pdo->prepare("SELECT * FROM `mecanico` WHERE id = ?");
	$query->execute(array($id));
	while($row = $query->fetchObject()){
		$calculo = ($row->puntos == 0) ? 0 : round(($row->puntos/$row->votos), 1);
?>
<h1><?php echo $row->nombre." ".$row->apellido; ?> </h1>
<span class="ratingAverage" data-average="<?php echo $calculo;?>"></span>
<span class="article" data-id="<?php echo $id;?>"></span>

<div class="barra">
	
	<span class="stars">
<?php for($i=1; $i<=5; $i++):?>


<span class="star" data-vote="<?php echo $i;?>">
	<span class="starAbsolute"></span>
</span>
<?php 
	endfor;
	
}
?>
</body>
</html>