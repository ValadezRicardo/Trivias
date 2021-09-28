<?php
include_once 'database.php';
session_start();
if (isset($_SESSION["email"])) {
    session_destroy();
}

$ref = @$_GET['q'];


if (isset($_POST['submit']) && !isset($_GET['rp'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = stripslashes($email);
    $email = addslashes($email);
    $password = stripslashes($password);
    $password = addslashes($password);

    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    $result = mysqli_query($con, "SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        session_start();
        if (isset($_SESSION['email'])) {
            session_unset();
        }
        $_SESSION["name"] = 'Admin';
        $_SESSION["key"] = 'admin';
        $_SESSION["email"] = $email;
        header("location:dashboard.php?q=5" . $_SESSION["email"]);
    } else {
        echo "<center><h3><script>alert('Error.. Usuario o Contraseña incorrectos');</script></h3></center>";
        header("refresh:0;url=admin.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador | Trivias</title>
    <link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="css/form.css">
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
<?php
if(!isset($_GET["rp"])){
echo '
<body>
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <center>
                            <h5 style="font-family: Nunito, sans-serif;"></h5>
                            <h4 style="font-family: Nunito, sans-serif;">ADMINISTRADOR TRIVIAS</h4>
                        </center><br>
                        <form method="post" action="admin.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label style="font-family: Nunito, sans-serif; color: black; font-size: 14px;">Correo Electronico:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label style="font-family: Nunito, sans-serif; color: black; font-size: 14px;" class="fw">Contraseña:
                                    <a style="font-family: Nunito, sans-serif; color: red; font-size: 14px;" onclick="window.location='."'".'admin.php?rp=1'."'".'" class="pull-right">Olvide mi Contraseña?</a>
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <button style="font-family: Nunito, sans-serif;" class="btn btn-primary btn-block" name="submit">Iniciar Sesión</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>';
}
else if($_GET["rp"]==1){

    echo '<body>
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <center>
                            <h5 style="font-family: Nunito, sans-serif;"></h5>
                            <h4 style="font-family: Nunito, sans-serif;">Recupera contraseña</h4>
                        </center><br>
                        <form method="post" action="admin.php?rp=2" enctype="multipart/form-data">
                            <div class="form-group">
                                <label style="font-family: Nunito, sans-serif; color: black; font-size: 14px;">Correo Electronico:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <button style="font-family: Nunito, sans-serif;" class="btn btn-primary btn-block" name="submit">Recuperar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>';
}
else if($_GET["rp"]==2){
    $query = mysqli_query($con, "SELECT *  FROM admin WHERE email='" .$_POST["email"] ."'") or die('Error');
    $correor=$_POST["email"];
    $contraseña="";         
    $count=0;
    while ($row2 = mysqli_fetch_array($query)) {
        $correor=$row2["email"];
        $contraseña=$row2["password"];
        $count++;
    }

    $_SESSION["countcorreo"] = $count;
    $_SESSION["contraseña"] = $contraseña;
    $_SESSION["correor"] = $correor;
    echo '<body>
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <center>
                            <h5 style="font-family: Nunito, sans-serif;"></h5>
                            <h4 style="font-family: Nunito, sans-serif;">Recupera contraseña</h4>
                        </center><br>
                        <form method="post" action="admin.php?rp=2" enctype="multipart/form-data">
                            <div class="form-group">
                                <label style="font-family: Nunito, sans-serif; color: black; font-size:14px;">Estamos procesando su petición.</label>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>';
    header("refresh:0;url=admin.php?rp=correo");
}

else if($_GET["rp"]=='correo'){
    if($_SESSION["countcorreo"]>0){

    include_once('PHPMailer.php');
    include_once('SMTP.php');

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $correor = $_SESSION["correor"];
    $contrasena = $_SESSION["contraseña"];

    $date = getdate();
    $stringgate = $date["year"] . '-' . $date["mon"] . '-' . $date["mday"];
    $body = '<div class="row">
        <h4>Correo:' .  $correor . '</h4>
        <h4>Contraseña:' . $contrasena . '</h4>';
    echo '<div class="hide">';
        $mail->IsSMTP();
        $mail->isHTML(true);
        //$mail->Host = 'tls://173.194.67.108:587';
        // $mail->Host = 'tls://64.233.168.109:587';
        // $mail->Host = 'tls://smtp.gmail.com:587';
        //$mail->Host = 'smtp.gmail.com:587';
        $mail->Host = 'box893.bluehost.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPDebug  = 2;
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;
        $mail->Priority = 1;
        $mail->Username = $correo;
        $mail->Password = $pass;
        $mail->SetFrom($correo, "Trivias");
        $mail->Subject = 'Recuperar Contraseña';
        $mail->MsgHTML($body);
        //$mail->Timeout  = 40; // set the timeout (seconds)
        //$mail->dsn = 'NEVER';
        //$mail->SMTP_BLOCK = '0';
        $mail->AddAddress($correor, '');
        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
        try {
            if (!$mail->Send()) {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent.';
            }
            $mail->SmtpClose();
        } catch (Exception $e) {
            $mail->SmtpClose();
        }
    echo '</div>';
    }

    echo '<body>
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <center>
                            <h5 style="font-family: Nunito, sans-serif;"></h5>
                            <h4 style="font-family: Nunito, sans-serif;">Recupera contraseña</h4>
                        </center><br>
                        <form method="post" action="admin.php?rp=2" enctype="multipart/form-data">
                            <div class="form-group">
                                <label style="font-family: Nunito, sans-serif; color: black; font-size:14px;">Tu contraseña sera enviada al correo.</label>
                            </div>
                            <a class="btn btn-primary" onclick="window.location=' . "'" . '/trivias/admin.php' . "'" . '">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>';
}   
?>
    <script src="js/jquery.js"></script>
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
</body>

</html>