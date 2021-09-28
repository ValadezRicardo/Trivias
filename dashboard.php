<?php
include_once 'database.php';
session_start();
if (!(isset($_SESSION['email']))) {
    header("location:login.php");
} else {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    include_once 'database.php';
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Trivias</title>
	<link rel="shortcut icon" type="image/png" href="image/logo.png" />    
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
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
        <link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/Spanish.json"></script>
    <script>
    $.extend( true, $.fn.dataTable.defaults, {
    "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
        } );   
    </script>
</head>

<body>
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Javascript:void(0)"><img style="margin-top: -20px;" src="image/logoFester.png" width="100" alt="Fester"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="dashboard.php?q=4">Agregar Trivia</a></li>
					<li><a href="dashboard.php?q=5">Trivias</a></li>
                    <!-- <li <?php if (@$_GET['q'] == 0) echo 'class="active"'; ?>><a href="dashboard.php?q=0">Inicio<span class="sr-only">(current)</span></a></li> -->
                    <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="dashboard.php?q=1">Registros</a></li>
                    <!-- <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="dashboard.php?q=2">Resultados</a></li> -->
                    <li class="dropdown <?php if (@$_GET['q'] == 4 || @$_GET['q'] == 5) echo 'active"'; ?>">
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo ''; ?>> <a href="logout1.php?q=dashboard.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (@$_GET['q'] == 0) {
                    echo "<h1> Bienvenido!!
					</h1>";
                }

                if (@$_GET['q'] == 2) {
                    $q = mysqli_query($con, "SELECT * FROM encuetaresuelta where encuesta_id=" . @$_GET['id']) or die('Error223');
                    echo  '<div class="txtResultado"><label style="color: white; font-size: 30px; position: absolute; left:0; margin-top:-7px;">' . $_GET["title"] . '</label></div><div class="btnDescargar"><input type="button" style="position: absolute; right:0;margin-top:-7px;" class="btn btn-primary" name="descargar" id="descargar" value="Descargar CSV" onclick="exportTableToCSV(' . "'Resultados.csv'" . ')"></div>
                   <div class="panel title"><div class="table-responsive">
                    <table class="table table-striped title1" >
                    <thead><tr style="color:red"><td><center><b>#</b></center></td><td><center><b>Nombre</b></center></td><td><center><b>Correo</b></center></td><td><center><b>Telefono</b></center></td><td><center><b>Actividad</b></center></td><td><center><b>Experiencia</b></center></td><td><center><b>Puntuacion</b></center></td><td class="accion"><center><b>Acción</b></center></td></tr></thead>';
                    $c = 0;
                    echo '<tbody>';
                    while ($row = mysqli_fetch_array($q)) {

                        echo '<tr><td style="color:#99cc32"><center><b>' . $row["id"] . '</b></center></td><td ><center><b>' . $row["nombre"] . '</b></center></td><td><center>' . $row["email"]  . '</center></td><td><center>' . $row["telefono"]  . '</center></td><td><center>' . $row["actividad"]  . '</center></td><td><center>' . $row["experiencia"]  . '</center></td><td><center>' . $row["puntuaje"] . '</center></td>
                        <td class="accion"><center><a title="Delete User" onclick="DeleteandRedirect(' . "'" . '/trivias/update.php?q=deltva2&id=' . $row["id"] . "'" . ')"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></center></td>';
                    }
                    echo '</tbody>';
                    echo '</table></div></div>';
                }
                ?>
                <?php
                if (@$_GET['q'] == 1) {
                    $result = mysqli_query($con, "SELECT er.id,er.puntuaje,er.email,e.titulo,er.nombre,er.telefono,er.actividad,er.experiencia FROM encuetaresuelta er left join encuesta e on e.id=er.encuesta_id") or die('Error');
                    echo  '<div class="txtResultado"><label style="color: white; font-size: 30px; left:0; margin-top:-10px;">Registros</label></div><div class="btnDescargar"><input type="button" class="btn btn-primary" style="position: absolute; right:0; margin-top:-30px;" name="descargar" id="descargar" value="Descargar CSV" onclick="exportTableToCSV(' . "'Log.csv'" . ')"></div>
                    <div class="panel"><div class="table-responsive"><table class="table table-striped title1"><thead>
                    <tr><th><center><b>#</b></center></th><th><center><b>Nombre</b></center></th><th><center><b>Webinar</b></center></th><th><center><b>Puntuaje</b></center></th><th><center><b>Correo</b></center></th><th><center><b>Telefono</b></center></th><th><center><b>Actividad</b></center></th><th><center><b>Experiencia</b></center></th><th class="accion"><center><b>Acción</b></center></th></tr></thead><tbody>';
                    $c = 1;
                    while ($row = mysqli_fetch_array($result)) {

                        echo '<tr><td><center>' . $row['id'] . '</center></td><td><center>' . $row['nombre'] . '
                        </center></td><td><center>' . $row['titulo'] . '</center></td><td><center>' . $row['puntuaje'] . '
                        </center></td><td><center>' . $row['email'] . '<td><center>' . $row['telefono'] . '</center></td><td><center>' . $row['actividad'] . '</center></td><td><center>' . $row['experiencia'] . '</center></td>
                        </center></td><td class="accion"><center><a title="Delete User" onclick="DeleteandRedirect(' . "'" . '/trivias/update.php?q=deltva2&id=' . $row["id"] . "'" . ')"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></center></td></tr>';
                    }
                    $c = 0;
                    echo '</tbody></table></div></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
                    echo '<div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff; margin-top: -10px;"><b>Agregar Trivia</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Titulo del Webinar" class="form-control input-md" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="imagen"></label>  
                                    <div class="col-md-12">                                       
                                        <input type="file"  name="imagen" id="imagen" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="fecha"></label>  
                                    <div class="col-md-12">                                       
                                        <input id="fecha" name="fecha" class="form-control input-md" type="date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="time" name="time" placeholder="Tiempo máximo" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="right"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="right" placeholder="Puntaje de respuesta correcta" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="wrong" name="wrong" placeholder="Puntaje por respuesta incorrecta" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>   
                                
       
                                <div class="form-group">
                                <label class="col-md-12 control-label" for="total"></label>  
                                <div class="col-md-12">
                                    <input id="ponente" name="ponente" placeholder="Ponente" class="form-control input-md" type="text">
                                </div>
                             </div>

                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Crear" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {

                    echo ' 
                        <span class="title1" style="margin-left:32%;font-size:30px; color: white;"><b>Selecciona el tipo de pregunta</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">
                        <form class="form-horizontal title1" name="form" action="update.php?q=addqns&ch=4 "  method="POST"  enctype="multipart/form-data">
                         <input style="margin-left:32%; color: white;" type="radio" id="multiple" name="preguntatipo_id" value="1">
                        <label for="multiple" style="color: white;">Opción multiple</label><br>
                        <input style="margin-left:32%; color: white;" type="radio" id="sino" name="preguntatipo_id" value="3">
                        <label for="sino" style="color: white;">Si/No</label><br>
                        <input style="margin-left:32%;" type="radio" id="abierta" name="preguntatipo_id" value="2">
                        <label for="abierta" style="color: white;">Pregunta abierta</label><br /><br />
                        <input class="hide" name="id" value="' . $_GET['id'] . '"/>
                        <input class="hide" name="dest" value="' . $_GET['id'] . '"/>
                        <input class="hide" name="oqn2" value=""/>
                        <input class="hide" name="preguntatipo_id2" value=""/>
                        <fieldset>
                        ';
                }
                echo '<script>
                $(' . "'" . 'input[type="radio"][name="preguntatipo_id"]' . "'" . ').change(function() {
                    appendPregunta($(this).val());
                });
                </script>';
                ?>

                <?php
                if (@$_GET['q'] == 5) {
                    $result = mysqli_query($con, "SELECT *  FROM encuesta ORDER BY  id DESC") or die('Error');
                    echo  '<div class="txtTrivias"><label style="color: white; font-size: 30px; left:0; margin-top: -10px;">Trivias</label></div><div class="btnDescargar"><input type="button" style="position: absolute; right:0; margin-top:-30px;" class="btn btn-primary" name="descargar" id="descargar" value="Descargar CSV" onclick="exportTableToCSV(' . "'Trivias.csv'" . ')"></div><div class="panel">
                    <div class="table-responsive"><table class="table table-striped title1" >
                        <thead><tr><td><center><b>#</b></center></td><td><center><b>Trivia</b></center></td><td><center><b>Total de preguntas</b></center></td><td><center><b>Puntaje</b></center></td><td><center><b># de veces contestada</b></center></td><td class="accion"><center><b>Acciones</b></center></td></tr></thead>';
                    $c = 1;
                    echo '<tbody>';
                    while ($row = mysqli_fetch_array($result)) {
                        $qtotalpreguntas = mysqli_query($con, "SELECT count(*) count  FROM pregunta WHERE encuesta_id=" . $row["id"]) or die('Error');
                        $qPuntuaje = mysqli_query($con, "SELECT IFNULL(SUM(puntuaje),0) puntuaje  FROM encuetaresuelta WHERE encuesta_id=" . $row["id"]) or die('Error');
                        $qNVeces = mysqli_query($con, "SELECT  count(*) count  FROM encuetaresuelta WHERE encuesta_id=" . $row["id"])  or die('Error');

                        while ($row2 = mysqli_fetch_array($qtotalpreguntas)) {
                            $totalpreguntas = $row2["count"];
                        }
                        while ($row2 = mysqli_fetch_array($qPuntuaje)) {
                            $Puntuaje = $row2["puntuaje"];
                        }
                        while ($row2 = mysqli_fetch_array($qNVeces)) {
                            $NVeces = $row2["count"];
                        }

                        echo '<tr><td><center>' . $row["id"] . '</center></td><td><center>' . $row["titulo"] . '</center></td>
                            <td><center>' . $totalpreguntas . '</center></td>
                            <td><center>' . $Puntuaje . '</center></td>
                            <td><center>' . $NVeces . '</center></td>
                            <td class="accion"><center><b>
                            <span onclick="DeleteandRedirect(' . "'" . '/trivias/update.php?q=deltva&id=' . $row["id"] . "'" . ')" class="pull-right btn sub1" style="margin:0px;background:red;color:white; margin-left: 6px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Eliminar</b></span></span>
                            <span onclick="window.location=' . "'" . '/trivias/dashboard.php?q=2&id=' . $row["id"] . '' .  '&title=' . $row["titulo"] . "'" . '"   class="pull-right btn btn-primary sub1" style="margin:0px;color:white"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Resultado</b></span></span></b></center></td></tr>';
                            
                    }
                    echo '</tbody>';
                    $c = 0;
                    echo '</table></div></div>';
                }
                ?>
            </div>
        </div>
    </div>
	<footer>
		<a href="https://www.henkel.mx/privacy-statement?pageID=560414" target="_blank">AVISO DE PRIVACIDAD</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.henkel.mx/" target="_blank">HENKEL</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.fester.com.mx/es.html" target="_blank">FESTER</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desarrollo web <a href="https://doos.com.mx/" target="_blank">DOOS CG&D</a>
	</footer>
    <script src="js/Utils.js"></script>
    <script >
        $('table').DataTable();
        $("input[type='file'][name='imagen']").change(function(){
            var tamaño=this.files[0].size;
            if(tamaño>3000000){
                alert("El tamaño de la imagen supera los 3MB");
                $("input[type='file']").val("");
            }
        })
    </script>
</body>

</html>