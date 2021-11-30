<?php session_start(); if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1){ echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">'; exit(); } $usr =$_SESSION['login_user_sys']; ?>
<?php 
   $buscar1='0000-00-00'; 
   $buscar2='0000-00-00';
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo2.png" rel="icon">
  <title>Atención COVID SSM</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
<!-- Select2 -->
  <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap DatePicker -->  
  <link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
  
  <style type="text/css">
    /*Colores para los requires*/
    input:valid,
    textarea:valid { border: solid 1px green; }
    select:valid   { border: solid 1px green; }
    select.select2:valid { border: solid 1px green; }

    input:invalid,
    textarea:invalid { border: solid 1px red; }
    select:invalid { border: solid 1px red; }
    select.select2-single:invalid { border: solid 1px red; }
  
  </style>
  <!-- Alerta simple para el submit, cuando se presiona aceptar llama al submit, cuando se presiona cancelar, retorna un falso y recarga la pagina esto para evitar que inserte aun cuando se presiona el boton cancelar de la alerta-->
  <script type="text/javascript"> 
    function alerta1()
        {
        var mensaje;
        var opcion = confirm('¿Está seguro de guardar el registro o desea cancelar?');
        if (opcion == true) { document.myForm.submit(); } else { return false; mensaje = 'Cancelaste :('; location.reload(); }
        }
  </script>


  <script type="text/javascript"> 
      function alerta (event)
      {
        var elemento = document.getElementById("whocall").value;
        var cargo = document.getElementById("cargo").value;
        var escuela = document.getElementById("nescuela").value;
        var educativo = document.getElementById("neducativo").value;
        var municipio = document.getElementById("municipio").value;
        var localidad = document.getElementById("localidad").value;
        var telefono = document.getElementById("tel").value;
        // se utiliza esta validación ya que el even.prevenDefault no respeta el required del HTML y al dar guardar pasa directo el insert sin mostrar el swal.fire
        if (elemento == "" || cargo=="" || escuela =="" || educativo=="" || municipio=="" || localidad=="" || telefono=="")
        {
          Swal.fire("Faltan preguntas por llenar :( ",'','error')
          return false;    
        } 
         
        else {
                event.preventDefault(); // evita que se envie el form action y espera el msj del alert
                      Swal.fire({
                      title: '¿Quiere guardar cambios?',
                      showDenyButton: true,
                      showCancelButton: true,
                      confirmButtonText: 'Guardar',
                      denyButtonText: `No guardar`,
                      }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) 
                          {
                          document.myForm.submit();
                          //if (isConfirm) form.submit();
                          //Swal.fire('Registro guardados!', '', 'success')
                          } else if (result.isDenied) {
                          Swal.fire('Registros no guardados :(', ' ', 'error'); return false;
                          }
                      })
              }
      }
  </script>

                
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Atención a escuelas para COVID-19</div>
      </a>
      
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu principal
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Registro / Seguimiento</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Incidencias COVID-19</h6>
            <a class="collapse-item" href="reg.php?id"> Registrar incidencia</a>
            <a class="collapse-item" href="seg.php?idseg"> Seguimiento incidencia</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="status.php">
          <i class="fas far fa-binoculars"></i> 
          <span>Status de incidencias</span></a>
      </li>

    </ul>

 <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>          

          <ul class="navbar-nav ml-auto">
              <li><a class="nav-link" href="buscar.php"><i class="fas fa-search"></i><font color="white"> Reporte por fecha</font> </a></li>
              <li><a class="nav-link" href="consulta.php"><i class="fas fa-search-plus"></i><font color="white"> Consultar por folio</font> </a></li>
              <li><a class="nav-link" href="consultaesc.php"><i class="fas fa-search-plus"></i><font color="white"> Consultar por escuela</font> </a></li>
              <li class="separator hidden-lg hidden-md"></li>
         </ul>

          <ul class="navbar-nav ml-auto"> 
            <div class="topbar-divider d-none d-sm-block"></div>        
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"> <?php echo 'Bienvenido: '.$_SESSION['login_user_sys'];?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                  </a>
              </div>
            </li>

          </ul>
        </nav>
   
      <!-- Topbar -->
      <!-- Container Fluid-->
      <div class="container-fluid" id="container-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary"> <center> Buscar información</center></h5>
                </div> 
                  <div class="card-body">
                  <form autocomplete="off" action="consulta.php" method="post" id="myForm" name='myForm' accept-charset="utf-8">

                    <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-3">  <!--Fecha-->
                                <div class="form-group">
                                    <label>Fecha de consulta</label>
                                    <input type="text" name="fecha" class="form-control" disabled placeholder="fecha" value=<?php  echo date("d-m-Y");?>>
                                </div>  
                            </div>                      
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>Escribe el folio a buscar: </b></label>
                                    <input type="number" name="consulta1" id='fecha1' min="0" class="form-control" value="" return required="TRUE">
                                </div>
                            </div>
                            <div class="col-md-3">
                               <div class="form-group">
                               <BR>
                                <button type="submit" class="btn btn-primary" name="guardar" id="guardar"> Consultar   </button>
                                <button type="reset" class="btn btn-danger" href="#">Cancelar</button> 
                               </div>
                            </div>                                          
                  </div>             <!-- Fin_row_1 -->
                    <div hidden=""> <?php $buscar1=$_POST['consulta1'];?> </div>
                      <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-12">  <!--Fecha-->
                                <div class="form-group">
                                  <div hidden>
                                <?php 
                                  $servername = "localhost"; // Nombre/IP del servidor
                                  $database = "bdr3p0r"; // Nombre de la BBDD
                                  $username = "root"; // Nombre del usuario
                                  $password = "root"; // Contraseña del usuario
                                  $con = mysqli_connect($servername, $username, $password, $database);
                                  if (!$con) { die("La conexión ha fallado: " . mysqli_connect_error()); }
                                                    
                                $sql123= "SELECT folio, fecha_reg, name_esc, municipio, localidad from primarios where fecha_reg between '$buscar1' and '$buscar2'";

                                 $primarios = "SELECT p.folio, p.fecha_reg, p.whocall_name, p.cargo_whocall, p.name_esc, p.name_dir, p.nivel_edu, p.no_alum, p.status_esc, p.municipio, p.localidad, p.c_sos, p.c_conf, p.c_otro, p.telefono, p.dif_respirar, p.who_captura, p.status_caso, p.comentarios_caso
                                   from primarios AS p WHERE p.folio = '$buscar1'";
        
                                $positivos = "SELECT pos.b_casos as TipoPositivo, pos.b_otros_conf AS otroTipoPositivo, pos.b_nalumnos AS AlumnosPositivos, pos.b_ndocentes AS DocentesPositivos, pos.b_ntescuela AS TrabajadoresPositivos, 
                                  pos.b_misma_area, pos.b_coment_marea, pos.b_num_marea, pos.b_prueba, pos.b_aescuela, pos.b_fechasin, 
                                  pos.b_derechohabiencia, pos.lugar_prueba, pos.b_indicaciones, pos.motivo, pos.responsable, pos.fecha_seg 
                                  from positivos AS pos WHERE pos.folio = '$buscar1'";
            
                                $sospechosos = "SELECT dm.folio,  dm.who_sospechoso AS tipoSospechoso, dm.otro_sospechoso AS otroSospechoso, 
                                                dm.n_alum, dm.n_doc, dm.n_trab_e, dm.respirar, dm.toracico, dm.fiebre, dm.cabeza, dm.tos, dm.garganta, dm.ojos_r, dm.congestion, dm.d_cuerpo, dm.articulaciones, dm.cansancio, dm.escalofrios, dm.sudoracion, dm.diarrea, dm.nauseas, dm.olor_sabor, dm.irritabilidad, dm.salpullido, dm.com_sintomas, dm.misma_a, dm.coment_misma_a, dm.no_misma_a, dm.asis_escuela, 
                                                  dm.inicio_sint, dm.derecho, dm.referir, dm.indicaciones, dm.otro_motivo, dm.comentarios_otro_mot, dm.motivo, dm.who_captura, dm.fecha_seg from datos_motivo AS dm WHERE dm.folio = '$buscar1'";

                                  $q_primarios   = mysqli_query($con, $primarios);
                                  $rowPrimarios = mysqli_fetch_assoc($q_primarios);

                                  $folio        = $rowPrimarios['folio']; 
                                  $fechareg     = $rowPrimarios['fecha_reg'];
                                  $who_call     = $rowPrimarios['whocall_name'];
                                  $cargo_whocall= $rowPrimarios['cargo_whocall'];
                                  $name_escuela = $rowPrimarios['name_esc']; 
                                  $name_dir     = $rowPrimarios['name_dir'];
                                  $nivel_edu    = $rowPrimarios['nivel_edu'];
                                  $no_alum      = $rowPrimarios['no_alum'];
                                  $status_esc   = $rowPrimarios['status_esc'];
                                  $mun          = $rowPrimarios['municipio'];
                                  $localidad    = $rowPrimarios['localidad'];
                                  $c_sos        = $rowPrimarios['c_sos'];
                                  $c_conf       = $rowPrimarios['c_conf'];
                                  $c_otro       = $rowPrimarios['c_otro'];
                                  $tel          = $rowPrimarios['telefono'];
                                  $dif_resp     = $rowPrimarios['dif_respirar'];
                                  $who_captua   = $rowPrimarios['who_captura'];
                                  $status_caso  = $rowPrimarios['status_caso'];
                                  $comentarios_caso = $rowPrimarios['comentarios_caso'];


                                  $q_positivos   = mysqli_query($con, $positivos);
                                  $rowPositivos = mysqli_fetch_assoc($q_positivos);

                                  $tipoPositivo          = $rowPositivos['TipoPositivo'];
                                  $otroTipoPositivo      = $rowPositivos['otroTipoPositivo'];
                                  $alumnosPositivos      = $rowPositivos['AlumnosPositivos'];
                                  $docentesPositivos     = $rowPositivos['DocentesPositivos'];
                                  $trabajadoresPositivos = $rowPositivos['TrabajadoresPositivos'];
                                  $pos_mismaArea         = $rowPositivos['b_misma_area'];
                                  $pos_coment_marea      = $rowPositivos['b_coment_marea'];
                                  $num_area              = $rowPositivos['b_num_marea'];
                                  $prueba                = $rowPositivos['b_prueba'];
                                  $aescuela              = $rowPositivos['b_aescuela'];
                                  $fechasin              = $rowPositivos['b_fechasin'];
                                  $posDerch              = $rowPositivos['b_derechohabiencia'];
                                  $lugar_prueba          = $rowPositivos['lugar_prueba'];
                                  $indicaciones_pos      = $rowPositivos['b_indicaciones'];
                                  $whoCapturaPos         = $rowPositivos['responsable'];
                                  $dateSegPos            = $rowPositivos['fecha_seg'];

                                  $q_sospechosos = mysqli_query($con, $sospechosos);
                                  $rowSospechosos = mysqli_fetch_assoc($q_sospechosos);
                                 
                                $tipoSospechoso  = $rowSospechosos['tipoSospechoso'];
                                $otroSospechoso  = $rowSospechosos['otroSospechoso'];
                                $sos_alumno      = $rowSospechosos['n_alum'];
                                $sos_doc         = $rowSospechosos['n_doc'];
                                $sos_trab        = $rowSospechosos['n_trab_e'];
                                $sos_papas        = $rowSospechosos['n_papas'];
                                $respirar        = $rowSospechosos['respirar'];
                                $toracico        = $rowSospechosos['toracico'];
                                $fiebre          = $rowSospechosos['fiebre'];
                                $cabeza          = $rowSospechosos['cabeza'];
                                $tos             = $rowSospechosos['tos'];
                                $garganta        = $rowSospechosos['garganta'];
                                $ojos            = $rowSospechosos['ojos_r'];
                                $congestion      = $rowSospechosos['congestion'];
                                $cuerpo          = $rowSospechosos['d_cuerpo'];
                                $articulaciones  = $rowSospechosos['articulaciones'];
                                $cansancio       = $rowSospechosos['cansancio'];
                                $escalofrios     = $rowSospechosos['escalofrios'];
                                $sudoracion      = $rowSospechosos['sudoracion'];
                                $diarrea         = $rowSospechosos['diarrea'];
                                $nauseas         = $rowSospechosos['nauseas'];
                                $olor_sabor      = $rowSospechosos['olor_sabor'];
                                $irritabilidad   = $rowSospechosos['irritabilidad'];
                                $salpullido      = $rowSospechosos['salpullido'];
                                $com_sintomas    = $rowSospechosos['com_sintomas'];
                                $misma_a         = $rowSospechosos['misma_a'];
                                $coment_misma_a  = $rowSospechosos['coment_misma_a'];
                                $no_misma_a      = $rowSospechosos['no_misma_a'];
                                $asis_escuela    = $rowSospechosos['asis_escuela'];
                                $inicio_sint     = $rowSospechosos['inicio_sint'];
                                $derecho         = $rowSospechosos['derecho'];
                                $referir         = $rowSospechosos['referir'];
                                $indicaciones    = $rowSospechosos['indicaciones'];
                                
                                $motivo          = $rowSospechosos['motivo'];
                              

                                $otro_reporte = "SELECT folio , motivo, who_captura, indicaciones, otro_motivo, comentarios_otro_mot from datos_motivo dm where motivo = 3 and dm.folio = '$buscar1'";
                                $q_otro_reporte = mysqli_query($con, $otro_reporte);
                                $row_otroReporte = mysqli_fetch_assoc($q_otro_reporte);

                                $otro_motivos    = $row_otroReporte['otro_motivo'];
                                $comentarios_caso =$row_otroReporte['comentarios_otro_mot'];
                                $otro_indicaciones = $row_otroReporte['indicaciones'];

                                ?> </div>
                               </div>
                          </div> <!-- FN COLUM12 -->  
                          <br>
                      </div> <!-- Fin_row_1 -->
                      
                      <div class="row"> <!-- Inicio_row_1 -->
                            <div class="col-md-12">  <!--Fecha-->
                                <div class="col-xl-12 col-lg-12" class="accordion-container">
                                    <div class="card mb-12" class="accordion-container"> 
                                      <div class="content table-responsive table-full-width">  
                                          <table class="table table-hover table-striped">
                                              <tbody>
                                                <thead>
                                                  <th colspan="8" style="color:#456789; font-size:80%;"><center> Reporte de atención </center></th>
                                                </thead>
                                                <tr>
                                                    <th style="font-size:80%; color:#456789;" colspan='2'><b>Fecha del reporte</b></th> 
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $fechareg; ?></center></td>
                                                    <th style="font-size:80%; color:#456789;" colspan='2'><b>Folio del reporte</b></th>
                                                    <td style="font-size:85%; color:#ff3333;" colspan='2'><center><b><?php echo $folio; ?></b> </center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:80%;"><b> Estatus del reporte</b></th> 
                                                    <td style="font-size:85%; color:#ff3333;"><center><b>
                                                      <?php
                                                      if($status_caso==NULL OR $status_caso=='NULL' OR $status_caso=='') {$s = '---'; echo $s;} 
                                                      elseif($status_caso==0) {$s = 'Seguimiento'; echo $s;}
                                                              else{ $s = 'Finalizado'; echo $s;} ?> </b></center></td>
                                                    <th style="font-size:70%;" colspan='2'><b> Comentarios generales del reporte</b></th>
                                                    <td style="font-size:70%;" colspan='3'><center><?php echo $comentarios_caso; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan='2'><b>1.</b> ¿Quien llama?</th> 
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $who_call; ?></center></td>
                                                    <th style="font-size:70%;" colspan='2'><b>2.</b> ¿Cual es su cargo?</th>
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $cargo_whocall; ?></center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%; " colspan='2'><b>3.</b> ¿Nombre de la escuela?</th> 
                                                    <td style="font-size:80%; color:#007840;" colspan='2'><b><center> <?php echo $name_escuela; ?></center></b></td>
                                                    <th style="font-size:70%;" colspan='2'><b>4.</b> ¿Nombre del director/a? </th>
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $name_dir; ?> </center></td>
                                                </tr><tr>
                                                    <th style="font-size:70%;" colspan='2'><b>5.</b> ¿Grado escolar?</th> 
                                                    <td style="font-size:70%;" colspan='2'><center>
                                                    <?php 
                                                    if($nivel_edu==NULL) {$pres = '- - -';  echo $pres; }
                                                    elseif($nivel_edu==0) {$pres = 'Prescolar';  echo $pres; }
                                                    if($nivel_edu==1) {$prim = 'Primaria';   echo $prim; }
                                                    if($nivel_edu==2) {$secu = 'Secundaria'; echo $secu; }
                                                    if($nivel_edu==3) {$msup = 'Medio suprior'; echo $msup; }
                                                    if($nivel_edu==4) {$sup  = 'Superior';   echo $sup; }
                                                    ?></center></td>
                                                    <th style="font-size:70%;" colspan='2'><b>6.</b> ¿No. aproxiado de alumnos que recibe?</th>
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $no_alum ; ?></center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan='2'><b>7.</b> ¿Estado de la escuela?</th> 
                                                    <td style="font-size:70%;" colspan='2'><center><?php 

                                                    if ($status_esc==NULL){$SE = '- - - -'; echo $SE;}
                                                    elseif ($status_esc==0) {$SE = 'Cerrada'; echo $SE; }
                                                    elseif ($status_esc==1) {$SE = 'Abierta'; echo $SE; }
                                                        

                                                  ?></center></td>
                                                    <th style="font-size:70%;" colspan='2'><b>8.</b> ¿En que municipio se encuentra?</th>
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $mun; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan='2'><b>9.</b> Localidad: </th> 
                                                    <td style="font-size:70%;" colspan='2'><center><?php echo $localidad; ?></center></td>
                                                    <th style="font-size:70%;" colspan='2'><b>10.</b> ¿Motivo de la llamada?</th>
                                                    <td style="font-size:70%;" colspan='2'><center>
                                                      <?php 
                                                      if($c_sos==1){$sos = 'Reportar caso sopechoso/s';} else{ $sos = ' * '; }
                                                      if($c_conf==2){$conf ='Reportar casos positovo/s';} else { $conf = ' * '; }
                                                      if($c_otro==3){$otr = 'Reportar otro caso o situacón';} else { $otr = ' * ';}
                                                            
                                                      echo $sos.' <- - -> '.$conf.' <- - -> '.$otr; ?>
                                                      </center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan='2'><b>11.</b> ¿Cuál es su No. telefónico?</th> 
                                                    <td style="font-size:85%; color:#ff3333;" colspan='2'><b><center><?php echo $tel; ?></center></b></td>
                                                    <th style="font-size:70%;" colspan='2'><b>12.</b> ¿Algún caso presenta dificultad para respirar?</th>
                                                    <td style="font-size:70%;" colspan='2'><center>
                                                      <?php 
                                                      if($dif_resp==NULL){ $dr =' '; echo $dr;}
                                                      elseif($dif_resp==0){ $dr ='No'; echo $dr;} else {$dr = 'Si'; echo $dir;}
                                                       ?></center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:85%; color:#fff;border: 0px outset lightblue; background-color: #ff6331; text-align: center;" colspan='8'><center><b> a) Casos sospechosos</b></center></th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan="1"><b>13.</b> Los casos sospechosos son:</th> 
                                                    <td style="font-size:70%;" colspan="1"><center><?php 
                                                    if($tipoSospechoso==NULL){ $tpsos = ' - - - '; echo $tpsos;}
                                                    elseif($tipoSospechoso==0){ $tpsos = ' Alumnos '; echo $tpsos;}
                                                    if($tipoSospechoso==1){ $tpsos = ' Director '; echo $tpsos;}
                                                    if($tipoSospechoso==2){ $tpsos = ' Docente '; echo $tpsos;}
                                                    if($tipoSospechoso==3){ $tpsos = ' Secretaria '; echo $tpsos;}
                                                    if($tipoSospechoso==4){ $tpsos = ' Prefecto '; echo $tpsos;}
                                                    if($tipoSospechoso==5){ $tpsos = ' Intendente '; echo $tpsos;}
                                                    if($tipoSospechoso==6){ $tpsos = ' Cooperativa '; echo $tpsos;}
                                                    if($tipoSospechoso==7){ $tpsos = ' Responsable de laboratorio '; echo $tpsos;}
                                                    if($tipoSospechoso==8){ $tpsos = ' Papas '; echo $tpsos;}
                                                    if($tipoSospechoso==9){ $tpsos = ' Algún familiar del alumno '; echo $tpsos;}
                                                    if($tipoSospechoso==10){ $tpsos = ' Otro '; echo $tpsos;}
                                                  ?></center></td> 
                                                    <th style="font-size:70%;" colspan="2"><b>13.1. </b> Otros sospechosos: </th>
                                                    <td style="font-size:70%;" colspan="2"><?php echo $otroSospechoso; ?> </td>
                                                    <th style="font-size:70%;" colspan="2"><b>14.</b> ¿Cuantos sospechosos son?</th>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>14.1.</b> Alumnos: </td>
                                                    <td style="font-size:70%;"><center><?php echo $sos_alumno ; ?> </center></td>
                                                    <td style="font-size:70%;"><b>14.2.</b> Docentes: </td>
                                                    <td style="font-size:70%;"><center><?php echo $sos_doc; ?> </center></td>
                                                    <td style="font-size:70%;"><b>14.3.</b> Trabajador de la escuela</td>
                                                    <td style="font-size:70%;"><center><?php echo $sos_trab;  ?> </center></td>
                                                    <td style="font-size:70%;"><b>14.4.</b> Familiar</td>
                                                    <td style="font-size:70%;"><center><?php echo $sos_papas; ; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan='2'><b>15.</b> ¿Qué sintomas presentas?</th>
                                                    <td style="font-size:70%;"><b>15.1.</b> Dolor o dificultar para respirar</td>
                                                    <td style="font-size:70%;"><?php echo $respirar; ?> </td>
                                                    <td style="font-size:70%;"><b>15.2.</b> Dolor torácico</td>
                                                    <td style="font-size:70%;"><?php echo $toracico; ?> </td>
                                                    <td style="font-size:70%;"><b>15.3.</b> Fiebre igual o mayor a 37.5°</td>
                                                    <td style="font-size:70%;"><?php echo $fiebre; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>15.4.</b> Dolor de cabeza: </td>
                                                    <td style="font-size:70%;"><center><?php echo $cabeza ; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.5.</b> Tos seca: </td>
                                                    <td style="font-size:70%;"><center><?php echo $tos; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.6.</b> Dolor de garganta</td>
                                                    <td style="font-size:70%;"><center><?php echo $garganta; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.7.</b> Ojos rojos e hinchados</td>
                                                    <td style="font-size:70%;"><center><?php echo $ojos; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>15.8.</b> Congestion nasal: </td>
                                                    <td style="font-size:70%;"><center><?php echo $congestion; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.9.</b> Dolor de cuerpo: </td>
                                                    <td style="font-size:70%;"><center><?php echo $cuerpo; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.10.</b> Dolor de articulaciones</td>
                                                    <td style="font-size:70%;"><center><?php echo $articulaciones; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.11.</b> Cansancio extremo / fatiga</td>
                                                    <td style="font-size:70%;"><center><?php echo $cansancio; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>15.12.</b> Escalofrios: </td>
                                                    <td style="font-size:70%;"><center><?php echo $escalofrios; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.13.</b> Sudoración: </td>
                                                    <td style="font-size:70%;"><center><?php echo $sudoracion; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.14.</b> Malestar estomacal</td>
                                                    <td style="font-size:70%;"><center><?php echo $diarrea; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.15.</b> Vomito / Náuseas</td>
                                                    <td style="font-size:70%;"><center><?php echo $nauseas; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;" colspan="2"><b>15.16.</b> Disminución en la percepción de olores o sabores</td>
                                                    <td style="font-size:70%;" colspan="2"><center><?php echo $olor_sabor; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.17.</b> Irritabilidad: </td>
                                                    <td style="font-size:70%;"><center><?php echo $irritabilidad ; ?> </center></td>
                                                    <td style="font-size:70%;"><b>15.18.</b> Sarpullido</td>
                                                    <td style="font-size:70%;"><center><?php echo $salpullido; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>16.</b> ¿Pertenece a la misma area?: </td>
                                                    <td style="font-size:70%;"><center><?php 
                                                    if($misma_a==NULL){$ma='- - - ';}
                                                    elseif($misma_a==0){ $ma = 'No'; echo $ma;} else{$ma = 'Si';} ?> </center></td>
                                                    <td style="font-size:70%;" colspan="2"><b>16.1.</b> Comentarios: </td>
                                                    <td style="font-size:70%;" colspan="4"><center><?php echo $com_sintomas; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>17.</b> Cuantos son de la misma área? </td>
                                                    <td style="font-size:70%;"><center><?php echo $no_misma_a; ?> </center></td>
                                                    <td style="font-size:70%;"><b>18.</b> ¿Actualmente asisten a la escuela?</td>
                                                    <td style="font-size:70%;"><center><?php echo $asis_escuela; ?> </center></td>
                                                    <td style="font-size:70%;"><b>19.</b> ¿Cuando iniciaron los sintomas?</td>
                                                    <td style="font-size:70%;"><center><?php echo $inicio_sint ; ?> </center></td>
                                                    <td style="font-size:70%;"><b>20. </b> ¿Cual es su derechohabiente?</td>
                                                    <td style="font-size:70%;"><center>
                                                      <?php 
                                                    if($derecho==NULL){$Derpos = ' - - - '; echo $Derpos;}
                                                    elseif($derecho==0){$Derpos = 'IMSS';   echo $Derpos;}
                                                    if($derecho==1){$Derpos = 'ISSSTE';     echo $Derpos;}
                                                    if($derecho==2){$Derpos = 'INSABI';     echo $Derpos;}
                                                    if($derecho==3){$Derpos = 'PEMEX';      echo $Derpos;}
                                                    if($derecho==4){$Derpos = 'DEFENSA';    echo $Derpos;}
                                                    if($derecho==5){$Derpos = 'MARINA';     echo $Derpos;}
                                                    if($derecho==6){$Derpos = 'PARTICULAR'; echo $Derpos;}
                                                    if($derecho==7){$Derpos = 'NINGUNO';    echo $Derpos;}
                                                    ?> 
                                                    </center></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size:70%;" colspan="2"><b>21.</b> Referir a: </td>
                                                  <td style="font-size:70%;" colspan="6"><center>
                                                    <?php 
                                                    if($referir==NULL){ $ref = ' - - - '; echo $ref;}
                                                    elseif($referir==0){ $ref = 'Ningún lugar'; echo $ref;}
                                                    if($referir==1){ $ref = 'C.S. Tlaltenango - 08:30 a.m. a 10:00 a.m. - Lunes a viernes - Cuernavaca y Jiutepec'; echo $ref;}
                                                    if($referir==2){ $ref = 'C.S. Villa de las Flores - 08:30 a.m. a 11:00 a.m. - Martes y Jueves - Temixco y Zapata'; echo $ref;}
                                                    if($referir==3){ $ref = 'C.S. Tepoztlan - 08:30 a.m. a 11:00 a.m. - Martes y Viernes - Tepoztlán'; echo $ref;}
                                                    if($referir==4){ $ref = 'C.S. Jojutla - 08:30 a.m. a 10:30 a.m. - Martes y Jueves - Jojutla y Zacatepec'; echo $ref;}
                                                    if($referir==5){ $ref = 'C.S. Pena Flores - 10:00 a.m. a 14:00 a.m. - Lunes y Viernes - Todos lo municipios'; echo $ref;}
                                                    if($referir==6){ $ref = 'Modulo de prueba COVID-19'; echo $ref;}
                                                    ?> </center></td>
                                                </tr>

                                                <tr>
                                                  <td style="font-size:70%;" colspan="2"><b> * Indicaciones:</b>  </td>
                                                  <td style="font-size:70%;" colspan="6"><center>
                                                    <?php   
                                                      if($indicaciones==NULL){ $indPos = ' - - - '; echo $indPos;} 
                                                      elseif($indicaciones==0){ $indPos = 'Ninguna'; echo $indPos;} 
                                                      if($indicaciones==1){ $indPos = 'Asesoramiento respecto a la correcta desinfección de lugares '; echo $indPos;} 
                                                      if($indicaciones==2){ $indPos = 'Asesoria para mitigar el riesgo de contagio COVID-19 para alumnos'; echo $indPos;} 
                                                      if($indicaciones==3){ $indPos = 'Asesoria para mitigar el riesgo de contagio COVID-19 para docentes '; echo $indPos;} 
                                                      if($indicaciones==4){ $indPos = 'Asesoria para mitigar el riesgo de contagio COVID-19 para familiares'; echo $$indPos;} 
                                                      if($indicaciones==5){ $indPos = 'Capacitación sobre escudo de la salud'; echo $indPos;} 
                                                      if($indicaciones==6){ $indPos = 'Capacitación sobre alimentacion saludable'; echo $indPos;} 
                                                      if($indicaciones==7){ $indPos = 'Capacitación sobre actividad fisica'; echo $indPos;} 
                                                      if($indicaciones==8){ $indPos = 'Capacitación sobre lavado y desinfeccion de manos'; echo $indPos;} 
                                                      if($indicaciones==9){ $indPos = 'Capacitación sobre el uso correcto de cubrebocas'; echo $indPos;} 
                                                      if($indicaciones==10){ $indPos = 'Capacitación sobre actividades para la vida'; echo $indPos;}
                                                      if($indicaciones==11){ $indPos = 'Capacitación sobre higiene personal'; echo $indPos;}
                                                      if($indicaciones==12){ $indPos = 'Orientación telefónica COVID-19'; echo $indPos;} 
                                                    ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:85%; color:#fff;border: 0px outset lightblue; background-color: #f17c7c; text-align: center;" colspan='8'>
                                                      <center><b> b) Casos positivos</b></center></th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:70%;" colspan='2'><b>22.</b> Los casos positivos son:</th> 
                                                    <td style="font-size:70%;" colspan="2"><center>
                                                      <?php
                                                        if ($tipoPositivo==NULL) { $TP=' - - - '; echo $TP;} 
                                                        elseif ($tipoPositivo==0) { $TP='Alumnos'; echo $TP;}
                                                        if ($tipoPositivo==1) { $TP='Director'; echo $TP;}
                                                        if ($tipoPositivo==2) { $TP='Docente'; echo $TP;}
                                                        if ($tipoPositivo==3) { $TP='Secretaria'; echo $TP;}
                                                        if ($tipoPositivo==4) { $TP='Prefecto'; echo $TP;}
                                                        if ($tipoPositivo==5) { $TP='Intendente'; echo $TP;}
                                                        if ($tipoPositivo==6) { $TP='Cooperativa'; echo $TP;}
                                                        if ($tipoPositivo==7) { $TP='Responsable de laboratorio'; echo $TP;}
                                                        if ($tipoPositivo==8) { $TP='Papas'; echo $TP;}
                                                        if ($tipoPositivo==9) { $TP='Algún familiar del alumno'; echo $TP;}
                                                        if ($tipoPositivo==10) { $TP='Otro'; echo $TP;}
                                                        
                                                      ?></center></td>
                                                    <th style="font-size:70%;" colspan="4"><b>23.</b> ¿Cuantos positivos son?</th>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>23.1.</b> Alumnos: </td>
                                                    <td style="font-size:70%;"><center><?php echo $alumnosPositivos; ?></center></td>
                                                    <td style="font-size:70%;"><b>23.2.</b> Docentes: </td>
                                                    <td style="font-size:70%;"><center><?php echo $alumnosPositivos; ?> </center></td>
                                                    <td style="font-size:70%;"><b>23.3.</b> Trabajador de la escuela</td>
                                                    <td style="font-size:70%;"><center><?php echo $docentesPositivos; ?> </center></td>
                                                    <td style="font-size:70%;"><b>23.4.</b> Familiar</td>
                                                    <td style="font-size:70%;"><center><?php echo $trabajadoresPositivos; ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>24.</b> ¿Pertenecen a la misma área? </td>
                                                    <td style="font-size:70%;"><center><?php echo $pos_mismaArea; ?> </center></td>
                                                    <td style="font-size:70%;"><b>24.1.</b> Comentarios:</td>
                                                    <td style="font-size:70%;"><center><?php echo $pos_coment_marea; ?> </center></td>
                                                    <td style="font-size:70%;"><b>25.</b> ¿Cuantos son de la misma área? </td>
                                                    <td style="font-size:70%;"><center><?php echo $num_area; ?> </center></td>
                                                    <td style="font-size:70%;"><b>26.</b> ¿Cuenta con una prueba que valide el diagnostico positivo?</td>
                                                    <td style="font-size:70%;"><center><?php 
                                                     if($prueba==NULL){$prub = ' - - - '; echo $prub;} 
                                                     elseif($prueba==0){$prub = 'No'; echo $prub;} else{$prub ='Si'; echo $prub;} ?> </center></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>27.</b> ¿Actualmente asisten a la escuela?</td>
                                                    <td style="font-size:70%;"><center>
                                                    <?php
                                                    if($aescuela==NULL){$asisten = ' - - - '; echo $asisten;} 
                                                    elseif($aescuela==0){$asisten = 'No'; echo $asisten;} else{ $asisten = 'Si'; echo $asisten;}?> </center></td>
                                                    <td style="font-size:70%;"><b>28.</b> ¿Cuando iniciaron sintomas? </td>
                                                    <td style="font-size:70%;"><center><?php echo $fechasin;?> </center></td>
                                                    <td style="font-size:70%;"><b>29.</b> ¿Cual es su derechohabiente? </td>
                                                    <td style="font-size:70%;"><center><?php 
                                                    if($posDerch==NULL){$Der = ' - - - '; echo $Der;}
                                                    elseif($posDerch==0){$Der = 'IMSS';   echo $Der;}
                                                    if($posDerch==1){$Der = 'ISSSTE';     echo $Der;}
                                                    if($posDerch==2){$Der = 'INSABI';     echo $Der;}
                                                    if($posDerch==3){$Der = 'PEMEX';      echo $Der;}
                                                    if($posDerch==4){$Der = 'DEFENSA';    echo $Der;}
                                                    if($posDerch==5){$Der = 'MARINA';     echo $Der;}
                                                    if($posDerch==6){$Der = 'PARTICULAR'; echo $Der;}
                                                    if($posDerch==7){$Der = 'NINGUNO';    echo $Der;}
                                                      
                                                      ?> </center></td>
                                                    <td style="font-size:70%;"><b>30.</b> ¿Lugar donde se realizo la prueba?</td>
                                                    <td style="font-size:70%;"><center><?php echo $lugar_prueba;?> </center></td> 
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="font-size:70%;"><b>31.</b> Indicaciones realizadas:  </th>
                                                    <td colspan="6" style="font-size:70%;"><?php 
                                                      if($indicaciones_pos==NULL){ $indic = ' - - - '; echo $indic;} 
                                                      elseif($indicaciones_pos==0){ $indic = 'Ninguna'; echo $indic;} 
                                                      if($indicaciones_pos==1){ $indic = 'Asesoramiento respecto a la correcta desinfección de lugares '; echo $indic;} 
                                                      if($indicaciones_pos==2){ $indic = 'Asesoria para mitigar el riesgo de contagio COVID-19 para alumnos'; echo $indic;} 
                                                      if($indicaciones_pos==3){ $indic = 'Asesoria para mitigar el riesgo de contagio COVID-19 para docentes '; echo $indic;} 
                                                      if($indicaciones_pos==4){ $indic = 'Asesoria para mitigar el riesgo de contagio COVID-19 para familiares'; echo $indic;} 
                                                      if($indicaciones_pos==5){ $indic = 'Capacitación sobre escudo de la salud'; echo $indic;} 
                                                      if($indicaciones_pos==6){ $indic = 'Capacitación sobre alimentacion saludable'; echo $indic;} 
                                                      if($indicaciones_pos==7){ $indic = 'Capacitación sobre actividad fisica'; echo $indic;} 
                                                      if($indicaciones_pos==8){ $indic = 'Capacitación sobre lavado y desinfeccion de manos'; echo $indic;} 
                                                      if($indicaciones_pos==9){ $indic = 'Capacitación sobre el uso correcto de cubrebocas'; echo $indic;} 
                                                      if($indicaciones_pos==10){ $indic = 'Capacitación sobre actividades para la vida'; echo $indic;}
                                                      if($indicaciones_pos==11){ $indic = 'Capacitación sobre higiene personal'; echo $indic;}
                                                      if($indicaciones_pos==12){ $indic = 'Orientación telefónica COVID-19'; echo $indic;}    

                                                        ?> </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:80%; color:#fff;border: 0px outset lightblue; background-color: #006078; text-align: center;" colspan='8'><center><b> c) Otros casos</b></center></th>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:70%;"><b>32.</b> ¿Qué otro motivo? </td>
                                                    <td style="font-size:70%;"><center><?php 
                                                    if($otro_motivos ==NULL)  { $oc = ' - - -  '; echo $oc; }
                                                    elseif($otro_motivos ==0) { $oc = 'Seguimiento de caso pendiente'; echo $oc;}
                                                    if($otro_motivos ==1)     { $oc = 'Reportar regreso de llamada'; echo $oc;}
                                                    if($otro_motivos ==2)     { $oc = 'Desinfección'; echo $oc;}
                                                    if($otro_motivos ==3)     { $oc = 'Quejas'; echo $oc;}
                                                    if($otro_motivos ==4)     { $oc = 'Dudas'; echo $oc;}
                                                    if($otro_motivos ==5)     { $oc = 'Reportar alguna defunción'; echo $oc;}
                                                    if($otro_motivos ==6)     { $oc = 'Otro'; echo $oc;}

                                                    ?> </center></td>
                                                    <td style="font-size:70%;"><b>33.</b> Comentarios </td>
                                                    <td style="font-size:70%;" colspan="2"><center> <?php echo $comentarios_caso;?></center></td>
                                                    <td style="font-size:70%;"><b>34.</b> Indicaciones realizadas </td>
                                                    <td style="font-size:70%;" colspan="2"><center>
                                                     <?php 
                                                     if($indicaciones_pos==NULL){ $indic = ' - - - '; echo $indic;} 
                                                      elseif($otro_indicaciones==0){ $indic = 'Ninguna'; echo $indic;} 
                                                      if($otro_indicaciones==1){ $indic = 'Asesoramiento respecto a la correcta desinfección de lugares '; echo $indic;} 
                                                      if($otro_indicaciones==2){ $indic = 'Asesoria para mitigar el riesgo de contagio COVID-19 para alumnos'; echo $indic;} 
                                                      if($otro_indicaciones==3){ $indic = 'Asesoria para mitigar el riesgo de contagio COVID-19 para docentes '; echo $indic;} 
                                                      if($otro_indicaciones==4){ $indic = 'Asesoria para mitigar el riesgo de contagio COVID-19 para familiares'; echo $indic;} 
                                                      if($otro_indicaciones==5){ $indic = 'Capacitación sobre escudo de la salud'; echo $indic;} 
                                                      if($otro_indicaciones==6){ $indic = 'Capacitación sobre alimentacion saludable'; echo $indic;} 
                                                      if($otro_indicaciones==7){ $indic = 'Capacitación sobre actividad fisica'; echo $indic;} 
                                                      if($otro_indicaciones==8){ $indic = 'Capacitación sobre lavado y desinfeccion de manos'; echo $indic;} 
                                                      if($otro_indicaciones==9){ $indic = 'Capacitación sobre el uso correcto de cubrebocas'; echo $indic;} 
                                                      if($otro_indicaciones==10){ $indic = 'Capacitación sobre actividades para la vida'; echo $indic;}
                                                      if($otro_indicaciones==11){ $indic = 'Capacitación sobre higiene personal'; echo $indic;}
                                                      if($otro_indicaciones==12){ $indic = 'Orientación telefónica COVID-19'; echo $indic;}  
                                                     ?>   
                                                     </center></td>
                                                </tr>

                                              </tbody>
                                          </table>  
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </form>
                </div>
              </div>
            </div>
          </div> <!-- Div class row -->
          <!--Row-->
           <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Estas seguro de cerrar sesión?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="logout.php" class="btn btn-primary">Salir</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Servicios de Salud de Morelos        <b><a href="http://www.ssm.gob.mx" target="_blank"> SSM </a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Select2 -->
 <?php mysqli_close($con)?>
</body>

</html>