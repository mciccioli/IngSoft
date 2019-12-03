<?php
  require 'functions/database.php';
  $message = '';

  

 if (!empty($_POST['email']) && !empty($_POST['usuario'])) {
    $records = $conn->prepare('SELECT email FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $total_records = $records->rowcount();
    $records2 = $conn->prepare('SELECT usuario FROM users WHERE usuario = :usuario');
    $records2->bindParam(':usuario', $_POST['usuario']);
    $records2->execute();
    $total_records2 = $records2->rowcount();
    $message = '';
    if ($total_records > 0) {
      $message = 'Este mail ya está registrado';
    }
    elseif ($total_records2 > 0) {
    	$message = 'Este usuario ya está registrado';
    }
  else {


    $ruta = '../imagenes/'.$_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

    $ruta_ver = 'imagenes/'.$_FILES['imagen']['name'];

   $sql = "INSERT INTO users (nombre,email, usuario, celular, password, foto) VALUES (:nombre, :email, :usuario, :celular, :password, :foto)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $stmt->bindParam(':celular', $_POST['celular']);
    $password = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':foto',$ruta_ver);
    if($stmt->execute()){
     $message = 'Nuevo usuario creado';
    }
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
    <link rel="stylesheet" href="../css/registro_style.css">

   

</head>



<body>

 <?php if(!empty($message)): 
 echo '<script type="text/javascript">alert("'.$message.'"); window.close();</script>';
 endif; ?>




    <form action="" method="POST"    enctype="multipart/form-data"    class="form-box" name="procesar" id="procesar">
        <h1 class="form-title">Registrarse</h1>
        
        <div style="float: left;";>
        <input name="nombre" id="nombre" type="text" placeholder="Nombre Completo"   autofocus  required>
        <input name="usuario" type="text" placeholder="Usuario" required>
        <input type="text" name="celular" id="celular" placeholder="Nro. de telefono" required> 
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
        <label style="color: white; font-size: 10px; font-weight: bold;">Foto perfil</label>
        <input type="file" name="imagen" id="imagen" class="imagen_style" style="background: none;
    color:white;
    border: 2px solid #3742fa;
    padding: 14px 10px;
    width: 200px;

    border-radius: 24px;
    transition: 0.25s;
    display: block;
    text-align: center;
    outline: none;
    margin: 2px auto;">


    </div>

    <div style="float: right;";>
        <input name="email" id="email" type="text" placeholder="Email"    required>
        <input class="date_style" type="date" name="fecha" placeholder="Fecha de nacimiento" value="1997-10-17" step="1" required>
         <select class="select_style">
            <option value="varon" style="background: black;">Hombre</option>
            <option value="mujer" style="background: black;">Mujer</option>
        </select>
        <input type="password" id="repcontrasena" name="repcontrasena" placeholder="Repita la contraseña" required>
    </div>

        <button type="submit" name="registrar" style="margin-left: 300px; position: absolute;">Enviar</button>
    </form>


     <script type="text/javascript">
	function validarEmail(email) 
	{
	    var re = /\S+@\S+\.\S+/;
	    return re.test(email);
	}
		var form = document.procesar;
	document.procesar.onsubmit = function(e){
		var ready = true;


		function validarCelular(tel) {
				var test = /^(?:(?:00)?549?)?0?(?:11|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/;
				var telReg = new RegExp(test);
				return telReg.test(tel);
			}

			if(!validarCelular(form.celular.value)){
				alert("El celular no tiene un formato valido!");
					form.celular.focus();
					e.preventDefault();	
			}
		
		
		if(ready){
			if(validarEmail(form.email.value)){
				if(form.contrasena.value==form.repcontrasena.value){
					ready=true;
				}else{
					ready=false;
					alert("El password y la confirmacion no coinciden");
					form.contrasena.focus();
					e.preventDefault();
				}		
			}else {
					alert("El email no tiene un formato valido!");
					form.email.focus();
					e.preventDefault();			
			}
		}
	}
</script>

</body>
</html>
