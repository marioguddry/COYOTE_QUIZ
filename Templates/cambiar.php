<?php
	SESSION_START();
	$c=$_POST['color'];
	$enlace=mysqli_connect("localhost","Ramon","escuelaenp6","proyectof");
	if(!$enlace)
	{
		echo "No se pudo conectar".mysqli_connect_error();
	}
	else
	{
		$tildes = $enlace->query("SET NAMES 'utf8'");
		$_SESSION['color']=$c;
		$consulta='UPDATE usuarios SET COLOR="'.$c.'" WHERE USUARIO_NOMBRE="'.$_SESSION['usuario'].'"';
		mysqli_query($enlace, $consulta);
		mysqli_close($enlace);
		header('location:./usuario.php');
	}
?>