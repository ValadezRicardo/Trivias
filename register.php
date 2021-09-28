<?php
include("database.php");
session_start();
$mysqli = new mysqli('localhost','festerdi_usrtriv2','Trivias1234$','festerdi_trivias2');

if (isset($_POST['submit'])) {


	$name = $_POST['name'];
	$name = stripslashes($name);
	$name = addslashes($name);
	$_SESSION['name'] = $name;



	$email = $_POST['email'];
	$email = stripslashes($email);
	$email = addslashes($email);

	$encuesta_id = $_POST['encuesta_id'];
	$encuesta_id = stripslashes($encuesta_id);
	$encuesta_id = addslashes($encuesta_id);

	$telefono = $_POST['telefono'];
	$telefono = stripslashes($telefono);
	$telefono = addslashes($telefono);

	$experiencia = $_POST['experiencia'];
	$experiencia = stripslashes($experiencia);
	$experiencia = addslashes($experiencia);

	$actividad = $_POST['actividad'];
	$actividad = stripslashes($actividad);
	$actividad = addslashes($actividad);

	// $imagen = $_POST['imagen'];

	$tituloencuesta = '';
	// $password = $_POST['password'];
	// $password = stripslashes($password);
	// $password = addslashes($password);

	// $quiz_title = $_POST['quiz_title'];
	// $quiz_title = stripslashes($quiz_title);
	// $quiz_title = addslashes($quiz_title);

	// $quiz_title = $_POST['quiz_title'];
	// $quiz_title = stripslashes($quiz_title);
	// $quiz_title = addslashes($quiz_title);

	// $str = "SELECT email from user WHERE email='$email'";
	// $result = mysqli_query($con, $str);

	// if ((mysqli_num_rows($result)) > 0) {
	// 	echo "<center><h3><script>alert('Lo siento.. el correo ya fue registrado!!');</script></h3></center>";
	// 	header("refresh:0;url=login.php");
	// } else {
	// $str = "insert into user set name='$name',email='$email',password='$password',college='$college'";
	// if ((mysqli_query($con, $str)))
	// 	echo "<center><h3><script>alert('Felicidades .. ¡¡Te has registrado exitosamente!!');</script></h3></center>";
	// header('location: welcome.php?q=1');

	$_SESSION['email'] = $email;
	$_SESSION['encuesta_id'] = $encuesta_id;
	$_SESSION['telefono'] = $telefono;
	$_SESSION['experiencia'] = $experiencia;
	$_SESSION['actividad'] = $actividad;

	// echo $_SESSION['name'].'<br/>';
	// echo $_SESSION['email'].'<br/>';
	// echo $_SESSION['encuesta_id'].'<br/>';
	// echo $_GET['step'];


	$query = $mysqli->query("SELECT * FROM encuesta WHERE id=$encuesta_id");
	while ($valores = mysqli_fetch_array($query)) {
		$tituloencuesta = $valores["titulo"];
		$_SESSION['tituloencuesta'] = $tituloencuesta;
		$_SESSION['ponente'] = $valores["ponente"];
		$_SESSION['fecha'] = $valores["fecha"];
		$_SESSION['imagen'] = $valores["imagen"];
		// echo $valores["titulo"].'<br/>';;
	}



	// }	
}

// Conexión la base de datos

?>

<!DOCTYPE html>
<html>


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registro | Trivias</title>
	<link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
	
	<link rel="stylesheet" href="css/form.css">	
    <link rel="icon" type="image/png" href="favicon.png">
	<style type="text/css">
		body {
			width: 100%;
			background: url("image/bkg.jpg");
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>
</head>

<body>
	<header>
		<div class="titulo">
			<a href="https://fester-distribuidores.com/trivias/" target="_self"><img src="image/logoFester.png" alt="Fester México" width="200"></a>
		</div>
	</header>
	<section class="login first grey">
		<div class="container">
			<div class="box-wrapper">
				<div class="box box-border">
					<div class="box-body">

						<?php
						if (@$_GET['step'] != 1 && @$_GET['step'] != 2) {
							echo '<center>
							<h5 style="font-family: Nunito,sans-serif;">Responde la Trivia</h5>
						</center><br>
						<form method="post" action="register.php?step=1" enctype="multipart/form-data">
							<div class="form-group">
							';

							$_SESSION["imagenes"] =[];
							$query = $mysqli->query("SELECT * FROM encuesta ");
							
							$datos=[];
							while ($valores = mysqli_fetch_array($query)) {
								$data["id"]=$valores["id"];
								$data["imagen"]=$valores["imagen"];
								$data["titulo"]=$valores["titulo"];
								array_push($datos,$data);
							}

							echo '<div style="text-align:center">';
							foreach($datos as $valor){
								
								echo '<img style="display:none;max-width: 250px; max-height: 200px; " data-id="'.$valor["id"].'" src="data:image/png;base64,'.base64_encode($valor["imagen"]) .'"/>';

							}
							echo '</div><label style="font-family:Nunito,sans-serif; color: black; font-size: 14px; margin-top:30px;">Nombre del Webinar:</label>								
							';
							echo '<select style="font-family:Nunito,sans-serif" name="encuesta_id" id="encuesta_id" class="form-control" required>';
							foreach ($datos as $valores) {
								echo '<option value="' . $valores["id"] . '" >' . $valores["titulo"] . '</option>';
							}

					
							echo '	</select>
							</div>
							<div class="form-group">
								<label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Nombre completo:</label>
								<input type="text" name="name" class="form-control" required />
							</div>
							<div class="form-group">
								<label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Correo electrónico:</label>
								<input type="email" name="email" class="form-control" required />
							</div>
							<div class="form-group">
								<label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Teléfono:</label>
								<input type="text" name="telefono" class="form-control" required />
							</div>
							<div class="form-group">
								<label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Actividad:</label>
								<input type="text" name="actividad" class="form-control" required />
							</div>
							<div class="form-group">
								<label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Años de experiencia:</label>
								<input type="text" name="experiencia" class="form-control" required />
							</div>
							<div style="text-align:center">
								<img src="" id="encuestasimg" />
							</div>
							
							<div class="form-group text-right">
								<button class="btn btn-primary btn-block" name="submit">Iniciar</button>
							</div>
						</form>';
						

						}

						if (@$_GET['step'] == 1) {
							$querycount  = $mysqli->query('SELECT count(*) count FROM encuetaresuelta WHERE email="' . $_SESSION['email'] . '" and encuesta_id=' . $_SESSION['encuesta_id']);

							while ($valores = mysqli_fetch_array($querycount)) {
								if ($valores["count"] > 0) {
									echo '<script>(function(){alert("ESTA TRIVIA YA FUE CONTESTADA POR ESTE USUARIO");window.location="/trivias/register.php"})()</script>';
								}
							}
							$query = $mysqli->query("SELECT * FROM pregunta WHERE encuesta_id=$encuesta_id");
							$query2 = $mysqli->query("SELECT * FROM encuesta WHERE id=$encuesta_id");
							while ($valores = mysqli_fetch_array($query2)) {
								$_SESSION["tiempo"] = $valores["tiempo"];
								$_SESSION["imagen"]= $valores["imagen"];
							}
							$chide="";

							if($_SESSION["imagen"]==''){
								$chide="hide";
							}

							echo '<center>
							<h4 style="font-family: Nunito,sans-serif; color: #1c75bb;
    font-weight: bold; font-size: 20px; margin-bottom: 5px !important;">' . $_SESSION['tituloencuesta'] . '</h4>
							
							<h4 class="'.$chide.'" style="font-family: Nunito,sans-serif;"><img style="max-width: 250px; max-height: 200px;" src="data:image/png;base64,'. base64_encode($_SESSION["imagen"]) .'"></h4>
							<h5 style="font-family: Nunito,sans-serif;"><b>Ponente:<b/>&nbsp;' . $_SESSION['ponente'] . '</h5>
							<h5 style="font-family: Nunito,sans-serif;"><b>Fecha:<b/>&nbsp;' . $_SESSION['fecha'] . '</h5>
							
							</center><form method="post" action="register.php?step=2" enctype="multipart/form-data">
							
							
							';

							$i = 0;
							while ($valores = mysqli_fetch_array($query)) {
								$image=base64_encode($valores["imagen"]);
								$chide="";
								if($image==''){
									$chide="hide";
								}
								echo '<div class="form-group display display' . $i . '">
								<h4 style="font-family: Nunito,sans-serif;"><b>Tiempo Restante: <span id="cronometro">' . $_SESSION['tiempo'] . '</span> seg</b></h4>
										<hr style="border-color: #000; !important">
										<div class="'.$chide.'" style=" text-align: center; ">
										<img src="data:image/png;base64,'.$image.'" style="max-width: 250px;max-height: 200px;">
								</div>
										<br/>
										
										<label style="font-family:Nunito,sans-serif">' . $valores["texto"] . ':</label> <br/>';
								$_SESSION['pregunta_id'] = $valores["id"];
								$pregunta_id = $valores["id"];
								switch ($valores["preguntatipo_id"]) {
									case 1: {
											$query2 = $mysqli->query("SELECT * FROM opcion WHERE encuesta_id=$encuesta_id and pregunta_id=$pregunta_id");

											while ($valores2 = mysqli_fetch_array($query2)) {
												echo '<input required font-weight: bold;" type="radio" name="ans' . $i . '" value="' .  $valores2["texto"] . '">&nbsp;' . $valores2["texto"] . '<br /><br />';
											}
										}
										break;
									case 2:
										echo '<input type="text" name="ans' . $i . '" class="form-control" required />';
										break;
									case 3:
										echo '<select name="ans' . $i . '" class="form-control" required>
												<option value="Si">Si</option>
												<option value="No">No</option>
											 </select>';
										break;
								}
								echo '
									<br/>
									<button type="submit" class="btn btn-primary btn-submit" style="float:right;">Finalizar</button>
									<a class="btn btn-primary btn-siguiente" style="float:right;" onclick="siguientePregunta()">Siguiente</a>
									<a class="btn btn-primary btn-anterior" style="float:right;" onclick="preguntaanterior()">Anterior</a>
																		</div>';
								$i++;
							}
							echo ' 
							<input class="hide" name="name" value="' . $_SESSION['name'] . '"/>
							</form>
							<script> 
							var time="' . $_SESSION["tiempo"] . '";

					
							(function(){
								
								setTimeout(function(){ $("#cronometro").text($("#cronometro").text()-1); avanzaunsegundo();}, 1000);

							})();

							function avanzaunsegundo(){
						
								if($("#cronometro").text()-1<0){
									for(var i=0;i< $("[name^=ans]").length;i++){$("[name^=ans]")[i].required=false;}
									alert("El tiempo termino")
									$("[type=submit]").click();
								}
								else{time=($("#cronometro").text()-1);
									setTimeout(function(){ $("#cronometro").text($("#cronometro").text()-1); avanzaunsegundo();}, 1000);
								}
							};
							</script>';
						}

						if (@$_GET['step'] == 2) {
							
							$query = $mysqli->query("select puntuajeC,puntuajeE,e.id,pregunta_id,o.texto from pregunta p
							left join opcion o on p.id=o.pregunta_id
							left join encuesta e on e.id =p.encuesta_id
							where e.id=" . $_SESSION['encuesta_id'] . " and o.escorrecta=1
							");

							$querynext = $mysqli->query('select IFNULL(max(id),0) +1 nextid from encuetaresuelta');
							$nextid = 0;
							while ($valores = mysqli_fetch_array($querynext)) {
								$nextid = $valores["nextid"];
							}
							
							$contadorpreguntas = 0;
							$contadorC = 0;
							$contadorE = 0;
							$puntuajeC = 0;
							$puntuajeE = 0;
							$puntuaje = 0;
							while ($valores = mysqli_fetch_array($query)) {
								$puntuajeC = $valores["puntuajeC"];
								$puntuajeE = $valores["puntuajeE"];

								if (isset($_POST["ans" . $contadorpreguntas])) {
									$preguntasresueltaquery = mysqli_query($con, "INSERT INTO `preguntaresuelta`(`pregunta_id`, `respuesta`, `encuestaresuelta_id`) 
									VALUES ('" . $valores["pregunta_id"] . "','" . $_POST["ans" . $contadorpreguntas] . "'," . $nextid . ")");
									if ($_POST["ans" . $contadorpreguntas] == $valores["texto"]) {
										$contadorC++;
									} else {
										$contadorE++;
									}
								} else {
									$preguntasresueltaquery = mysqli_query($con, "INSERT INTO `preguntaresuelta`(`pregunta_id`, `respuesta`, `encuestaresuelta_id`) 
									VALUES ('" . $valores["pregunta_id"] . "',''," . $nextid . ")");
									$contadorE++;
								}
								$contadorpreguntas++;
							}

							$puntuaje = ($contadorC * $puntuajeC) - ($contadorE * $puntuajeE);
							$email = $_SESSION['email'];
							$telefono = $_SESSION['telefono'];
							$actividad = $_SESSION['actividad'];
							$experiencia = $_SESSION['experiencia'];
							

							$encuestaresueltaquery = mysqli_query($con, "INSERT INTO encuetaresuelta(`email`, `encuesta_id`, `puntuaje`,nombre,telefono,actividad,experiencia) VALUES('" . $email . "','" . $_SESSION['encuesta_id'] . "'," . $puntuaje . ",'" . $_SESSION['name'] . "','".$telefono."','".$actividad."','".$experiencia."')");

							include_once('PHPMailer.php');
							include_once('SMTP.php');

							$mail = new PHPMailer();
							$mail->CharSet = 'UTF-8';

							$date = getdate();
							$stringgate = $date["year"] . '-' . $date["mon"] . '-' . $date["mday"];
							$body = '<div class="row">
							<h4>Nombre:' . $_POST['name'] . '</h4>
							<h4>Fecha:' . $stringgate . '</h4>
							<h4>Nombre Webinar:' . $_SESSION['tituloencuesta'] . '</h4>
							<table class="table table-striped title1" style="font-size:20px;font-weight:1000;">
							<tr style="color:#1C75bb"><td>Total de preguntas</td><td>' . $contadorpreguntas . '</td></tr>
							<tr style="color:#99cc32"><td>Correctas&nbsp;</td><td>' . $contadorC . '</td></tr> 
							<tr style="color:red"><td>Incorrectas&nbsp;</td><td>' . $contadorE . '</td></tr>
							<tr style="color:#1C75bb"><td>Puntuación&nbsp;</td><td>' . $puntuaje . '</td></tr>
							</table>';
							echo '<div class="hide">';
							// $mail->IsSMTP();
							// $mail->isHTML(true);
							// $mail->Host = 'box893.bluehost.com';							
							// $mail->SMTPSecure = 'ssl';					
							// $mail->Protocol = 'mail';
							// $mail->SMTPAutoTLS = false;
							// $mail->Port = 465;
							// $mail->SMTPDebug  = 2;
							// $mail->Mailer = "smtp";
							// $mail->SMTPAuth = false;
							// $mail->Priority = 1;	
							// $mail->Username = $correo;
							// $mail->Password = $pass; 
							// $mail->SetFrom($correo, "Trivias");
							// $mail->Subject = 'Resultados de trivia';
							// $mail->MsgHTML($body);		
							// //$mail->Timeout = 80;
							// //$mail->dsn = 'NEVER';		
							// $mail->AddAddress($correo,$correocc, '');
							// $mail->smtpConnect([
							// 	'ssl' => [
							// 		'verify_peer' => false,
							// 		'verify_peer_name' => false,
							// 		'allow_self_signed' => true
							// 	]
							// ]);
							// try {
							// 	if (!$mail->Send()) {
							// 		echo 'Message was not sent.';
							// 		echo 'Mailer error: ' . $mail->ErrorInfo;
							// 	} else {
							// 		echo 'Message has been sent.';
							// 	}
							// 	$mail->SmtpClose();
							// } catch (Exception $e) {
							// 	$mail->SmtpClose();
							// }
                                                                                                                                                                        
							echo '</div><center>
							<h4 style="font-family: Nunito,sans-serif; font-weight: bold; margin-bottom: 0px !important;">' . $_SESSION['tituloencuesta'] . '</h4>
							<h5 style="font-family: Nunito,sans-serif;">Resultados:</h5>
							</center><br><form method="post" action="register.php" enctype="multipart/form-data">
								<table class="table table-striped title1" style="font-size:20px;font-weight:1000;">
									<tr style="color:#1c75bb"><td>Total de preguntas</td><td>' . $contadorpreguntas . '</td></tr>
									<tr style="color:#99cc32"><td>Correctas&nbsp;</td><td>' . $contadorC . '</td></tr> 
									<tr style="color:red"><td>Incorrectas&nbsp;</td><td>' . $contadorE . '</td></tr>
									<tr style="color:#1c75bb"><td>Puntuación&nbsp;</td><td>' . $puntuaje . '</td></tr>
								</table>
							';


							echo '<button type="submit" class="btn btn-primary" style="margin-bottom: 10px; float: right;">Contestar otra trivia</button>
									<br/>
							</form>'; 
						}

						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<a href="https://www.henkel.mx/privacy-statement?pageID=560414" target="_blank">AVISO DE PRIVACIDAD</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.henkel.mx/" target="_blank">HENKEL</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.fester.com.mx/es.html" target="_blank">FESTER</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desarrollo web <a href="https://doos.com.mx/" target="_blank">DOOS CG&D</a>
	</footer>
	<script src="js/jquery.js"></script>
	<script src="scripts/bootstrap/bootstrap.min.js"></script>
	<script>
	
		var display = 0;
		(function() {

			$(".display").hide();
			$(".display" + display).show();
			$(".btn-anterior").hide();
			if ($('[name^="ans"]').length > 1) {
				$(".btn-submit").hide();
			} else {
				$(".btn-siguiente").hide();
			}
			$('img[data-id="'+$('#encuesta_id').val()+'"]').show();

			$('#encuesta_id').change(function(){
				$('img[data-id]').hide();
				$('img[data-id="'+$('#encuesta_id').val()+'"]').show();
			});

		})();

		function siguientePregunta() {
			if ($("[name=ans" + display + "]").val() == "") {
				$("[type=submit]").click();
				return;
			}

			if (display + 1 < $(".display").length) {
				if (display + 1 == $(".display").length - 1) {
					$(".btn-siguiente").hide();
					$(".btn-submit").show();
				}
				$(".btn-anterior").show();
				display++;

				$(".display").hide();
				$(".display" + display).show();
				console.log(display);
			}

		}

		function preguntaanterior() {
			if (display - 1 > -1) {
				if (display == 1) {
					$(".btn-anterior").hide();
				}
				display--;
				$(".btn-submit").hide();
				$(".btn-siguiente").show();
				$(".display").hide();
				$(".display" + display).show();
				console.log(display);
			}

		}
	</script>

</body>

</html>