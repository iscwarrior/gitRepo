<?php session_start(); if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1){ echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">'; exit(); } $usr =$_SESSION['login_user_sys']; ?>
<?php 
   $buscar1='0000-00-00'; 
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
                  <form autocomplete="off" action="consultaesc.php" method="post" id="myForm" name='myForm' accept-charset="utf-8">

                    <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-2">  <!--Fecha-->
                                <div class="form-group">
                                    <label>Fecha de consulta</label>
                                    <input type="text" name="fecha" class="form-control" disabled placeholder="fecha" value=<?php  echo date("d-m-Y");?>>
                                </div>  
                            </div>                      
                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label><b>Escribe el nombre de la escuela</b></label>
                                    <input type="text" name="consulta1" id='fecha1' min="0" class="form-control" value="" return required="TRUE">
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                          <table id="table" class="table table-hover table-striped" style="width:100%">
                                              <thead>
                                                  <th style="color:#456789; font-size:85%;"><center>Folio</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Fecha</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Nivel educativo</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Escuela</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Municipio</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Responsable </center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Teléfono </center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>No. sospechosos</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>No. positvos</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Status</center></th>
                                                  <th style="color:#456789; font-size:85%;"><center>Comentarios</center></th>
                                                </thead>
                                                <?php

                                                $s = "SELECT folio, fecha_reg, whocall_name, cargo_whocall, name_esc, name_dir, telefono, municipio, status_caso, comentarios_caso, nivel_edu from primarios where name_esc like '%$buscar1%' order by folio desc";
                                                $r= mysqli_query($con, $s);
                                                while ($rowsol = mysqli_fetch_assoc($r)){
                                                $sos ="SELECT (SUM(n_alum+n_doc+n_trab_e+n_papas)) as Sospechoso from datos_motivo where folio=".$rowsol['folio']." ";
                                                $conf = "SELECT (SUM(b_nalumnos+b_ndocentes+b_ntescuela+b_nfamiliar)) as Confirmados from positivos where folio=".$rowsol['folio']." ";

                                                 $exe_sos = mysqli_query($con,$sos);
                                                 $exe_conf = mysqli_query($con,$conf);

                                                 $rowSos = mysqli_fetch_assoc($exe_sos);
                                                 $rowConf = mysqli_fetch_assoc($exe_conf);
                                                ?> 
                                              <tbody>
                                                <tr class="odd pointer">
                                                  <td style="font-size:75%;"><b><center><?php echo $rowsol['folio'];?></center></b></td>
                                                  <td style="font-size:75%;"><center><?php echo $rowsol['fecha_reg'];?></center></td>
                                                  <td style="font-size:75%;"><center><?php 
                                                  if($rowsol['nivel_edu']==NULL) {$ne = ''; echo $ne;} 
                                                  elseif($rowsol['nivel_edu']==0) {$ne = 'Prescolar'; echo $ne;}
                                                  if($rowsol['nivel_edu']==1) {$ne = 'Primaria'; echo $ne;} 
                                                  if($rowsol['nivel_edu']==2) {$ne = 'Secundaria'; echo $ne;} 
                                                  if($rowsol['nivel_edu']==3) {$ne = 'Nivel medio superior'; echo $ne;} 
                                                  if($rowsol['nivel_edu']==4) {$ne = 'Superior'; echo $ne;} ?></center></td>
                                                  <td style="font-size:75%;color:#007840;"><b><center><?php echo $rowsol['name_esc'];?></center></b></td>
                                                  <td style="font-size:75%;"><center><?php echo $rowsol['municipio'];?></center></td>
                                                  <td style="font-size:75%;"><center><?php echo $rowsol['whocall_name'];?></center></td>
                                                  <td style="font-size:75%;"><center><?php echo $rowsol['telefono'];?></center></td>
                                                  <td style="font-size:75%;"><center><font color="purple">
                                                  <?php if($rowSos['Sospechoso']==0 ){ $s = 0; echo $s; }else { echo $rowSos['Sospechoso'];} ?>
                                                  </font></center></td>
                                                  <td style="font-size:75%;"><center><font color="red">
                                                  <?php if($rowConf['Confirmados']==0 ){ $c = 0; echo $c; }else { echo $rowConf['Confirmados'];} 
                                                  ?></font></center></td>
                                                  <td style="width:80px; font-size:75%;"><?php 

                                                  if($rowsol['status_caso']==NULL){$sc = ' '; echo $sc;} 
                                                  elseif($rowsol['status_caso']==0) {$sc = 'Seguimiento'; echo $sc;}
                                                  if($rowsol['status_caso']==1) {$sc = 'Finalizado'; echo $sc;} ?></td>
                                                  <td style="font-size:75%"><?php echo '-'.$rowsol['comentarios_caso'];?></td>
                                                </tr>
                                                <?php } ?>
                                              </tbody>
                                          </table> <!-- fin_table-->
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