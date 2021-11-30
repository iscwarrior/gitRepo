<?php
session_start();

 $mysqli = new mysqli("localhost", "root", "root", "bdr3p0r");
 if ($mysqli->connect_error) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_error . ") " . $mysqli->connect_error;
}

// if ($_POST["bton"] == "Registrar") 
//    {
      $fechareg     = date("Y-m-d");
      $whocall      = $_POST['whocall'];
      $cargo        = $_POST['cargo'];
      $name_escuela = $_POST['nescuela'];
      
      $name_dir     = $_POST['director'];
      if($name_dir==''){$name_dir='Sin especificar';}

      $nivel_edu    = $_POST['neducativo'];
      $no_alumnos   = $_POST['nalumnos'];
      if($no_alumnos ==''){$no_alumnos=0;}

      $edo_escuela  = $_POST['estadoe'];
      $municipio    = $_POST['municipio'];
      $localidad    = $_POST['localidad'];
      
      $c_sos       = $_POST['c_sos']; // En BD es c_sos = Casos sospechosos
      $c_conf       = $_POST['c_conf']; // En BD es c_conf = Casos confirmados
      $c_otro       = $_POST['c_otro']; // En BD es c_otro = Otro motivo

      if($c_sos ==''){ $c_sos=0;}
      if($c_conf ==''){ $c_conf =0;}
      if($c_otro  ==''){ $c_otro =0;}

      $tel          = $_POST['tel'];
      $dif_resp     = $_POST['drespiracion'];
      $responsable  = $_POST["responsable"];


      $mysqli -> query ("INSERT INTO primarios (folio, fecha_reg, whocall_name, cargo_whocall, name_esc, name_dir, nivel_edu, no_alum, status_esc, municipio, localidad, c_sos, c_conf, c_otro, telefono, dif_respirar, who_captura, status_caso) values (NULL, '$fechareg' , '$whocall' , '$cargo' , '$name_escuela' , '$name_dir' , $nivel_edu , $no_alumnos , $edo_escuela , '$municipio' , '$localidad' , $c_sos , $c_conf, $c_otro,'$tel' , $dif_resp, '$responsable ',0)");

      $idFolio=mysqli_insert_id($mysqli); // obtengo el id del insert anterior 
      if($idFolio==0) {$msjR = 'No_insert';} else { $msjR ='Insert_exitoso';}  

      //$rowdir = mysqli_fetch_ass'".oc($."'dirsql);
      header("location: reg.php?id=$idFolio&msj=$msjR$capturista=$responsable ");
      //delay(8000);
      //header("location: index.php");
      // $folio = SELECT LAST_INSERT_ID($mysqli);

   //}
?>

