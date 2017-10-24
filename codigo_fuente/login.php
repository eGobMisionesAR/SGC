<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['ingreso'])) {

	$correo = mysqli_real_escape_string($con, $_POST['correo']);
	$clave = mysqli_real_escape_string($con, $_POST['clave']);
	$result = mysqli_query($con, "SELECT * FROM usuarios WHERE correo = '" . $correo. "' and clave = '" . md5($clave) . "'");




	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_nombre'] = $row['nombre'];
		header("Location: index.php");
	} else {
		$errormsg = "Correo o clave incorrecta!!!";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ingreso de Usuarios</title>
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
				<li class="active"><a href="login.php">Ingresar</a></li>
				<li><a href="register.php">Registrarse</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Ingreso</legend>
					
					<div class="form-group">
						<label for="nombre">Correo</label>
						<input type="text" name="correo" placeholder="Su correo" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="nombre">Contraseña</label>
						<input type="password" name="clave" placeholder="Su contraseña" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="ingreso" value="Igresar" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		¿Es un usuario nuevo? <a href="register.php">Regístrese aquí</a>
		</div>
	</div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
