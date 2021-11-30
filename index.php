<?php require_once('file/conex.php'); ?>

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

  <!-- Libreria para plotyJS-->
  <script src="https://cdn.plot.ly/plotly-2.4.2.min.js"></script>


<style type="text/css">
  body{
  background: #ecf0f1;
}

#container-main{
  margin:20px auto;
  width:100%;
  min-width:120px;
  max-width:860px;

}
.accordion-container {
  width: 100%;
  margin: 0 0 10px;
  clear:both;
}

.accordion-titulo {
  position: relative;
  display: block;
  padding: 10px;
  font-size: 16px;
  font-weight: 300;
  text-align: center;
  color: #FFFFFF;  /* Blanco */
  background: #343434; /* Morado color inicial*/

  text-decoration: ; 
  align-content: center; /* Alinear al centro contenido  */
}
.accordion-titulo.open {
  background: #343434; /* Morado abierto*/
  color: #ffffff;
}
.accordion-titulo:hover {
  background: #bfbfbf; /*Morado claro seleccion*/
}

.accordion-titulo span.toggle-icon:before {
  content:"+";
}

.accordion-titulo.open span.toggle-icon:before {
  content:"-";
}

.accordion-titulo span.toggle-icon {
  position: absolute;
  top: 10 px;
  right: 100px;
  font-size: 16px;
  font-weight:bold;
  color:white;
}

.accordion-content {
  display: none;
  padding: 20px;
  overflow: auto;
}

.accordion-content p{
  margin:0;
}

.accordion-content img {
  display: block;
  float: left;
  margin: 0 15px 10px 0;
  width: 50%;
  height: auto;
}


@media (max-width: 767px) {
  .accordion-content {
    padding: 10px 0;
  }
}
</style>
</head>

<body id="page-top">
  <div hidden><?php if(session_start()==TRUE) { session_start();} else {session_start()==FALSE;} ?></div>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon" >
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text">Atención a escuelas para COVID-19</div>
      </a>
      
      <hr class="sidebar-divider my-0">
<?php  if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
<?php  }?>
<?php if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu principal
      </div>
<?php  }?>
<?php if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>      
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
<?php  }?>
      <hr class="sidebar-divider my-0">

<?php if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>
      <li class="nav-item active">
        <a class="nav-link" href="status.php">
          <i class="fas far fa-binoculars"></i>
          <span>Status de incidencias</span></a>
      </li>
<?php  }?>
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
            <li> </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <?php if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo 'Bienvenido: ',$_SESSION['login_user_sys']; ?></span>
                <?php } ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <?php if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a><?php } ?>
                <?php if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1){ ?>
                <?php session_destroy();?>
                <a class="dropdown-item" href="sesion.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Iniciar sesión
                </a><?php } ?>
              </div>
            </li>

          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <?php

          $servername = "localhost"; // Nombre/IP del servidor
          $database = "bdr3p0r"; // Nombre de la BBDD
          $username = "root"; // Nombre del usuario
          $password = "root"; // Contraseña del usuario
          // Creamos la conexión
          $con = mysqli_connect($servername, $username, $password, $database);
          // Comprobamos la conexión
           if (!$con) { die("La conexión ha fallado: " . mysqli_connect_error()); }


          // Total de llamadas recibidas
          $allCalls  ="SELECT count(folio) as AllCalls from primarios;";
          $tallCalls = mysqli_query($con, $allCalls);
          $fila7     = mysqli_fetch_assoc($tallCalls);
          // echo 'Número de total de registros: <font color="red">' . $fila7['AllCalls'].'</font>';

          // Total de llamadas recibidas reportando otra situacion 
          $otrosReportes  ="SELECT count(motivo) as otrosReportes from datos_motivo where motivo = 3";
          $totrosReportes = mysqli_query($con, $otrosReportes);
          $fila8     = mysqli_fetch_assoc($totrosReportes);
          // echo 'Número de total de registros: <font color="red">' . $fila8['otrosReportes'].'</font>';

          // Total de sospechosos
          $sospechos="SELECT count(c_sos) as sospechosos FROM primarios where c_sos!=''";
          $tsos = mysqli_query($con, $sospechos);
          $fila    = mysqli_fetch_assoc($tsos);
          // echo 'Número de total de registros: <font color="red">' . $fila['sospechosos'].'</font>';
          // Total de casos confirmados 
          $confirmados="SELECT count(c_conf) as confirmados FROM primarios where c_conf!='' ";
          $tconf = mysqli_query($con, $confirmados);
          $fila2    = mysqli_fetch_assoc($tconf);
          // echo 'Número de total de registros: <font color="red">' . $fila2['confirmados'].'</font>';
          
          // Total de casos finalizados
          $scasof="SELECT count(status_caso) as finalizados FROM primarios WHERE status_caso=1 ";
          $tscasof = mysqli_query($con, $scasof);
          $fila3    = mysqli_fetch_assoc($tscasof);
          // echo 'Número de total de registros: <font color="red">' . $fila3['finalizados'].'</font>';
          
          // Total de casos en seguimiento 
          $scasos="SELECT count(status_caso) as seguimiento FROM primarios WHERE status_caso=0";
          $tscasos = mysqli_query($con, $scasos);
          $fila4    = mysqli_fetch_assoc($tscasos);
          // echo 'Número de total de registros: <font color="red">' . $fila4['seguimiento'].'</font>';

          ////////////////////////////////////////////////////////////////////////////////////////////////////

          // Conteo total de la segunda llamada de sospechosos
          //$segundaCall_sos = "SELECT sum(n_alum +n_doc+n_trab_e+n_papas) as Sospechosos from datos_motivo where motivo = 1";
          $segundaCall_sos = "SELECT (SUM(n_alum) + SUM(n_doc) + SUM(n_trab_e)) AS Sospechosos FROM datos_motivo";
          $query_segundaCall_sos = mysqli_query($con, $segundaCall_sos);
          $fila5    = mysqli_fetch_assoc($query_segundaCall_sos);
          // echo 'Número de total de registros: <font color="red">' . $fila5['Sospechosos'].'</font>';

          // Conteo total de la segunda llamada de confirmados 
          // $segundaCall_conf  ="SELECT sum(n_alum +n_doc+n_trab_e+n_papas) as Confirmados from datos_motivo where motivo = 2";
          $segundaCall_conf  ="SELECT (SUM(b_nalumnos) + SUM(b_ndocentes) + SUM(b_ntescuela)) AS Confirmados from positivos";
          $query_segundaCall_conf = mysqli_query($con, $segundaCall_conf);
          $fila6    = mysqli_fetch_assoc($query_segundaCall_conf);
          // echo 'Número de total de registros: <font color="red">' . $fila6['Confirmados'].'</font>';

          ///////////Consulta de referidos a Centros de salud//////////////////////////////
          $ninguno     = "SELECT count(referir) as ninguno from datos_motivo where referir=0";
          $q_ningunno  = mysqli_query($con,$ninguno);
          $fila9       = mysqli_fetch_assoc($q_ningunno);
          // echo 'Número de total de registros: <font color="red">' . $fila9['ninguno'].'</font>';


          $tlaltenango   = "SELECT count(referir) as Tlaltenango from datos_motivo where referir=1";
          $q_tlaltenango = mysqli_query($con,$tlaltenango);
          $fila10        = mysqli_fetch_assoc($q_tlaltenango);
          // echo 'Número de total de registros: <font color="red">' . $fila10['Tlaltenango'].'</font>'; 

          $villaFlores   = "SELECT count(referir) as VillaFlores from datos_motivo where referir=2";
          $q_villaFlores = mysqli_query($con,$villaFlores);
          $fila11        = mysqli_fetch_assoc($q_villaFlores);
          // echo 'Número de total de registros: <font color="red">' . $fila11['VillaFlores'].'</font>'; 

          $tepoztlan   = "SELECT count(referir) as Tepoz from datos_motivo where referir=3";
          $q_tepoztlan = mysqli_query($con,$tepoztlan );
          $fila12      = mysqli_fetch_assoc($q_tepoztlan);
          // echo 'Número de total de registros: <font color="red">' . $fila12['Tepoz'].'</font>'; 

          $jojutla     = "SELECT count(referir) as Jojutla from datos_motivo where referir=4";
          $q_jojutla   = mysqli_query($con,$jojutla);
          $fila13      = mysqli_fetch_assoc($q_jojutla); 
          // echo 'Número de total de registros: <font color="red">' . $fila13['Jojutla'].'</font>';

          $penaFlores   = "SELECT count(referir) as PenaFlores from datos_motivo where referir=5";
          $q_penaFlores = mysqli_query($con,$penaFlores);
          $fila14       = mysqli_fetch_assoc($q_penaFlores);
          // echo 'Número de total de registros: <font color="red">' . $fila14['PenaFlores'].'</font>'; 

          $modulo   = "SELECT count(referir) as modulov from datos_motivo where referir=6";
          $q_modulo = mysqli_query($con,$modulo );
          $fila15       = mysqli_fetch_assoc($q_modulo);
          // echo 'Número de total de registros: <font color="red">' .$fila15['modulov'].'</font>';  

          // Querys para obtener  top municipios postivos
          $mun_positivos = "SELECT pri.municipio as municipio, count(pri.municipio) as TotalMun,SUM(p.b_nalumnos+p.b_ndocentes+p.b_ntescuela) as positivos
                            from positivos as p, primarios as pri where pri.folio = p.folio group by pri.municipio order by positivos desc limit 10";
          $q_mun_positivos = mysqli_query($con,$mun_positivos);
          //$fila16          = mysqli_fetch_assoc($q_mun_positivos);
          // echo 'Número de total de registros: <font color="red">'.$filas16['municipio'].'<br>'.$filas16['positivos']'.' </font>';       
          
          $cerradas = "SELECT count(pri.status_esc)  as Esc_Cerrada from primarios pri where pri.status_esc=0"; 
          $q_cerradas = mysqli_query($con, $cerradas);  
          
          $abiertas = "SELECT count(pri.status_esc)  as Esc_Abierta from primarios pri where pri.status_esc=1";
          $q_abiertas = mysqli_query($con, $abiertas);
          

          ?>
          <p><center><h5> <b>Resumen de llamadas recibidas en el Departamento de <br> Promoción de la salud de Servicios de Salud de Morelos</b></h5></center></p>
          <div class="row mb-3">
          <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" onmouseover="this.style.backgroundColor='#edfff4'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><center> Total de llamadas recibidas en Promoción a la Salud </center></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center> <?php echo $fila7['AllCalls']; ?></center></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-calendar"></i> Hasta la fecha: </span>
                        <span><b> <?php  echo date("d-m-Y");?> </b></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-3x fa-phone-square"></i>
                      <!-- <i class="fas fa-calendar fa-2x text-primary"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Monthly) Card Example --> 
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100"  onmouseover="this.style.backgroundColor='#ffeded'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><center> No. de llamadas que reportan casos positivos por COVID-19: </center></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center> <?php echo $fila2['confirmados']; ?></center></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fa fa-calendar"></i> Hasta la fecha: </span>
                        <span><b> <?php  echo date("d-m-Y");?> </b></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class=" fas fa-3x fa-user-alt-slash color='red'"></i>
                      <!-- <i class="fas fa-calendar fa-2x text-primary"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" onmouseover="this.style.backgroundColor='#fff4ed'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-2"><center> No. de llamadas que reportan casos sospechosos por COVID-19: </center></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center> <?php echo $fila['sospechosos']; ?></center> </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-info mr-2"><i class="fas fa-calendar"></i> Hasta la fecha:</span>
                        <span><b><?php  echo date("d-m-Y");?></b></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-3x fa-user-secret"></i> <!--<i class="fas fa-users fa-2x text-info"></i>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100"  onmouseover="this.style.backgroundColor='#ebfffd'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-2"><center> No. de llamadas que reportan otra situación referente a COVID-19:</center></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center> <?php echo $fila8['otrosReportes']; ?></center> </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-info mr-2"><i class="fas fa-calendar"></i> Hasta la fecha:</span>
                        <span><b><?php  echo date("d-m-Y");?></b></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-3x fa-ambulance"></i> <!--<i class="fas fa-users fa-2x text-info"></i>--> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div> <!-- FIN_"row mb-3"--> 
   
    <div class="accordion-container">
      <a class="accordion-titulo"><font color="white"><b> Indicadores útiles para la Secretaria de Salud de Morelos</b></font><span class="toggle-icon"></span></a>
        <div class="accordion-content">

        <div class="row mb-3" > 
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" id="Demo2" onmouseover="this.style.backgroundColor='#fe271d'" onmouseout="this.style.backgroundColor='white'">
              <div class="card h-100" onmouseover="this.style.backgroundColor='#ffc1be'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><center> No. de casos positivos registrados en la segunda llamada (seguimiento): </center></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center><font color="red"><?php echo $fila6['Confirmados'];?></font></center></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fa fa-calendar"></i> Hasta la fecha: </span>
                        <span><b> <?php  echo date("d-m-Y");?> </b></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class=" fas fa-3x    far fa-frown"></i>
                      <!-- <i class="fas fa-calendar fa-2x text-primary"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" onmouseover="this.style.backgroundColor='#6331ff'" onmouseout="this.style.backgroundColor='white'">
              <div class="card h-100" onmouseover="this.style.backgroundColor='#e3daff'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-uppercase mb-2"><center> No. de casos sospechosos registrados en la segunda llamada (seguimiento): </center></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-900"><center><font color="orange"><?php echo $fila5['Sospechosos'];?></font></center> </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-info mr-2"><i class="fas fa-calendar"></i> Hasta la fecha:</span>
                        <span><b><?php  echo date("d-m-Y");?></b></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-3x far fa-meh"></i> <!--<i class="fas fa-users fa-2x text-info"></i>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" onmouseover="this.style.backgroundColor='#f98502'" onmouseout="this.style.backgroundColor='white'">
              <div class="card h-100" onmouseover="this.style.backgroundColor='#ffecd6'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><center> No. de casos en seguimiento: </center></div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><center><?php echo $fila4['seguimiento']; ?></center></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-warning mr-2"><i class="fas fa-calendar"></i> Hasta la fecha: </span>
                        <span> <?php  echo date("d-m-Y");?> </span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-3x fa-user-clock"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" onmouseover="this.style.backgroundColor='green'" onmouseout="this.style.backgroundColor='white'">
              <div class="card h-100" onmouseover="this.style.backgroundColor='#edfff4'" onmouseout="this.style.backgroundColor='white'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><center> No. de casos finalizados </center> </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center><?php echo $fila3['finalizados']; ?></center></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-calendar"></i> Hasta la fecha: </span>
                        <span><b> <?php  echo date("d-m-Y");?></b> </span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-3x fa-user-check"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- "row mb-3"-->
  
      </div><!-- Fin div Acordeon2 -->
  </div><!-- Fin div Acordeon2 -->
   
  <div class="accordion-container">
      <a class="accordion-titulo"><font color="white"><b> Indicadores útiles para el Deparamento de Promoción a la Salud de Morelos</b></font><span class="toggle-icon"></span></a>
        <div class="accordion-content" > 
         
          <div class="row mb-12" id="container-main">  
            <div class="col-xl-6 col-lg-7" class="accordion-container">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> Total de personas referidas a Centros de Salud para prueba covid-19 </h6>
                </div>
                <div>
                <div class="content table-responsive table-full-width">  
                  <table class="table table-hover table-striped" >
                    <thead>
                      <th style="color:#456789; font-size:80%;"><center>#</center></th>
                      <th style="color:#456789; font-size:80%;"><center>Municipio</center></th>
                      <th style="color:#456789; font-size:80%;"><center>Centro de Salud</center></th>
                      <th style="color:#456789; font-size:80%;"><center>Total de referidos</center></th>
                    </thead>
                    <tr>
                      <td style="font-size:70%;">1</td>
                      <td style="font-size:70%;">Cuernavaca y Jiutepec</td>
                      <td style="font-size:70%;">C.S. Tlaltenango </td>
                      <td style="font-size:70%;"><center><?php echo $fila10['Tlaltenango'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:70%;">2</td>
                      <td style="font-size:70%;">Temixco y Zapata </td>
                      <td style="font-size:70%;">C.S. Villa de las Flores</td>
                      <td style="font-size:70%;"><center><?php echo $fila11['VillaFlores'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:70%;">3</td>
                      <td style="font-size:70%;">Tepoztlán  </td>
                      <td style="font-size:70%;">C.S. Tepoztlan </td>
                      <td style="font-size:70%;"><center><?php echo $fila12['Tepoz'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:70%;">4</td>
                      <td style="font-size:70%;">Jojutla y Zacatepec  </td>
                      <td style="font-size:70%;">C.S. Jojutla</td>
                      <td style="font-size:70%;"><center><?php echo $fila13['Jojutla'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:70%;">5</td>
                      <td style="font-size:70%;">Todos lo municipios  </td>
                      <td style="font-size:70%;">C.S. Pena Flores</td>
                      <td style="font-size:70%;"><center><?php echo $fila14['PenaFlores'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:70%;">6</td>
                      <td style="font-size:70%;"> Modulos de pruebas COVID-19 </td>
                      <td style="font-size:70%;"> <font color="red">*Cambian cada semana </font></td>
                      <td style="font-size:70%;"><center><?php echo $fila15['modulov'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:70%;">7</td>
                      <td style="font-size:70%;"> Sin referir </td>
                      <td style="font-size:70%;"> N/A </td>
                      <td style="font-size:70%;"><center><?php echo $fila9['ninguno'];?></center></td>
                    </tr>
                  </table>
                </div>
                 </div>
                <div class="card-body">
                  <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                </div>
              </div>
            </div> <!-- col-xl-6 col-lg-7 Transferidos-->

            <div class="col-xl-6 col-lg-7" class="accordion-container">
                <div class="card mb-4" class="accordion-container">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary align-items-center" > Top 10 de municipios con mayor cantidad de casos positivos COVID-19 </h6>
                  </div>
                <div>
                <div class="content table-responsive table-full-width">  
                    <table class="table table-hover table-striped" style="width:100%">
                        <tbody>
                          <thead>
                            <th style="color:#456789; font-size:80%;"><center> # </center></th>
                            <th style="color:#456789; font-size:80%;"><center>Municipio</center></th>
                            <th style="color:#456789; font-size:80%;"><center>No. positivos </center></th>
                          </thead>
                            <div hidden>
                              <?php while ($rowsolMun = mysqli_fetch_assoc($q_mun_positivos)){ $municipio = $rowsolMun['municipio']; $positivos = $rowsolMun['positivos']; $i=$i+1; ?> 
                            </div>
                            <tr>
                              <td style="font-size:70%;"><center><?php echo $i;?></center></td>
                              <td style="font-size:70%;"><?php echo $municipio;?></td>
                              <td style="font-size:70%;"><center><?php echo $positivos; ?></center></td>
                            </tr>
                              <?php }?>
                        </tbody>
                    </table>  
                </div>
                </div>
                <div class="card-body">
                    <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                </div>
              </div>
          </div><!--ol-xl-6 col-lg-7 Municipios-->

        </div>
<div class="row mb-12" id="container-main"> 
          <div class="col-xl-6 col-lg-7" class="accordion-container">
                <div class="card mb-4" class="accordion-container">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary align-items-center" > Estatus de las escuelas en Morelos </h6>
                  </div>
                <div>
                <div class="content table-responsive table-full-width">  
                    <table class="table table-hover table-striped" style="width:100%">
                        <tbody>
                          <thead>
                            <th style="color:#456789; font-size:80%;"><center> Abiertas</center></th>
                            <th style="color:#456789; font-size:80%;"><center> Cerradas </center></th>
                          </thead>
                            <tr>
                              <td style="font-size:70%;"><center>
                                <?php while ($rowAbiertas = mysqli_fetch_assoc($q_abiertas))
                                            { echo $rowAbiertas['Esc_Abierta'];?></center><?php }?>
                              </td>
                              <td style="font-size:70%;"><center>
                                <?php while ($rowCerrada = mysqli_fetch_assoc($q_cerradas))
                                            { echo $rowCerrada['Esc_Cerrada'];?></center><?php }?>
                              </td>
                            </tr>
                              
                        </tbody>
                    </table>  
                </div>
                </div>
                <div class="card-body">
                    <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                </div>
              </div>
          </div><!--ol-xl-6 col-lg-8  Estado escuelas abiertas y cerradas-->

          <div class="col-xl-6 col-lg-7" class="accordion-container">
                <div class="card mb-4" class="accordion-container">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary align-items-center" > Cantidad de alumnos, maestros y trabajadores sospechosos y confirmados en escuelas de Morelos </h6>
                  </div>
                <div>
                <div class="content table-responsive table-full-width">  
                    <table class="table table-hover table-striped" style="width:100%">
                        <tbody>
                          <thead>
                            <th style="color:#456789; font-size:80%;"><center>  </center></th>
                            <th style="color:#456789; font-size:80%;"><center> No. Alumnos </center></th>
                            <th style="color:#456789; font-size:80%;"><center> No. Docentes </center></th>
                            <th style="color:#456789; font-size:80%;"><center> No. Trabajadores </center></th>
                          </thead>
                            <tr>
                              <td style="font-size:70%;"><center>Sospechosos </center> </td>
                              <td style="font-size:70%;"><center>
                                <?php 
                                $alumnnos_sos  = "SELECT SUM(n_alum) as Total_Alum_Sospechosos from datos_motivo";
                                $q_alumnos_sos = mysqli_query($con, $alumnnos_sos);
                                while($row_alum_sos = mysqli_fetch_assoc($q_alumnos_sos))
                                      { echo $row_alum_sos['Total_Alum_Sospechosos']; } ?></center>
                              </td>
                              <td style="font-size:70%;"><center>
                                <?php   
                                $docentes_sos   = "SELECT SUM(n_doc) as Total_Doc_Sospechosos from datos_motivo";
                                $q_docentes_sos = mysqli_query($con, $docentes_sos);
                                while($row_doc_sos = mysqli_fetch_assoc($q_docentes_sos))
                                { echo $row_doc_sos['Total_Doc_Sospechosos'];} ?> </center>
                              </td>
                              <td style="font-size:70%;"><center>
                                <?php 
                                   $trabajadores_sos = "SELECT SUM(n_trab_e) as Total_Tra_Sospechosos from datos_motivo";
                                   $q_trabajadores_sos = mysqli_query($con, $trabajadores_sos);
                                  while($row_tra_sos = mysqli_fetch_assoc($q_trabajadores_sos))
                                  { echo $row_tra_sos['Total_Tra_Sospechosos'];} ?> </center>
                              </td>
                            </tr> 
                            <tr>
                              <td style="font-size:70%;"><center>Confirmados </center></td>
                              <td style="font-size:70%;"><center>
                                <?php 
                                $alumnnos_pos = "SELECT SUM(b_nalumnos) as AlumnosPositivos from positivos";
                                $q_alumnos_pos = mysqli_query($con, $alumnnos_pos);
                                while ($row_alum_pos = mysqli_fetch_assoc($q_alumnos_pos))
                                  {echo $row_alum_pos['AlumnosPositivos']; } ?></center>
                            </td>
                              <td style="font-size:70%;"><center>
                                <?php 
                                $docentes_pos = "SELECT SUM(b_ndocentes) as DocentesPositivos from positivos";
                                $q_docentes_pos = mysqli_query($con, $docentes_pos);
                                while ($row_doc_pos = mysqli_fetch_assoc($q_docentes_pos))
                                  { echo $row_doc_pos['DocentesPositivos'];} ?> </center>
                              </td>
                              <td style="font-size:70%;"><center>
                                <?php 
                                $q_trabajadores_pos = "SELECT SUM(b_ntescuela) as TrabajadoresPositivos from positivos";
                                $q_trabajadores_pos = mysqli_query($con, $q_trabajadores_pos);
                                while ($row_tra_pos = mysqli_fetch_assoc($q_trabajadores_pos))
                                  { echo $row_tra_pos['TrabajadoresPositivos']; } ?> </center>
                              </td>
                            </tr>
                              
                        </tbody>
                    </table>  
                </div>
                </div>
                <div class="card-body">
                    <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                </div>
              </div>
          </div><!--ol-xl-6 col-lg-8 No. Alumnos, Docentes y Trabajadores-->
  </div> <!-- FIN_DIV_Contiene tablas de escuelas y total de alumnos-->

      </div><!-- Fin div Acordeon2 -->
    </div><!-- Fin div Acordeon2 -->

  <div class="accordion-container">
      <a class="accordion-titulo"><font color="white"><b>Indicadores de salud escolar</b></font><span class="toggle-icon"></span></a>
        <div class="accordion-content" > 
            
              <div class="card mb-10">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary align-items-center"> Total de indicaciones realizadas por parte del Departamento de promoción a la salud (SSM) </h6>
                </div>
                <div>
                <div class="content table-responsive table-full-width">  
                  <table class="table table-hover table-striped" width=80%>
                    <thead>
                      <th style="color:#456789; font-size:90%;"><center>#</center></th>
                      <th style="color:#456789; font-size:90%;"><center>Indicación</center></th>
                      <th style="color:#456789; font-size:90%;"><center># Casos Sospechosos</center></th>
                      <th style="color:#456789; font-size:90%;"><center># Casos Confirmados</center></th>
                      <th style="color:#456789; font-size:90%;"><center># otros casos</center></th> 
                    </thead>
                    <tr>
                      <?php 
                      $m1      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=1";
                      $q_m1  = mysqli_query($con,$m1); $filaM1 = mysqli_fetch_assoc($q_m1);

                      $m2      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=2";
                      $q_m2  = mysqli_query($con,$m2); $filaM2 = mysqli_fetch_assoc($q_m2);
                      
                      $m3      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=3";
                      $q_m3  = mysqli_query($con,$m3); $filaM3 = mysqli_fetch_assoc($q_m3);

                      $m4      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=4";
                      $q_m4  = mysqli_query($con,$m4); $filaM4 = mysqli_fetch_assoc($q_m4);

                      $m5      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=5";
                      $q_m5  = mysqli_query($con,$m5); $filaM5 = mysqli_fetch_assoc($q_m5);

                      $m6      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=6";
                      $q_m6  = mysqli_query($con,$m6); $filaM6 = mysqli_fetch_assoc($q_m6);

                      $m7      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=7";
                      $q_m7  = mysqli_query($con,$m7); $filaM7 = mysqli_fetch_assoc($q_m7);

                      $m8      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=8";
                      $q_m8  = mysqli_query($con,$m8); $filaM8 = mysqli_fetch_assoc($q_m8);

                      $m9      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=9";
                      $q_m9  = mysqli_query($con,$m9); $filaM9 = mysqli_fetch_assoc($q_m9);

                      $m10      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=10";
                      $q_m10  = mysqli_query($con,$m10); $filaM10 = mysqli_fetch_assoc($q_m10);

                      $m11      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=11";
                      $q_m11  = mysqli_query($con,$m11); $filaM11 = mysqli_fetch_assoc($q_m11);

                      $m12      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=0 or indicaciones='' ";
                      $q_m12  = mysqli_query($con,$m12); $filaM12 = mysqli_fetch_assoc($q_m12);

                      $m13      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=1 and indicaciones=13 ";
                      $q_m13  = mysqli_query($con,$m13); $filaM13 = mysqli_fetch_assoc($q_m13);

                      $m1_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=1";
                      $q_m1_p  = mysqli_query($con,$m1_p); $filaM1_p = mysqli_fetch_assoc($q_m1_p);

                      $m2_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=2";
                      $q_m2_p  = mysqli_query($con,$m2_p); $filaM2_p = mysqli_fetch_assoc($q_m2_p);

                      $m3_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=3";
                      $q_m3_p  = mysqli_query($con,$m3_p); $filaM3_p = mysqli_fetch_assoc($q_m3_p);

                      $m4_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=4";
                      $q_m4_p  = mysqli_query($con,$m4_p); $filaM4_p = mysqli_fetch_assoc($q_m4_p);

                      $m5_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=5";
                      $q_m5_p  = mysqli_query($con,$m5_p); $filaM5_p = mysqli_fetch_assoc($q_m5_p);
                      
                      $m6_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=6";
                      $q_m6_p  = mysqli_query($con,$m6_p); $filaM6_p = mysqli_fetch_assoc($q_m6_p);

                      $m7_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=7";
                      $q_m7_p  = mysqli_query($con,$m7_p); $filaM7_p = mysqli_fetch_assoc($q_m7_p);

                      $m8_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=8";
                      $q_m8_p  = mysqli_query($con,$m8_p); $filaM8_p = mysqli_fetch_assoc($q_m8_p);

                      $m9_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=9";
                      $q_m9_p  = mysqli_query($con,$m9_p); $filaM9_p = mysqli_fetch_assoc($q_m9_p);

                      $m10_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=10";
                      $q_m10_p  = mysqli_query($con,$m10_p); $filaM10_p = mysqli_fetch_assoc($q_m10_p);

                      $m11_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=11";
                      $q_m11_p  = mysqli_query($con,$m11_p); $filaM11_p = mysqli_fetch_assoc($q_m11_p);

                      $m12_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=0 or b_indicaciones=''";
                      $q_m12_p  = mysqli_query($con,$m12_p); $filaM12_p = mysqli_fetch_assoc($q_m12_p);

                      $m13_p      = "SELECT count(b_indicaciones) as indicaciones from positivos where b_indicaciones=12";
                      $q_m13_p  = mysqli_query($con,$m13_p); $filaM13_p = mysqli_fetch_assoc($q_m13_p);

                      $m1_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=1";
                      $q_m1_o  = mysqli_query($con,$m1_o); $filaM1_o = mysqli_fetch_assoc($q_m1_o);

                      $m2_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=2";
                      $q_m2_o  = mysqli_query($con,$m2_o); $filaM2_o = mysqli_fetch_assoc($q_m2_o); 

                      $m3_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=3";
                      $q_m3_o  = mysqli_query($con,$m3_o); $filaM3_o = mysqli_fetch_assoc($q_m3_o);

                      $m4_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=4";
                      $q_m4_o  = mysqli_query($con,$m4_o); $filaM4_o = mysqli_fetch_assoc($q_m4_o);

                      $m5_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=5";
                      $q_m5_o  = mysqli_query($con,$m5_o); $filaM5_o = mysqli_fetch_assoc($q_m5_o);

                      $m6_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=6";
                      $q_m6_o  = mysqli_query($con,$m6_o); $filaM6_o = mysqli_fetch_assoc($q_m6_o);

                      $m7_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=7";
                      $q_m7_o  = mysqli_query($con,$m7_o); $filaM7_o = mysqli_fetch_assoc($q_m7_o);

                      $m8_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=8";
                      $q_m8_o  = mysqli_query($con,$m8_o); $filaM8_o = mysqli_fetch_assoc($q_m8_o);

                      $m9_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=9";
                      $q_m9_o  = mysqli_query($con,$m9_o); $filaM9_o = mysqli_fetch_assoc($q_m9_o);

                      $m10_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=10";
                      $q_m10_o  = mysqli_query($con,$m10_o); $filaM10_o = mysqli_fetch_assoc($q_m10_o);

                      $m11_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=11";
                      $q_m11_o  = mysqli_query($con,$m11_o); $filaM11_o = mysqli_fetch_assoc($q_m11_o);

                      $m12_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=0 or indicaciones=''";
                      $q_m12_o  = mysqli_query($con,$m12_o); $filaM12_o = mysqli_fetch_assoc($q_m12_o);

                      $m13_o      = "SELECT count(indicaciones) as indicaciones from datos_motivo where motivo=3 and indicaciones=12";
                      $q_m13_o  = mysqli_query($con,$m13_o); $filaM13_o = mysqli_fetch_assoc($q_m13_o);
                      
                       ?>
                      <td style="font-size:80%;">1</td>
                      <td style="font-size:80%;"> Asesoramiento respecto a la correcta desinfección de lugares</td>
                      <td style="font-size:80%;"><center><?php echo $filaM1['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM1_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM1_o['indicaciones'];?></center></td>
                    </tr>
                     <tr>
                      <td style="font-size:80%;">2</td>
                      <td style="font-size:80%;"> Asesoria para mitigar el riesgo de contagio COVID-19 para alumnos</td>
                      <td style="font-size:80%;"><center><?php echo $filaM2['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM2_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM2_o['indicaciones'];?></center></td>
                    </tr>
                     <tr>
                      <td style="font-size:80%;">3</td>
                      <td style="font-size:80%;"> Asesoria para mitigar el riesgo de contagio COVID-19 para docentes</td>
                      <td style="font-size:80%;"><center><?php echo $filaM3['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM3_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM3_o['indicaciones'];?> </center></td>
                    </tr>
                    <tr>
                      <td style="font-size:80%;">4</td>
                      <td style="font-size:80%;"> Asesoría para mitigar el riesgo de contagio COVID-19 para familiares </td>
                      <td style="font-size:80%;"><center><?php echo $filaM4['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM4_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM4_o['indicaciones'];?> </center></td>
                    </tr>
                    <tr>
                      <td style="font-size:80%;">5</td>
                      <td style="font-size:80%;"> Capacitación sobre escudo de la salud  </td>
                      <td style="font-size:80%;"><center><?php echo $filaM5['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM5_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM5_o['indicaciones'];?> </center></td>
                    </tr>
                    <tr>
                      <td style="font-size:80%;">6</td>
                      <td style="font-size:80%;">  Capacitación sobre alimentación saludable  </td>
                      <td style="font-size:80%;"><center><?php echo $filaM6['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM6_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM6_o['indicaciones'];?> </center></td>
                    </tr>
                     <tr>
                      <td style="font-size:80%;">7</td>
                      <td style="font-size:80%;">  Capacitación sobre actividad física  </td>
                      <td style="font-size:80%;"><center><?php echo $filaM7['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM7_p['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM7_o['indicaciones'];?> </center></td>
                    </tr>
                     <tr>
                      <td style="font-size:80%;">8</td>
                      <td style="font-size:80%;"> Capacitación sobre lavado y desinfección de manos </td>
                      <td style="font-size:80%;"><center><?php echo $filaM8['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM8_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM8_o['indicaciones'];?></center></td>
                    </tr>
                     <tr>
                      <td style="font-size:80%;">9</td>
                      <td style="font-size:80%;"> Capacitación sobre el uso correcto de cubrebocas  </td>
                      <td style="font-size:80%;"><center><?php echo $filaM9['indicaciones'];?> </center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM9_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM9_o['indicaciones'];?></center></td>
                    </tr>
                     <tr>
                      <td style="font-size:80%;">10</td>
                      <td style="font-size:80%;"> Capacitación sobre actividades para la vida  </td>
                      <td style="font-size:80%;"><center><?php echo $filaM10['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM10_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM10_o['indicaciones'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:80%;">11</td>
                      <td style="font-size:80%;"> Capacitación sobre higiene personal   </td>
                      <td style="font-size:80%;"><center><?php echo $filaM11['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM11_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM11_o['indicaciones'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:80%;">12</td>
                      <td style="font-size:80%;"> Orientación telefónica COVID-19</td>
                      <td style="font-size:80%;"><center><?php echo $filaM13['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM13_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM13_o['indicaciones'];?></center></td>
                    </tr>
                    <tr>
                      <td style="font-size:80%;">12</td>
                      <td style="font-size:80%;"> Otras indicaciones </td>
                      <td style="font-size:80%;"><center><?php echo $filaM12['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM12_p['indicaciones'];?></center></td>
                      <td style="font-size:80%;"><center><?php echo $filaM12_o['indicaciones'];?></center></td>
                    </tr>
                  </table>
                </div>
                 </div>
                <div class="card-body">
                  <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                </div>
              </div>
          
        </div>
  </div>


  <div class="accordion-container">
      <a class="accordion-titulo"><font color="white"><b> Gráficas</b></font><span class="toggle-icon"></span></a>
        <div class="accordion-content"> 

            <div class="row mb-6" id="container-main" > 
                    <div class="card mb-6" class="accordion-container">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary align-items-center" > Cantidad de escuelas abiertas por municipio de Morelos</h6>
                      </div>
                    <div>
                       <div id="cargaBarras"  width="200" height="200"></div>
                    </div>
                    <div class="card-body">
                        <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                    </div>
                  </div>
          </div>

          <div class="row mb-6" id="container-main" > 
                    <div class="card mb-6" class="accordion-container">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary align-items-center" > Cantidad de casos positivos o sospechosos reportados por dia </h6>
                      </div>
                    <div>
                       <div id="cargaLineas"  width="200" height="200"></div>
                    </div>
                    <div class="card-body">
                        <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                    </div>
                  </div>
          </div>

          <div class="row mb-6" id="container-main">
            <div class="card mb-6" class="accordion-container">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary align-items-center" > Totales de los sintomas reportados como casos sospechosos </h6>
                      </div>
                    <div>
                       <div id="cargaRadial" ></div>
                    </div>
                    <div class="card-body">
                        <div><center><b> Fecha de actualización: </b><font color='green'><?php  echo date("d-m-Y");?></font></center></div>
                    </div>
                  </div>
          </div>
        
        </div><!-- Fin div Acordeon2 -->
</div><!-- Fin div Acordeon2 -->



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
                  <p>¿Estas seguro de cerrar sesión (salir)?</p>
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
  </div> <!-- Fin_sidelbar -->

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script> -->
  
  <script type="text/javascript">
  $(function(){
  $(".accordion-titulo").click(function(e){
           
        e.preventDefault();
    
        var contenido=$(this).next(".accordion-content");

        if(contenido.css("display")=="none"){ //open    
          contenido.slideDown(250);     
          $(this).addClass("open");
        }
        else{ //close   
          contenido.slideUp(250);
          $(this).removeClass("open");  
        }

      });
      });
  </script>

  <script type="text/javascript">
    $(document).ready(function (){
        //$('#cargaLineal').load('lineal.php');
        $('#cargaBarras').load('graficas/barras.php');
        $('#cargaLineas').load('graficas/lineas.php');
        $('#cargaRadial').load('graficas/radial.php');

    });
</script>

</body>
</html>