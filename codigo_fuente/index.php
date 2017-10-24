<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio | Gestión de Coordenadas</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Cambiar navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Gestión de Coordenadas</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text">Registrado como <?php echo $_SESSION['usr_nombre']; ?></p></li>
				<li><a href="logout.php">Salir</a></li>
				<?php } else { ?>
				<li><a href="login.php">Ingresar</a></li>
				<li><a href="register.php">Registrarse</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<?php if (isset($_SESSION['usr_id'])) 
if(isset($_SESSION['usr_id'])!="") {
echo "Redirigiendo al módulo de grabación de coordenadas ...";
header("Location: graba_coordenadas.php");
}
?>


<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

