<?php 

include_once 'dbconnect.php';


	$clave = $_GET['clave'];

echo "clave: " . $clave . "<br>" ;

	$result = mysqli_query($con, "SELECT * FROM coordenadas WHERE identificador = '" . $clave . "'");

	if ($row = mysqli_fetch_array($result)) {

echo "posicion: " . $row['posicion'] . "<br>";



echo "<a href=\"geo:" .  $row['posicion'] . "?z=19\">"  ;
echo "<img src=\"pin.png\" width=\"512\" height=\"512\" style=\"border:0\" >";
echo "</a>";

	
	} else {
		echo "clave incorrecta";
	}

?>


