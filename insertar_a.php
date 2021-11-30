<?php
session_start();

 $mysqli = new mysqli("localhost", "root", "root", "bdr3p0r");
 if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_error . ") " . $mysqli->connect_error;
}

      $folio            = $_POST['folio'];
      $resp             = $_POST['responsabler'];
      $a_casos          = $_POST['a_casos'];
      $otro_caso        = $_POST['otros'];
      $no_alumnos       = $_POST['nalumnos'];
      $ndocentes        = $_POST['ndocentes'];
      $ntescuela        = $_POST['ntescuela'];
      $nfamiliar        = $_POST['nfamiliar'];
      $respiracion      = $_POST['respiracion'];
      $toracico         = $_POST['toracico'];      
      $toracico         = $_POST['toracico'];
      $fiebre           = $_POST['fiebre'];
      $cabeza           = $_POST['cabeza'];
      $tos              = $_POST['tos'];
      $garganta         = $_POST['garganta'];
      $ojos_r           = $_POST['ojos_r'];
      $congestion       = $_POST['congestion'];
      $cuerpo           = $_POST['cuerpo'];
      $articulacion     = $_POST['articulacion'];
      $cansancio        = $_POST['cansancio'];
      $escalofrios      = $_POST['escalofrios'];
      $sudoracion       = $_POST['sudoracion'];
      $diarrea          = $_POST['diarrea'];
      $vomito           = $_POST['vomito'];
      $sabor_olor       = $_POST['sabor_olor'];
      $irritabilidad    = $_POST['irritabilidad'];
      $salpullido       = $_POST['salpullido'];
      $com_sintomas     = $_POST['com_sintomas'];
      $marea            = $_POST['marea'];
      $comentarios_a    = $_POST['comentarios_a'];
      $narea            = $_POST['narea'];
      $aescuela         = $_POST['aescuela'];
      $fechasin         = $_POST['fechasin'];
      $derechohabiencia = $_POST['derechohabiencia'];
      $a_referir        = $_POST['a_referir'];
      $a_indicaciones   = $_POST['a_indicaciones'];
      $fechaseg         = date("Y-m-d");

      if($marea==''){$marea=0;}

// Casos sospechosos
$mysqli -> query ("INSERT INTO datos_motivo (id_dato_motivo, who_sospechoso , otro_sospechoso ,n_alum , n_doc , n_trab_e , n_papas , respirar, toracico, fiebre, cabeza, tos, garganta, ojos_r, congestion, d_cuerpo, articulaciones, cansancio, escalofrios, sudoracion, diarrea, nauseas, olor_sabor, irritabilidad, salpullido, com_sintomas, misma_a, coment_misma_a, no_misma_a, asis_escuela, inicio_sint, derecho, referir, indicaciones, otro_motivo, comentarios_otro_mot, folio, motivo, who_captura, fecha_seg) VALUES (null, $a_casos,'$otro_caso', $no_alumnos, $ndocentes, $ntescuela, $nfamiliar , $respiracion , $toracico, $fiebre , $cabeza, $tos, $garganta, $ojos_r, $congestion, $cuerpo , $articulacion, $cansancio, $escalofrios, $sudoracion, $diarrea, $vomito, $sabor_olor, $irritabilidad, $salpullido, '$com_sintomas', $marea, '$comentarios_a', $narea , $aescuela, '$fechasin ', $derechohabiencia, $a_referir , $a_indicaciones, NULL , NULL , $folio, 1, '$resp','$fechaseg')");

$idFolioSEG=mysqli_insert_id($mysqli); // obtengo el id del insert anterior 
if($idFolioSEG==0) {$msjSeg = 'No_insert';} else { $msjSeg ='Insert_exitoso';}  

header("location: seg.php?idseg=$idFolioSEG&msj=$msjSeg");

?>
