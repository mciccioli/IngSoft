<?php
$texto=$_POST["comentario"];
$destinatario=$_POST["email"];
$asunto=$_POST["asunto"];
$headers="MIME-Version:1.0\r\n";
$headers.="Content-type: text\html; charset=iso-8859-1\r\n";
$headers.="From: Rubi < martinciccioli97@gmail.com >\r\n";
$exito=mail($destinatario,$asunto,$texto,$headers);
if($exito){
	echo "Mensaje enviado con exito";
} else {
	echo "Ha habido un error";
}
?>
