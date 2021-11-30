<?php
session_start();

 $mysqli = new mysqli("localhost", "root", "root", "bdr3p0r");
 if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$folio          = $_POST['folio'];
$c_casos        = $_POST['c_casos'];
$c_otros        = $_POST['c_otros'];
$c_indicaciones = $_POST['c_indicaciones'];
$resp           = $_POST['responsable_c'];
$fechasegc      = date("Y-m-d");

$mysqli -> query ("INSERT INTO datos_motivo (id_dato_motivo, who_sospechoso , otro_sospechoso ,n_alum , n_doc , n_trab_e , n_papas , respirar, toracico, fiebre, cabeza, tos, garganta, ojos_r, congestion, d_cuerpo, articulaciones, cansancio, escalofrios, sudoracion, diarrea, nauseas, olor_sabor, irritabilidad, salpullido, com_sintomas, misma_a, coment_misma_a, no_misma_a, asis_escuela, inicio_sint, derecho, referir, indicaciones, otro_motivo, comentarios_otro_mot, folio, motivo, who_captura, fecha_seg) 
               VALUES (null, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 
                      NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 
                      NULL, NULL, $c_indicaciones, $c_casos, '$c_otros', $folio, 3, '$resp', '$fechasegc')");

$idFolioC=mysqli_insert_id($mysqli); // obtengo el id del insert anterior 
if($idFolioC==0) {$msjSegc = 'No_insert';} else { $msjSegc ='Insert_exitoso';}  

header("location: c.php?idsegc=$idFolioC&msj=$msjSegc");


?>
