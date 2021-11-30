<?php session_start(); if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1){ exit(); echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">'; } ?>
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

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  

  <script type="text/javascript">
      
        function alerta()
        {
        var mensaje;
        var opcion = confirm('¿Está seguro de guardar el registro o desea cancelar?');
        if (opcion == true) { document.myForm.submit(); } else { return false; mensaje = 'Cancelaste :('; location.reload(); }
        }

        function habilitar_otro(valor){
        if(valor==6){
            document.getElementById("c_otros").disabled = false;
            }
            else {
                document.getElementById("c_otros").disabled = true;
                }
        } // Fin_habilitar_c6()
  </script>

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
              <li><a class="nav-link" href="seg.php?idseg"><i class="fas fa-medkit"></i><font color="white"> a) Sospechoso</font> </a></li>
              <li><a class="nav-link" href="b.php?idsegb"><i class="fas fa-medkit"></i><font color="white"> b) confirmado</font> </a></li>
              <li><a class="nav-link" href="c.php?idsegc"><i class="fas fa-medkit"></i><font color="white"> c) Otro</font>      </a></li>
              <li class="separator hidden-lg hidden-md"></li>
         </ul>
      <!--<a class="nav-link" href="#"><i class="fas fa-medkit"></i><font color="white"> <span> Sospechoso </span></font></a> 
          <a class="nav-link" href="#"><i class="fas fa-medkit"></i><font color="white"> <span> Confirmado </span></font></a>
          <a class="nav-link" href="#"><i class="fas fa-medkit"></i><font color="white"> <span> Otro </span></font></a>   -->
          <ul class="navbar-nav ml-auto"> 


            <div class="topbar-divider d-none d-sm-block"></div>
          
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"> <?php echo $_SESSION['login_user_sys']; ?></span>
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
                <h5 class="m-0 font-weight-bold text-primary"> <center>Seguimiento de incidencias (Regresar llamada)</center></h5>
                </div>
                <div class="card-body">
                  <form autocomplete="off" action="insertar_c.php" method="post" id="myForm3" accept-charset="utf-8">
                      <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-3">  
                                <div class="form-group">
                                    <label>Folio del reporte:</label>
                                    <input type="number" name="folio" id="folio" class="form-control" placeholder=" " value=" " required="">
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label> Responsable de captura:</label>
                                    <input type="text" name="responsable_c" id="responsable_c" class="form-control" readonly value="<?php echo $_SESSION['login_user_sys']; ?>">
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                      </div>

                      <h6 class="m-0 font-weight-bold text-primary"><center>c) Otro </center></h6><br>
                      <div class="row"> <!-- Inicio_row_2 -->
                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label><b>31. </b> ¿Que otro motivo?: </label>
                                    <select id="c_casos" name="c_casos" class="form-control" onchange="habilitar_otro(this.value);">
                                        <option value="0"> Seguimiento de caso pendiente</option>
                                        <option value="1"> Reportar regreso de llamada</option>
                                        <option value="2"> Desinfección</option>
                                        <option value="3"> Quejas</option>
                                        <option value="4"> Dudas </option>
                                        <option value="5"> Reportar alguna defunción </option>
                                        <option value="6"> Otro </option>
                                    </select>
                                </div>
                            </div>
                          <div class="col-md-8">  
                                <div class="form-group">
                                    <label><b> </b> Otro:</label>
                                    <input type="text" name="c_otros" id="c_otros" class="form-control" placeholder="Otro motivo de consulta" disabled="">
                                </div>
                            </div>    
                      </div>  <!-- Fin_Inicio_row_2 -->

                      <div class="row">     <!-- Inicio_row_3 --> 
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label><b>* </b><font color="red">Indicaciones realizadas: </font> </label>
                                  <select id="c_indicaciones" name="c_indicaciones" class="form-control">
                                        <option value="0"> Ninguna</option>
                                        <option value="1"> Asesoramiento respecto a la correcta desinfección de lugares </option>
                                        <option value="2"> Asesoria para mitigar el riesgo de contagio COVID-19 para alumnos </option>
                                        <option value="3"> Asesoria para mitigar el riesgo de contagio COVID-19 para docentes </option>
                                        <option value="4"> Asesoria para mitigar el riesgo de contagio COVID-19 para familiares </option>
                                        <option value="5"> Capacitación sobre escudo de la salud </option>
                                        <option value="6"> Capacitación sobre alimentacion saludable </option>
                                        <option value="7"> Capacitación sobre actividad fisica </option>
                                        <option value="8"> Capacitación sobre lavado y desinfeccion de manos </option>
                                        <option value="9"> Capacitación sobre el uso correcto de cubrebocas </option>
                                        <option value="10"> Capacitación sobre actividades para la vida </option>
                                        <option value="11"> Capacitación sobre higiene personal </option>
                                        <option value="12"> Orientacion telefónica COVID-19 </option>
                                    </select>
                              </div>
                          </div>               
                      </div>                <!-- fin_row_3-->         
                      <br>
                    <center>
                      <div>
                      <button type="submit" class="btn btn-primary" onclick="return alerta();">Guardar </button>
                      <button type="submit" class="btn btn-danger">Cancelar</button> 
                      </div>
                    </center>
                    <br>
                    <div hidden="">
                    <?php
                    $folio = $_GET["idsegc"];
                    if($_GET["msj"]=='No_insert') { echo "<script> Swal.fire('No se realizo el registro',':(','error');</script>"; }
                    if ($folio >=1) { echo "<script>Swal.fire('Seguimiento registrado exitosamente :) ','','success'); </script>";}
                    ?>
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
                  <a href="#" class="btn btn-primary">Salir</a>
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

</body>

</html>