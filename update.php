<?php
  include_once 'database.php';
  session_start();
  $email=$_SESSION['email'];

  if(isset($_SESSION['key']))
  {
  if (@$_GET['demail'] )
    {
      $demail=@$_GET['demail'];
      $r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
      $r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
      $result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
      header("location:dashboard.php?q=1");
    }
  }

  if(isset($_SESSION['key']))
  {
  // if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='suryapinky')
  if (@$_GET['q'] == 'rmquiz')
    {
      $eid=@$_GET['eid'];
      $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
      while($row = mysqli_fetch_array($result))
      {
        $qid = $row['qid'];
        $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
        $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
      }
      $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
      header("location:dashboard.php?q=5");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addquiz')
    {
      $titulo = $_POST['name'];
      $imagen = $_POST['imagen'];
      $fecha = $_POST['fecha'];
      $tiempo = $_POST['time'];
      $puntuajeC = $_POST['right'];
      $puntuajeE = $_POST['wrong'];
      $ponente = $_POST['ponente'];
    
      $image = $_FILES['imagen']['tmp_name'];
      $imgContenido = addslashes(file_get_contents($image));
      
      $q3=mysqli_query($con,"INSERT INTO encuesta(titulo,imagen,fecha,tiempo,puntuajeC,puntuajeE,ponente) 
      VALUES(
        '$titulo',
        '$imgContenido',
        '$fecha',
        '$tiempo',
        '$puntuajeC',
        '$puntuajeE',
        '$ponente'
      )");
      
       $q3=mysqli_query($con,"SELECT  id FROM  encuesta WHERE titulo= '$titulo' and fecha='$fecha' and ponente= '$ponente'");
       $idq=0;
       while($row=mysqli_fetch_array($q3) )
       {
        $idq=$row["id"];
       }
       header("location:dashboard.php?q=4&step=2&id=".$idq);
    }
  }
// && $_SESSION['key']=='suryapinky'
  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addqns' )
    {
      // $n=@$_GET['n'];
      // $na = @$_GET['na'];
      // $eid=@$_GET['eid'];
      // $ch=@$_GET['ch'];
      // $to= $n - $na;

      // for($i=1;$i<=$to;$i++)
      // {

      //   $qid=uniqid();
      //   $qns=$_POST['qns'.$i];
      //   $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
      //   $oaid=uniqid();
      //   $obid=uniqid();
      //   $ocid=uniqid();
      //   $odid=uniqid();
      //   $a=$_POST[$i.'1'];
      //   $b=$_POST[$i.'2'];
      //   $c=$_POST[$i.'3'];
      //   $d=$_POST[$i.'4'];
      //   $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
      //   $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
      //   $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
      //   $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
      //   $e=$_POST['ans'.$i];
      //   switch($e)
      //   {
      //     case 'a': $ansid=$oaid; break;
      //     case 'b': $ansid=$obid; break;
      //     case 'c': $ansid=$ocid; break;
      //     case 'd': $ansid=$odid; break;
      //     default: $ansid=$oaid;
      //   }
      //   $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
      // }

      // for ($i = $n- $na+1; $i <= $n; $i++) {
      //   $qid = uniqid();
      //   $qns = $_POST['oqns' . $i];
      //   $q3 = mysqli_query($con, "INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
      //   $oaid = uniqid();
      //   $e = $_POST['oans' . $i];

      //   $qa = mysqli_query($con, "INSERT INTO options VALUES  ('$qid','$e','$oaid')") or die('Error61');
      //   $qans = mysqli_query($con, "INSERT INTO answer VALUES  ('$qid','$oaid')");
      // }
 
      $encuesta_id=$_POST["id"];
      $preguntatexto=$_POST["oqns"];
      $preguntatipo_id=$_POST["preguntatipo_id"];
      $respuesta=$_POST["ans"];
      $image = $_FILES['imagen']['tmp_name'];
      $imgContenido = addslashes(file_get_contents($image));
      

      $qa=mysqli_query($con,"INSERT INTO pregunta(encuesta_id,texto,preguntatipo_id,imagen) VALUES('$encuesta_id','$preguntatexto','$preguntatipo_id','$imgContenido')") or die('Error61');
      $qa=mysqli_query($con,"SELECT id FROM pregunta WHERE  encuesta_id=$encuesta_id and texto='$preguntatexto' and preguntatipo_id= '$preguntatipo_id'") or die('Error63');
      $preguntaid=0;
      while($row=mysqli_fetch_array($qa))
      {
        $preguntaid=$row["id"];
      }
      switch ($preguntatipo_id) {
        case '1'://Multiple
        {
          for($i=1;$i<=6;$i++){
            if(isset($_POST["o".$i])){
              if($_POST["o".$i]!=""){
                $escorrecto=0;
                if($respuesta==$i){
                  $escorrecto=1;
                }
              $opc=$_POST['o'.$i];
              $qa=mysqli_query($con,"INSERT INTO opcion(encuesta_id,pregunta_id,texto,escorrecta) VALUES  ($encuesta_id,$preguntaid,'$opc',$escorrecto)") or die('Error62');

              }
            }
          }
        }
          break;
        case '2'://Abierta
        {

            $qa=mysqli_query($con,"INSERT INTO opcion(encuesta_id,pregunta_id,texto,escorrecta) VALUES  ($encuesta_id,$preguntaid,'$respuesta',1)") or die('Error62');
        }
            break;
        case '3'://SiNo
        {
          $qa=mysqli_query($con,"INSERT INTO opcion(encuesta_id,pregunta_id,texto,escorrecta) VALUES  ($encuesta_id,$preguntaid,'$respuesta',1)") or die('Error62');
     
        }
              break;
              
       
      }
      if($_POST["dest"]=="Guardar y Finalizar"){
        header("location:dashboard.php?q=5");
      }
      else{
        header("location:dashboard.php?q=4&step=2&id=".$_POST["id"]);
      }
     
    }
  }

  if(@$_GET['q']== 'quiz' && @$_GET['step']== 2)
  {
    $eid=@$_GET['eid'];
    $sn=@$_GET['n'];
    $total=@$_GET['t'];
    $ans=$_POST['ans'];
    $qid=@$_GET['qid'];
    $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
    while($row=mysqli_fetch_array($q) )
    {  $ansid=$row['ansid']; }
    if($ans == $ansid)
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
      while($row=mysqli_fetch_array($q) )
      {
        $sahi=$row['sahi'];
      }
      if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $r=$row['sahi'];
      }
      $r++;
      $s=$s+$sahi;
      $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
    }
    else
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
      while($row=mysqli_fetch_array($q) )
      {
        $wrong=$row['wrong'];
      }
      if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $w=$row['wrong'];
      }
      $w++;
      $s=$s-$wrong;
      $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
    }
    $title= @$_GET['title'];;
    if($sn != $total)
    {
      $sn++;
      header("location:welcome.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total&title=$title")or die('Error152');
    }
    else if( $_SESSION['key']!='suryapinky')
    {
      $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
      }
      $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
      $rowcount=mysqli_num_rows($q);
      if($rowcount == 0)
      {
        $q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
      }
      else
      {
        while($row=mysqli_fetch_array($q) )
        {
          $sun=$row['score'];
        }
        $sun=$s+$sun;
        $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
      }
      header("location:welcome.php?q=result&eid=$eid");
    }
    else
    {
      header("location:welcome.php?q=result&eid=$eid");
    }
  }

  if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 )
  {
    $eid=@$_GET['eid'];
    $n=@$_GET['n'];
    $t=@$_GET['t'];
    $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
    while($row=mysqli_fetch_array($q) )
    {
      $s=$row['score'];
    }
    $q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
    $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
    while($row=mysqli_fetch_array($q) )
    {
      $sun=$row['score'];
    }
    $sun=$sun-$s;
    $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
    header("location:welcome.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
  }

  if(@$_GET['q']== 'deltva')
  {
    $id=@$_GET['id'];
   

    $q=mysqli_query($con,"DELETE FROM `encuesta` WHERE id='$id'" )or die('Error184');
    header("location:dashboard.php?q=5");


  }
  if(@$_GET['q']== 'deltva2')
  {
    $id=@$_GET['id'];
   

    $q=mysqli_query($con,"DELETE FROM `encuetaresuelta` WHERE id='$id'" )or die('Error184');
    header("location:dashboard.php?q=1");


  }

?>



