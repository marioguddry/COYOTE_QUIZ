<!DOCTYPEhtml>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewpiort" content="width=device-width, initial-scale=1"/>
		
		<title>Coyote quiz</title>
		
		<link href="../Documents/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="shortcut icon" href="../Sources/Resources/prepa 6.jpg" type="image/png"/>
		<link href="../Style/usuario.less"  rel="stylesheet/less" type="text/css">
		<script src="../Documents/less.js" type="text/javascript"></script>
		<style>
			#izquierda{
				border:1px solid black;
				height:500px;
				border-radius:7px;
				box-shadow: 5px 5px grey;
			}
			#cuer{
				padding-left:40px;
			}
		</style>
	</head>
	<body data-spy="scroll" data-target="#navegacion">
		<div class="container" id="cuer">
			<?php
			SESSION_START();
			
			if(isset($_SESSION['tipo']) && isset($_SESSION['usuario']) && isset($_SESSION['key']))
			{
				$enlace=mysqli_connect("localhost","root","","prueba");
				if(!$enlace)
					echo 'hubo un error';
				else
				{
					$lectura='SELECT IMAGEN FROM USUARIOS WHERE USUARIO_NOMBRE="'.$_SESSION['usuario'].'"';
					$image=mysqli_query($enlace,$lectura);
					$arr = array();
					while($row = mysqli_fetch_assoc($image))
					{
						foreach($row as $re)
						{
							$imagen[]=$re;
						}
					}
				}
				echo '<header>
					<nav class="navbar navbar-default navbar-fixed-top" role="navegation" id="part-top">
						<div class="row">
							<div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegacion">
										<span class="sr-only">Mostrar navegación</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a href="./usuario.php" class="navbar-brand" id="imag-unam">';
									if($imagen[0]=='0')
									{
										echo '<img src="../Sources/Resources/sombra.jpg" alt="sombra" height="140%"/>';
									}
									else
									{
										echo '<img src="data:image/jpg;base64,'.base64_encode($imagen[0]).'" height="140%"/>';
									}
									echo '</a><p id="text" class="navbar-text">'.$_SESSION['usuario'].'</p>
								</div>	
							</div>	
							<div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-6">
								<div class="collapse navbar-collapse" id="navegacion">';
									if($_SESSION['tipo']=='1')
									{
										echo '<button type="button" class="btn btn-primary navbar-btn"> Jugar </button>';
										echo ' <button type="button" class="btn btn-primary navbar-btn"> Puntajes </button>';
									}
									else
									{
										if($_SESSION['tipo']=='2')
										{
											echo '<button type="button" class="btn btn-primary navbar-btn"> Preguntas </button>';
											echo ' <button type="button" class="btn btn-primary navbar-btn"> Puntajes de alumnos </button>';
										}
										else
										{
											if($_SESSION['tipo']=='3')
											{
												echo '<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#regis_prof"> Registrar Profesores </button>';
												echo ' <a href="./coor_preguntas.php"><button type="button" class="btn btn-primary navbar-btn"> Preguntas </button></a>';
											}
											else
											{
												if($_SESSION['tipo']=='4')
												{
													echo '<button type="button" class="btn btn-primary navbar-btn"> Cuentas </button>';
													echo ' <button type="button" class="btn btn-primary navbar-btn"> Usuarios </button>';
													echo ' <button type="button" class="btn btn-primary navbar-btn"> Uso mensual </button>';
												}
											}
										}
									}
								echo ' <span class="btn-group">
									<button type="button" class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="./camb_dis.php">Diseño de página</a></li>
										<li><a href="#">Información personal</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="./main.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión</a></li>
									</ul>
								</span>
								</div>
							</div>	
						</div>
					</nav>
				</header><br><br><br><br><br><br>';
				
				
				$con= mysqli_connect("localhost","root","","prueba");
				$tildes = $con -> query("SET NAMES 'utf8'");
				$queria= "SELECT * FROM preguntas";
				$result=mysqli_query($con, $queria);
				$n=0;

						echo "<div class='row'><div class='col-lg-12 col-md-12 col-xs-12' id='tablapreg'>";
						echo "<table class='table table-hover table-bordered'><tr class='info'>";
						echo "<th>Asignatura</th><th> Unidad</th><th>Pregunta</th><th>Respuesta correcta</th><th>Respuesta1</th><th>Respuesta2</th><th>Respuesta3</th><th>Profesor</th><th>Eliminar</th><th>Agregar</th><br></tr>";
						while ($renglon=mysqli_fetch_assoc($result))
						{
						echo "<tr>";
						echo "<td>". $renglon['PREG_ASIGNATURA']. "</td>";
						echo "<td>". $renglon['PREG_UNIDAD']. "</td>";
						echo "<td>". $renglon['PREGUNTA']. "</td>";
						echo "<td>". $renglon['RES_CORRECTA']. "</td>";
						echo "<td>". $renglon['RES_UNO']. "</td>";
						echo "<td>". $renglon['RES_DOS']. "</td>";
						echo "<td>". $renglon['RES_TRES']. "</td>";
						echo "<td>". $renglon['USUARIO_DO']. "</td>";
						echo '<td><button class="btn btn-danger btn-xs" id="n'.$n.'" onclick="quitare(this)">Eliminar</button></td>';
						echo '<td><button class="btn btn-success btn-xs" id="n'.$n.'" onclick="agregare(this)">Agregar</button></td>';
						echo "</tr>";
						$n++;
						}
						echo "</table>";
						echo "</div></div>";
				}
				else
				{
					echo '<div class="row">
								<div class="jumbotron col-lg-7 col-lg-offset-1">
									<h1>Inicie sesión correctamente.</h1>
								</div>
						</div>';
				}
				mysqli_close($con);
			?>
		</div>
		<div class="modal fade" id="regis_prof" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Registrar profesor. </h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="./registro_profesor.php" >
									<div class="form-group">
									<label for="nombre" class="col-lg-3 control-label">Nombre completo: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo"  required pattern="^^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$"/>
										</div>
									</div>
									<div class="form-group">
									<label for="usuario" class="col-lg-3 control-label">Nombre usuario: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario"  required pattern="^[a-zA-Z0-9_/./-/@]{3,20}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="numero" class="col-lg-3 control-label">Clave de profesor(RFC):</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="numero" name="numero" placeholder="RFC"  required pattern="^[a-zA-Z0-9]{12,13}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="asignatura" class="col-lg-3 control-label">Asignatura:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="asignatura" name="asignatura" placeholder="Asignatura"  required pattern="^[a-zA-Zñáéíóú]{5,15}$"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Preparatoria:</label>
										<div class="col-lg-9">
											<select class="form-control" name="prepa">
											<option value="1">Preparatoria 1 "Gabino Barreda"</option>
											<option value="2">Preparatoria 2 "Erasmo C.Quinto"</option>
											<option value="3">Preparatoria 3 "Justo Sierra"</option>
											<option value="4">Preparatoria 4 "Vidal Castañeda y N."</option>
											<option value="5">Preparatoria 5 "José Vasconcelos"</option>
											<option value="6">Preparatoria 6 "Antonio Caso"</option>
											<option value="7">Preparatoria 7 "Ezequiel A Chávez"</option>
											<option value="8">Preparatoria 8 "Miguel E Schulz"</option>
											<option value="9">Preparatoria 9 "Pedro de Alba"</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra"name="contra" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,15}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="cond" class="col-lg-3 control-label">Repetir Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="sena" name="sena" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,15}"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" id="registrarse"type="submit">Registrarse</button>
									</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 navbar-fixed-bottom">
				<footer class="text-center" id="part-bottom">
					Hecho en México. Todos los derechos reservados.
					<br/>
					Créditos.
				</footer>
			</div>
		</div>
		<script src="../Documents/jquery.js"></script>
		<script src="../Documents/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="main.js"></script>
		<script type="text/javascript" src="colorChange.js"></script>
		<script type="text/javascript" src="cambio.js"></script>
	</body>
</html>
