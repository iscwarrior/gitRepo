<?php
session_start();

 $mysqli = new mysqli("localhost", "root", "root", "bdr3p0r");
 if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$folio               = $_POST['folio'];
$b_casos             = $_POST['b_casos'];
$b_otros             = $_POST['b_otros'];
$b_nalumnos          = $_POST['b_nalumnos'];
$b_ndocentes         = $_POST['b_ndocentes'];
$b_ntescuela         = $_POST['b_ntescuela'];
$b_nfamiliar         = $_POST['b_nfamiliar'];
$b_marea             = $_POST['b_marea'];
$b_coment_marea      = $_POST['b_coment_marea'];
$b_narea             = $_POST['b_narea'];
$b_prueba            = $_POST['b_prueba'];
$b_aescuela          = $_POST['b_aescuela'];
$b_fechasin          = $_POST['b_fechasin'];
$b_derechohabiencia  = $_POST['b_derechohabiencia'];
$lugar_prueba          = $_POST['lugar_prueba'];
$b_indicaciones      = $_POST['b_indicaciones'];
$resp                = $_POST['responsable'];
$fechaseg            = date("Y-m-d");



$mysqli -> query ("INSERT INTO positivos (id_positivos, folio, b_casos, b_otros_conf, b_nalumnos, b_ndocentes, b_ntescuela, b_nfamiliar, b_misma_area, b_coment_marea, b_num_marea, b_prueba, b_aescuela, b_fechasin, b_derechohabiencia, lugar_prueba, b_indicaciones, motivo, responsable, fecha_seg) 
                        VALUES (NULL, $folio , $b_casos , '$b_otros', $b_nalumnos, $b_ndocentes, $b_ntescuela, $b_nfamiliar, $b_marea, '$b_coment_marea', $b_narea, $b_prueba, $b_aescuela, '$b_fechasin', $b_derechohabiencia, '$lugar_prueba', $b_indicaciones, 2, '$resp', '$fechaseg')");

$idFolioB=mysqli_insert_id($mysqli); // obtengo el id del insert anterior 
if($idFolioB==0) {$msj = 'No_insert';} else { $msj ='Insert_exitoso';}  

header("location: b.php?idsegb=$idFolioB&msj=$msj");

?>
