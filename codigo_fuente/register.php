<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
	$correo = mysqli_real_escape_string($con, $_POST['correo']);
	$clave = mysqli_real_escape_string($con, $_POST['clave']);
	$clave2 = mysqli_real_escape_string($con, $_POST['clave2']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$nombre)) {
		$error = true;
		$nombre_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$correo_error = "Ingrese un correo válido";
	}
	if(strlen($clave) < 6) {
		$error = true;
		$clave_error = "La contraseña debe tener al menos 6 caracteres";
	}
	if($clave != $clave2) {
		$error = true;
		$clave2_error = "Las contraseñas no coinciden";
	}
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO usuarios(nombre,correo,clave) VALUES('" . $nombre . "', '" . $correo . "', '" . md5($clave) . "')")) {
			$successmsg = "Registrado Correctamente! <a href='login.php'>Click aquí para ingresar</a>";
		} else {
			$errormsg = "Error en el registro. ...Pruebe otra vez";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro de Ususarios</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Cambiar navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Gestión de Coordenadas</a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php">Login</a></li>
				<li class="active"><a href="register.php">Sign Up</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formregistro">
				<fieldset>
					<legend>Registro de Usuarios</legend>

					<div class="form-group">
						<label for="name">Nombre</label>
						<input type="text" name="nombre" placeholder="Nombre Completo" required value="<?php if($error) echo $nombre; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Correo</label>
						<input type="text" name="correo" placeholder="Correo" required value="<?php if($error) echo $correo; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($correo_error)) echo $correo_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Contraseña</label>
						<input type="password" name="clave" placeholder="Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($clave_error)) echo $clave_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Confirmar Contraseña</label>
						<input type="password" name="clave2" placeholder="Confirmar Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($clave2_error)) echo $clave2_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Registrarse" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		¿Ya está registrado? <a href="login.php">Ingrese aquí</a>
		</div>
	</div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



