<?php
if(preg_match('/^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$/',$_POST['nombre'])&&preg_match('/^[\wÑñ0-9]{3,20}$/',$_POST['usuarion'])&&preg_match('/^[a-zA-Z0-9_\.\-\@]{8,17}$/',$_POST['contra']))
{
	$nombre=$_POST['nombre'];
	$usuario=$_POST['usuarion'];
	$numero=$_POST['numero'];
	$grupo=$_POST['grupo'];
	$contra=$_POST['contra'];
	$sena=$_POST['sena'];
}
$ch=str_split($contra);
	$contrasena="";
	for($x=0;$x<5;$x++)
	{
		$wi=rand(0,9);
		$contrasena=$contrasena.$wi;
	}
	$carac=0;
	foreach($ch as $p)
	{
		$nu=ord($p);
		$carac+=$nu;
	}
	$contrasena=$contrasena.$carac;
	for($x=0;$x<strlen($contra);$x++)
	{
		$wi=(ord($ch[$x])>>1)-4;
		$contrasena=$contrasena.chr($wi);
	}
	
	$cad=array();
	$arreglo=array();
	$cont=strlen($contra);
	for($i=0;$i<$cont;$i++)
	{
		$car=substr($contra,$i,1);
		array_push($cad,$car);
	}
	$mul=ceil($cont/5);
	$contadorpal=0;
	for($x=0;$x<$mul;$x++)
	{
		$eje=array();
		for($y=0;$y<5;$y++)
		{
			if($contadorpal<$cont)
				array_push($eje,$cad[$y]);
			else
				array_push($eje,'');
			$contadorpal++;
		}
		array_push($arreglo,$eje);
		for($g=0;$g<5;$g++)
			if($cad!='\0')
				array_shift($cad);
	}
	$grr=array();
	for($y=0;$y<5;$y++)
		for($x=0;$x<$mul;$x++)
			array_push($grr,$arreglo[$x][$y]);
	$grr=implode("",$grr);
	$h='Texto: '.$contra.'<br/>playfair("'.$grr.'",5)';
	$cant=ceil(strlen($grr)/2);
	$contrasena=$contrasena.substr($grr,0,$cant);




if($contra==$sena)
{
	$fecha=date('Y/m/d');
	$link=mysqli_connect("localhost","root","","prueba");
	$tildes = $link->query("SET NAMES 'utf8'");
	$SQL='INSERT INTO usuarios (USUARIOS_TYPE,USUARIO_NOMBRE,USUARIO_KEY,USUARIO_CONTRASENIA,COLOR,IMAGEN,FECHA_CONECT) values (1,"'.$usuario.'",'.$numero.',"'.$contrasena.'","#c79810",0,"'.$fecha.'")';
	$SQL2='INSERT INTO alumnos (ESTUDIANTE_NOMBRE,USUARIO_NOMBRE,USUARIO_KEY,ALUMNO_GRUPO,ALUMNO_PUNTAJE,ALUMNO_PARTIDAS) VALUES ("'.$nombre.'","'.$usuario.'",'.$numero.','.$grupo.',0,0)';
	mysqli_query($link,$SQL);
	mysqli_query($link,$SQL2);
	mysqli_close($link);
	header('location:main.php');
	
}
else
{
	header('location:main.php');
}
?>
