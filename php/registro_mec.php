<?php
  require 'functions/conexion.php';
  $message = '';

  

 if (!empty($_POST['email'])) {
    $records = $conn->prepare('SELECT email FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $total_records = $records->rowcount();
   


    $message = '';
    if ($total_records > 0) {
      $message = 'Este mail ya está registrado';
    }
   
   
  else{

   $ruta = '../imagenes/'.$_FILES['imagen']['name'];
   move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

   $ruta_ver = 'imagenes/'.$_FILES['imagen']['name'];
    
    $fecha = $_POST['fecha']; 
    $inicio = strtotime($fecha); 
    $inicio = date('Y-m-d',$inicio); 

    $hoy = date("Y-m-d"); 
    
    $insert = implode(" ", $_POST['barrio']);



    $sql = "INSERT INTO mecanico (nombre, apellido, email, fecha_nac, dni, genero, celular, zona, seguro, foto, fecha_reg) VALUES (:nombre, :apellido, :email, :fecha_nac, :dni, :genero, :celular, :zona, :seguro, :foto, :fecha_reg)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':fecha_nac', $inicio);
    $stmt->bindParam(':dni', $_POST['dni']);
    $stmt->bindParam(':genero', $_POST['genero']);
    $stmt->bindParam(':celular', $_POST['celular']);
    $stmt->bindParam(':zona', $insert);
    $stmt->bindParam(':seguro', $_POST['seguro']);
    $stmt->bindParam(':foto',$ruta_ver);
    $stmt->bindParam(':fecha_reg', $hoy);

    
    if($stmt->execute()){
     $message = 'Nuevo mecanico registrado';
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





    <form action="" method="POST" enctype="multipart/form-data" class="form-box" style="width: 880px;" name="procesar" id="procesar">
        <h1 class="form-title" style="margin-top: 10px">Registrarse</h1>
        
         <div style="float: right; margin-top:10px; margin-left: -60px;">
        <input name="email" id="email" type="text" placeholder="Email"    required>
        <select class="select_style" name="genero">
            <option value="Hombre" style="background: #191919;">Hombre</option>
            <option value="Mujer" style="background: #191919;">Mujer</option>
        </select>
        <input name="seguro" id="seguro" type="text" placeholder="Compañia de Seguros">

        
    </div>


    <div style="float: center; margin-top: 50px; margin-left: 140px;">
        <input name="apellido" id="apellido" type="text" placeholder="Apellido"  required>
        <input name="dni" id="dni" type="text" placeholder="Nro. de documento"    required>
        
        

        <label style="color: white; font-size: 10px; font-weight: bold;">Zona de trabajo</label>
        <select class="select_style" name="barrio[]" required multiple style="margin-top:2px;">
            <option value="Agronomia" >Agronomia</option>
            <option value="Almagro" >Almagro</option>
            <option value="Balvanera" >Balvanera</option>
            <option value="Barracas" >Barracas</option>
            <option value="Belgrano" >Belgrano</option>
            <option value="Boedo" >Boedo</option>
            <option value="Caballito" >Caballito</option>
            <option value="Chacarita" >Chacarita</option>
            <option value="Coghlan" >Coghlan</option>
            <option value="Colegiales" >Colegiales</option>
            <option value="Constitucion" >Constitucion</option>
            <option value="Devoto" >Devoto</option>
            <option value="Flores" >Flores</option>
            <option value="Floresta" >Floresta</option>
            <option value="La Boca" >La Boca</option>
            <option value="Liniers" >Liniers</option>
            <option value="Mataderos" >Mataderos</option>
            <option value="Monserrat" >Monserrat</option>
            <option value="Monte Castro" >Monte Castro</option>
            <option value="Nuñez" >Nuñez</option>
            <option value="Palermo" >Palermo</option>
            <option value="Parque Avellaneda" >Parque Avellaneda</option>
            <option value="Parque Chacabuco" >Parque Chacabuco</option>
            <option value="Parque Chas" >Parque Chas</option>
            <option value="Parque Patricios" >Parque Patricios</option>
            <option value="Paternal" >Paternal</option>
            <option value="Pompeya" >Pompeya</option>
            <option value="Puerto Madero" >Puerto Madero</option>
            <option value="Recoleta" >Recoleta</option>
            <option value="Retiro" >Retiro</option>
            <option value="Saavedra" >Saavedra</option>
            <option value="San Cristobal">San Cristobal</option>
            <option value="San Nicolas" >San Nicolas</option>
            <option value="San Telmo" >San Telmo</option>
            <option value="Vélez Sarsfied" >Vélez Sarsfield</option>
            <option value="Versalles" >Versalles</option>
            <option value="Villa Crespo" >Villa Crespo</option>
            <option value="Villa del Parque" >Villa del Parque</option>
            <option value="Villa Luro" >Villa Luro</option>
            <option value="Villa Ortuzar" >Villa Ortuzar</option>
            <option value="Villa Riachuelo" >Villa Riachuelo</option>
            <option value="Villa Soldati" >Villa Soldati</option>
            <option value="Villa Urquiza" >Villa Urquiza</option>

</select>
</div>





        <div style="float: left; margin-left: -20px; margin-top: -290px;">
        <input name="nombre" id="nombre" type="text" placeholder="Nombre"   autofocus  required>
        <
        <label style="color: white; font-size: 10px; font-weight: bold;">Fecha de nacimiento</label>
        <input class="date_style" type="date" name="fecha" style="margin-top:2px;" value="1997-10-17" step="1" required>
        
        <input type="text" name="celular" id="celular" placeholder="Nro. de celular" required>
        <label style="color: white; font-size: 10px; font-weight: bold;">Foto perfil</label>
        <input type="file" name="imagen" id="imagen" class="imagen_style" style="background: none;
    color:white;
    border: 2px solid #3742fa;
    padding: 14px 10px;
    width: 260px;

    border-radius: 24px;
    transition: 0.25s;
    display: block;
    text-align: center;
    outline: none;
    margin: 2px auto;">  
                    
                    
                    
              
       
    </div>

   
<button type="submit" name="registrar" style="margin-top: -20px; margin-left: 600px;">Enviar</button>
    
    

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

<script src="../lib/js/jquery.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>

</body>
</html>
