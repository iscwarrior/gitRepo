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
                  <form autocomplete="off" action="buscar.php" method="post" id="myForm" name='myForm' accept-charset="utf-8">

                    <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-2">  <!--Fecha-->
                                <div class="form-group">
                                    <label>Fecha del reporte</label>
                                    <input type="text" name="fecha" class="form-control" disabled placeholder="fecha" value=<?php  echo date("d-m-Y");?>>
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label> Quién consulta la información:</label>
                                    <input type="text" name="responsable" id="responsable" class="form-control" readonly="" value="<?php echo $usr;?>">
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                      
                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label><b>1. </b>Fecha inicial</label>
                                    <input type="date" name="fecha1" id='fecha1' class="form-control" value="" return required="TRUE">
                                </div>
                            </div>
                            <div class="col-md-2">  
                                <div class="form-group">

                                    <label><b>2.</b>Fecha final</label>
                                    <input type="date" name="fecha2" id='fecha2' class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-3">
                               <div class="form-group">
                               <BR>
                                <button type="submit" class="btn btn-primary" name="guardar" id="guardar"> Consultar   </button>
                                <button type="reset" class="btn btn-danger" href="#">Cancelar</button> 
                               </div>
                            </div>                                              
                      </div> 

                    <div hidden=""> <?php $buscar1=$_POST['fecha1']; $buscar2=$_POST['fecha2']; ?> </div>

                    <div style="font-size:85%; color:#fff;border: 0px outset lightblue; background-color: #ff6331; text-align: center;"> 
                      Rango de fechas selecionadas: <b><?php echo $buscar1;?></b> a <b><?php echo $buscar2; ?></b></div>
                    
                      <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-12">  <!--Fecha-->
                                <div class="form-group">
                                <?php 
                                  $servername = "localhost"; // Nombre/IP del servidor
                                  $database = "bdr3p0r"; // Nombre de la BBDD
                                  $username = "root"; // Nombre del usuario
                                  $password = "root"; // Contraseña del usuario
                                  $con = mysqli_connect($servername, $username, $password, $database);
                                  if (!$con) { die("La conexión ha fallado: " . mysqli_connect_error()); }
                                                    
                                  $sql123= "SELECT folio, fecha_reg, name_esc, municipio, localidad from primarios where fecha_reg between '$buscar1' and '$buscar2'";
                                  $result = mysqli_query($con, $sql123);
                                ?> 
                               </div>
                          </div> <!-- FN COLUM12 -->  
                          <br>

                          <div class="col-xl-6 col-lg-7" class="accordion-container">
                            <div class="card mb-4" class="accordion-container"> 
                              <div class="content table-responsive table-full-width">  
                                  <table class="table table-hover table-striped" style="width:100%">
                                      <tbody>
                                        <thead>
                                          <th style="color:#456789; font-size:80%;"><center> # </center></th>
                                          <th style="color:#456789; font-size:80%;"><center>Municipio</center></th>
                                          <th style="color:#456789; font-size:80%;"><center>No. positivos </center></th>
                                          <th style="color:#456789; font-size:80%;"><center>No. sospechosos </center></th>
                                        </thead>
                                          <div hidden>
                                            <?php 
                                            $mun_positivos = "SELECT p.municipio, COUNT(p.municipio) munTotal, 
                                                              SUM(pos.b_nalumnos+pos.b_ndocentes+pos.b_ntescuela) as confirmados 
                                                              from positivos as pos, primarios p  where p.folio = pos.folio 
                                                              and p.fecha_reg between '$buscar1' and '$buscar2'
                                                              group by p.municipio order by confirmados desc; ";
                                            $q_mun_positivos = mysqli_query($con,$mun_positivos);

                                            $datos_sospechosos = "SELECT p.municipio, COUNT(p.municipio) munTotal, 
                                                                  SUM(dm.n_alum+dm.n_doc+dm.n_trab_e) as sospechosos 
                                                                  from datos_motivo as dm, primarios p  where p.folio = dm.folio 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'
                                                                  group by p.municipio order by sospechosos desc;";  
                                            $q_mun_sospechosos = mysqli_query($con,$datos_sospechosos);
                                           

                                            while ($rowsolMun = mysqli_fetch_assoc($q_mun_positivos))
                                                  { 
                                                    $municipio = $rowsolMun['municipio']; 
                                                    $positivos = $rowsolMun['confirmados']; $i=$i+1; 
                                                    $rowsolSOS = mysqli_fetch_assoc($q_mun_sospechosos)
                                                    ?> 
                                          </div>
                                          <tr>
                                            <td style="font-size:70%;"><center><?php echo $i;?></center></td>
                                            <td style="font-size:70%;"><?php echo $municipio;?></td>
                                            <td style="font-size:70%;"><center><?php echo $positivos; ?></center></td>
                                            <td style="font-size:70%;"><center>
                                            <div hidden>  <?php 
                                              if($rowsolSOS['sospechosos']==' ' or $rowsolSOS['sospechosos']=='NULL' or $rowsolSOS['sospechosos']==null or $rowsolSOS['sospechosos']==FALSE)
                                                { $sosp = 0; 
                                                } else { 
                                                  $sosp = $rowsolSOS['sospechosos'];
                                                } ?></div>
                                               <?php  echo $sosp; }?></center></td>
                                          
                                          </tr>
                                            
                                      </tbody>
                                  </table>  
                              </div>
                            </div>
                          </div>

                          <div class="col-xl-6 col-lg-7" class="accordion-container">
                              <div class="card mb-4" class="accordion-container">                         
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
                                                $alumnnos_sos  = "SELECT SUM(dm.n_alum) as Total_Alum_Sospechosos from datos_motivo dm, primarios p where dm.folio = p.folio and p.fecha_reg between '$buscar1' and '$buscar2'";
                                                $q_alumnos_sos = mysqli_query($con, $alumnnos_sos);
                                                while($row_alum_sos = mysqli_fetch_assoc($q_alumnos_sos))
                                                      { echo $row_alum_sos['Total_Alum_Sospechosos']; } ?></center>
                                                </td>
                                                <td style="font-size:70%;"><center>
                                                <?php   
                                                $docentes_sos   = "SELECT SUM(n_doc) as Total_Doc_Sospechosos from datos_motivo dm, primarios p where dm.folio = p.folio and p.fecha_reg between '$buscar1' and '$buscar2'";
                                                $q_docentes_sos = mysqli_query($con, $docentes_sos);
                                                while($row_doc_sos = mysqli_fetch_assoc($q_docentes_sos))
                                                { echo $row_doc_sos['Total_Doc_Sospechosos'];} ?> </center>
                                                </td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                   $trabajadores_sos = "SELECT SUM(n_trab_e) as Total_Tra_Sospechosos from datos_motivo dm, primarios p where dm.folio = p.folio and p.fecha_reg between '$buscar1' and '$buscar2'";
                                                   $q_trabajadores_sos = mysqli_query($con, $trabajadores_sos);
                                                  while($row_tra_sos = mysqli_fetch_assoc($q_trabajadores_sos))
                                                  { echo $row_tra_sos['Total_Tra_Sospechosos'];} ?> </center>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td style="font-size:70%;"><center>Confirmados </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $alumnnos_pos = "SELECT SUM(b_nalumnos) as AlumnosPositivos from positivos pos, primarios p where pos.folio=p.folio and p.fecha_reg between '$buscar1' and '$buscar2'";
                                                $q_alumnos_pos = mysqli_query($con, $alumnnos_pos);
                                                while ($row_alum_pos = mysqli_fetch_assoc($q_alumnos_pos))
                                                  {echo $row_alum_pos['AlumnosPositivos']; } ?></center>
                                                </td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $docentes_pos = "SELECT SUM(b_ndocentes) as DocentesPositivos from positivos pos, primarios p where pos.folio = p.folio and p.fecha_reg between '$buscar1' and '$buscar2'";
                                                $q_docentes_pos = mysqli_query($con, $docentes_pos);
                                                while ($row_doc_pos = mysqli_fetch_assoc($q_docentes_pos))
                                                  { echo $row_doc_pos['DocentesPositivos'];} ?> </center>
                                                </td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $q_trabajadores_pos = "SELECT SUM(pos.b_ntescuela) as TrabajadoresPositivos from positivos pos, primarios p where pos.folio = p.folio and p.fecha_reg between '$buscar1' and '$buscar2'";
                                                $q_trabajadores_pos = mysqli_query($con, $q_trabajadores_pos);
                                                while ($row_tra_pos = mysqli_fetch_assoc($q_trabajadores_pos))
                                                  { echo $row_tra_pos['TrabajadoresPositivos']; } ?> </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>  
                                    <br><div style="border: 0px outset lightblue; background-color: lightblue; text-align: center;"> Reporte para la Secretaria de Salud Morelos.</div>
                                    <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                          <thead>
                                            <th style="color:#456789; font-size:80%;"><center> Nivel educativo </center></th>
                                            <th style="color:#456789; font-size:80%;"><center> Alumnos sospechosos </center></th>
                                            <th style="color:#456789; font-size:80%;"><center> Alumnos positivos </center></th>
                                            <th style="color:#456789; font-size:80%;"><center> Trabajadores sospechosos </center></th>
                                            <th style="color:#456789; font-size:80%;"><center> Trabajadores positivos </center></th>
                                          </thead>
                                            <tr>
                                                <td style="font-size:70%;"><center>Básica </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $alum_sos1 = "SELECT SUM(dm.n_alum) as AlumnosSos_1 from datos_motivo dm, primarios p 
                                                                where p.nivel_edu IN (0, 1 , 2) 
                                                                and p.fecha_reg between '$buscar1' and '$buscar2' 
                                                                and p.folio=dm.folio";
                                                $q_alum_sos1 = mysqli_query($con, $alum_sos1);
                                                while ($row_sos1 = mysqli_fetch_assoc($q_alum_sos1))
                                                  { echo $row_sos1['AlumnosSos_1']; } ?> </center></td>
                                                <td style="font-size:70%;"><center> 
                                                <?php 
                                                $alum_conf1 = "SELECT SUM(pos.b_nalumnos) as AlumnosPositivos_1 
                                                                      from positivos pos, primarios p 
                                                                      where p.nivel_edu IN (0, 1 , 2) 
                                                                        and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                        and p.folio=pos.folio";
                                                $q_alum_conf1 = mysqli_query($con, $alum_conf1);
                                                while ($row_conf1 = mysqli_fetch_assoc($q_alum_conf1))
                                                  { echo $row_conf1['AlumnosPositivos_1']; } ?>
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_sos1 = " SELECT SUM(dm.n_doc+dm.n_trab_e) as TrabajadoresSos_1 
                                                                  from datos_motivo dm, primarios p 
                                                                  where p.nivel_edu IN (0, 1 , 2) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                  and p.folio=dm.folio ";
                                                $q_trab_sos1 = mysqli_query($con, $trab_sos1);
                                                while ($row_trab_sos1 = mysqli_fetch_assoc($q_trab_sos1))
                                                  { echo $row_trab_sos1['TrabajadoresSos_1']; } ?>  
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_conf1 = "SELECT SUM(pos.b_ndocentes+pos.b_ntescuela) as TrabajadoresPositivos_1 
                                                                  from positivos pos, primarios p 
                                                                  where p.nivel_edu IN (0, 1 , 2) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'
                                                                  and p.folio=pos.folio ";
                                                $q_trab_conf1 = mysqli_query($con, $trab_conf1);
                                                while ($row_trab_conf1 = mysqli_fetch_assoc($q_trab_conf1))
                                                  { echo $row_trab_conf1['TrabajadoresPositivos_1']; } ?>
                                                </center></td>
                                            </tr> 

                                            <tr>
                                                <td style="font-size:70%;"><center>Media superior </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $alum_sos3 = "SELECT SUM(dm.n_alum) as AlumnosSos_3 from datos_motivo dm, primarios p 
                                                                where p.nivel_edu IN (3) 
                                                                and p.fecha_reg between '$buscar1' and '$buscar2' 
                                                                and p.folio=dm.folio";
                                                $q_alum_sos3 = mysqli_query($con, $alum_sos3);
                                                while ($row_sos3 = mysqli_fetch_assoc($q_alum_sos3))
                                                  { echo $row_sos3['AlumnosSos_3']; } ?> </center></td>
                                                <td style="font-size:70%;"><center> 
                                                <?php 
                                                $alum_conf3 = "SELECT SUM(pos.b_nalumnos) as AlumnosPositivos_3 
                                                                      from positivos pos, primarios p 
                                                                      where p.nivel_edu IN (3) 
                                                                        and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                        and p.folio=pos.folio";
                                                $q_alum_conf3 = mysqli_query($con, $alum_conf3);
                                                while ($row_conf3 = mysqli_fetch_assoc($q_alum_conf3))
                                                  { echo $row_conf3['AlumnosPositivos_3']; } ?>
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_sos3 = " SELECT SUM(dm.n_doc+dm.n_trab_e) as TrabajadoresSos_3 
                                                                  from datos_motivo dm, primarios p 
                                                                  where p.nivel_edu IN (3) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                  and p.folio=dm.folio ";
                                                $q_trab_sos3 = mysqli_query($con, $trab_sos3);
                                                while ($row_trab_sos3 = mysqli_fetch_assoc($q_trab_sos3))
                                                  { echo $row_trab_sos3['TrabajadoresSos_3']; } ?>  
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_conf3 = "SELECT SUM(pos.b_ndocentes+pos.b_ntescuela) as TrabajadoresPositivos_3 
                                                                  from positivos pos, primarios p 
                                                                  where p.nivel_edu IN (3) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'
                                                                  and p.folio=pos.folio ";
                                                $q_trab_conf3 = mysqli_query($con, $trab_conf3);
                                                while ($row_trab_conf3 = mysqli_fetch_assoc($q_trab_conf3))
                                                  { echo $row_trab_conf3['TrabajadoresPositivos_3']; } ?>
                                                </center></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:70%;"><center>Superior</center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $alum_sos4 = "SELECT SUM(dm.n_alum) as AlumnosSos_4 from datos_motivo dm, primarios p 
                                                                where p.nivel_edu IN (4) 
                                                                and p.fecha_reg between '$buscar1' and '$buscar2' 
                                                                and p.folio=dm.folio";
                                                $q_alum_sos4 = mysqli_query($con, $alum_sos4);
                                                while ($row_sos4 = mysqli_fetch_assoc($q_alum_sos4))
                                                  { echo $row_sos4['AlumnosSos_4']; } ?> </center></td>
                                                <td style="font-size:70%;"><center> 
                                                <?php 
                                                $alum_conf4 = "SELECT SUM(pos.b_nalumnos) as AlumnosPositivos_4 
                                                                      from positivos pos, primarios p 
                                                                      where p.nivel_edu IN (4) 
                                                                        and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                        and p.folio=pos.folio";
                                                $q_alum_conf4 = mysqli_query($con, $alum_conf4);
                                                while ($row_conf4 = mysqli_fetch_assoc($q_alum_conf4))
                                                  { echo $row_conf4['AlumnosPositivos_4']; } ?>
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_sos4 = " SELECT SUM(dm.n_doc+dm.n_trab_e) as TrabajadoresSos_4 
                                                                  from datos_motivo dm, primarios p 
                                                                  where p.nivel_edu IN (4) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                  and p.folio=dm.folio ";
                                                $q_trab_sos4 = mysqli_query($con, $trab_sos4);
                                                while ($row_trab_sos4 = mysqli_fetch_assoc($q_trab_sos4))
                                                  { echo $row_trab_sos4['TrabajadoresSos_4']; } ?>  
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_conf4 = "SELECT SUM(pos.b_ndocentes+pos.b_ntescuela) as TrabajadoresPositivos_4 
                                                                  from positivos pos, primarios p 
                                                                  where p.nivel_edu IN (4) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'
                                                                  and p.folio=pos.folio ";
                                                $q_trab_conf4 = mysqli_query($con, $trab_conf4);
                                                while ($row_trab_conf4 = mysqli_fetch_assoc($q_trab_conf4))
                                                  { echo $row_trab_conf4['TrabajadoresPositivos_4']; } ?>
                                                </center></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:70%;"><center>Total</center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $alum_sosT = "SELECT SUM(dm.n_alum) as AlumnosSos_T from datos_motivo dm, primarios p 
                                                                where p.nivel_edu IN (0, 1, 2, 3, 4) 
                                                                and p.fecha_reg between '$buscar1' and '$buscar2' 
                                                                and p.folio=dm.folio";
                                                $q_alum_sosT = mysqli_query($con, $alum_sosT);
                                                while ($row_sosT = mysqli_fetch_assoc($q_alum_sosT))
                                                  { echo $row_sosT['AlumnosSos_T']; } ?> </center></td>
                                                <td style="font-size:70%;"><center> 
                                                <?php 
                                                $alum_confT = "SELECT SUM(pos.b_nalumnos) as AlumnosPositivos_T 
                                                                      from positivos pos, primarios p 
                                                                      where p.nivel_edu IN (0, 1, 2, 3, 4) 
                                                                        and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                        and p.folio=pos.folio";
                                                $q_alum_confT = mysqli_query($con, $alum_confT);
                                                while ($row_confT = mysqli_fetch_assoc($q_alum_confT))
                                                  { echo $row_confT['AlumnosPositivos_T']; } ?>
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_sosT = " SELECT SUM(dm.n_doc+dm.n_trab_e) as TrabajadoresSos_T 
                                                                  from datos_motivo dm, primarios p 
                                                                  where p.nivel_edu IN (0, 1, 2, 3, 4) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'  
                                                                  and p.folio=dm.folio ";
                                                $q_trab_sosT = mysqli_query($con, $trab_sosT);
                                                while ($row_trab_sosT = mysqli_fetch_assoc($q_trab_sosT))
                                                  { echo $row_trab_sosT['TrabajadoresSos_T']; } ?>  
                                                </center></td>
                                                <td style="font-size:70%;"><center>
                                                <?php 
                                                $trab_confT = "SELECT SUM(pos.b_ndocentes+pos.b_ntescuela) as TrabajadoresPositivos_T 
                                                                  from positivos pos, primarios p 
                                                                  where p.nivel_edu IN (0, 1, 2, 3, 4) 
                                                                  and p.fecha_reg between '$buscar1' and '$buscar2'
                                                                  and p.folio=pos.folio ";
                                                $q_trab_confT = mysqli_query($con, $trab_confT);
                                                while ($row_trab_confT = mysqli_fetch_assoc($q_trab_confT))
                                                  { echo $row_trab_confT['TrabajadoresPositivos_T']; } ?>
                                                </center></td>
                                            </tr>
                                        </tbody>
                                    </table>  </div>

                                </div>
                              </div>
                          </div><!--ol-xl-6 col-lg-8 No. Alumnos, Docentes y Trabajadores-->



                      </div> <!-- Fin_row_1 -->
                      <br>
<!--                     <center>
                      <div>
                      <input name="bton" type="hidden" value="Registrar" >
                      <button type="submit" class="btn btn-primary" name="guardar" id="guardar" onclick="return alerta(event); validar()"> Guardar    </button> nclick="alerta();"
                      <button type="submit" class="btn btn-primary" name="guardar" id="guardar"> Consultar   </button>
                      <button type="reset" class="btn btn-danger" href="#">Cancelar</button> 
                      </div>
                    </center> -->
                    <br>

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