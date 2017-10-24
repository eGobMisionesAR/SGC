<?php

session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//set validation error flag as false
$error = false;
$identificador="";


//check if form is submitted
if (isset($_POST['signup'])) {
	$coordenadas = mysqli_real_escape_string($con, $_POST['coordenadas']);


$identificador = generateRandomString();

	//name can contain only alpha characters and space
	if (!preg_match("/[0-9.,-]+$/",$coordenadas)) {
		$error = true;
		$coordenadas_error = "Solo puede contener numeros, coma y punto";
	}
	
	
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO coordenadas(identificador,posicion) VALUES('" . $identificador . "', '" . $coordenadas .  "')")) {
		} else {
			$successmsg = "Identificador: " . $identificador;		
			$errormsg = "Error grabando la coordenada. ...Pruebe otra vez";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registo de Coordenadas</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />


</head>

<body>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/clipboard.min.js"></script>


<script src="js/clipboard.js"></script>

<script>
(function(){
    new Clipboard('#copy-button');
})();
</script>

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
				<li><a href="login.php">Ingresar</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formregistro">
				<fieldset>
					<legend>Registro de Coordenadas</legend>

					<div class="form-group">
						<label for="name">Coordenadas</label>
						<input type="text" name="coordenadas" placeholder="valor de las coordenadas" required value="<?php if($error) echo $coordenadas; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($coordenadas_error)) echo $coordenadas_error; ?></span>
					</div>
					

					<div class="form-group">
						<input type="submit" name="signup" value="Guardar" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?>

<?php echo "Clave: " . $identificador; ?>
<br>
<input size=40 id="post-shortlink" value="http://nominatim.misiones.gob.ar/sgc/buscar_clave.php?clave=<?php echo $identificador ?>">
<br>
<button class="button" id="copy-button" data-clipboard-target="#post-shortlink">Copiar el Enlace</button>


</span>

			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Copie la URL Generada<br>y péguela en el mensaje a enviar
		</div>
	</div>
</div>


</body>
</html>



