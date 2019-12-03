<?php
	include_once "rating_con.php";
	
		$id = (int)$_POST['id'];
		$punto = (int)$_POST['punto'];

		$query = $pdo->prepare("SELECT votos, puntos FROM `mecanico` WHERE `id` = ?");
		$query->execute(array($id));
		while($row = $query->fetchObject()){
			$puntosUpd = ($row->puntos+$punto);
			$votosUpd = ($row->votos+1);

			$actualizar = $pdo->prepare("UPDATE `mecanico` SET `votos` = ?, `puntos` = ? WHERE `id` = ?");
			if($actualizar->execute(array($votosUpd, $puntosUpd, $id))){
				$calculo = round(($puntosUpd/$votosUpd),1);
				die(json_encode(array('average' => $calculo, 'votos' => $votosUpd)));
			}
		}
	
?>