<?php
if(preg_match('/^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$/',$_POST['nombre'])&&preg_match('/^[\wÑñ0-9]{3,20}$/',$_POST['usuario'])&&preg_match('/^[a-zA-Z0-9_\.\-\@]{8,17}$/',$_POST['contra']))
{
	$usuario=$_POST['usuario'];
	$nom=$_POST['nombre'];
	$numero=$_POST['numero'];
	$asignatura=$_POST['asignatura'];
	$prepa=$_POST['prepa'];
	$contra=$_POST['contra'];
	$sena=$_POST['sena'];
}
$ch=str_split($contra);//proceso de codificación
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


if($contra==$sena)//proceso de guardado de información
{
	$fecha=date('Y/m/d');
	$link=MySQLi_connect("localhost","root","","prueba");
	$tildes = $link->query("SET NAMES 'utf8'");
	$SQL="INSERT INTO USUARIOS (`USUARIOS_TYPE`,`USUARIO_NOMBRE`,`USUARIO_KEY`,`USUARIO_CONTRASENIA`,`IMAGEN`,`COLOR`,`FECHA_CONECT`) VALUES ('2','$usuario','$numero','$contrasena',0,'#c79810','$fecha');";
	$SQL2="INSERT INTO PROFESORES (`USUARIO_NOMBRE`,`USUARIO_KEY`,`PROFESOR_ASIGNATURA`,`PROFESOR_PREPA`,`PROFESOR_NOMBRE`) VALUES ('$usuario','$numero','$asignatura','$prepa','$nom');";
	MySQLi_query($link,$SQL);
	MySQLi_query($link,$SQL2);
	mysqli_close($link);
	header('location:usuario.php');
}
else
{
	header('location:usuario.php');
}
?>