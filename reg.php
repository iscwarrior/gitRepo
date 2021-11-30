<?php session_start(); if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1){ echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">'; exit(); } $usr =$_SESSION['login_user_sys']; ?>
<? require ('file/conex.php'); $folio = $_GET['id']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Atención COVID SSM</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
<!-- Select2 -->
  <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap DatePicker -->  
  <link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
  
  <script type="text/javascript"> 
    function alerta()
        {
        var mensaje;
        var opcion = confirm('¿Está seguro de guardar el registro o desea cancelar?');
        if (opcion == true) { document.myForm.submit(); } else { return false; mensaje = 'Cancelaste :('; location.reload(); }
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
                <h5 class="m-0 font-weight-bold text-primary"> <center> Registro de incidencias </center></h5>
                </div>
                <div class="card-body">
                  <form autocomplete="off" action="insertar_reg.php" method="post" id="myForm" accept-charset="utf-8">

                    <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-3">  <!--Fecha-->
                                <div class="form-group">
                                    <label>Fecha del reporte</label>
                                    <input type="text" name="fecha" class="form-control" disabled placeholder="fecha" value=<?php  echo date("d-m-Y");?>>
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label> Responsable de captura:</label>
                                    <input type="text" name="responsable" id="responsable" class="form-control" readonly="" value="<?php echo $usr;?>">
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                      </div>
                      <div class="row"> <!-- Inicio_row_1 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>1. </b>¿Quien llama? </label>
                                    <input type="text" name="whocall" id='whocall' class="form-control" placeholder=" Persona qué reporta" value="" required="">
                                </div>
                            </div>  
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>2.</b>¿Cuál es su cargo?</label>
                                    <input type="text" name="cargo" id='cargo' class="form-control" placeholder="Director/Maestro/Prefecto" required="">
                                </div>
                            </div>    
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>3.</b>¿Nombre de la escuela?</label>
                                    <input type="text" name="nescuela" id="nescuela" class="form-control" placeholder="Guadalupe victoria" required="">
                                </div>
                            </div>
                           <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>4.</b>¿Nombre del Director/a?</label>
                                    <input type="text" name="director" id='director' class="form-control" placeholder=" Lic. Benito Juarez">
                                </div>
                            </div>                  
                      </div>             <!-- Fin_row_1 -->

                      <div class="row"> <!-- Inicio_row_2 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>5.</b> ¿Nivel educativo?<br><br></label>
                                    <select id="neducativo" name="neducativo" class="form-control" required="">
                                        <option value="0"> Preescolar </option>
                                        <option value="1"> Primaria</option>
                                        <option value="2"> Secundaria</option>
                                        <option value="3"> Nivel medio superior</option>
                                        <option value="4"> Superior</option>
                                    </select>
                                </div>
                            </div>  
                    
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>6.</b>¿No. aprox. de alumnos que recibe?</label>
                                    <input type="number" name="nalumnos" id="nalumnos"class="form-control" placeholder="###">
                                </div>
                            </div>    
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>7.</b>¿Estado de la escuela?<br><br></label>
                                    <select id="estadoe" name="estadoe" class="form-control">
                                        <option value="0">Cerrada</option>
                                        <option value="1">Abierta</option>
                                    </select>
                                </div>
                            </div>
                           <div class="col-md-3">  
                                <div class="form-group">
                                     <label for="municipio"><b>9.</b></label>¿Municipio de la escuela? </label><br><br>
                                      <select class="select2-single form-control" name="municipio" id="municipio"  required="">
                                        <option value="">Selecciona un municipio</option>
                                        <option value="Amacuzac">Amacuzac</option>  
                                        <option value="Atlatlahucan">Atlatlahucan</option>
                                        <option value="Axochiapan">Axochiapan</option>
                                        <option value="Ayala">Ayala</option>
                                        <option value="Coatlán del Río">Coatlán del Río </option>
                                        <option value="Cuautla">Cuautla</option>
                                        <option value="Cuernavaca">Cuernavaca</option>
                                        <option value="Emiliano Zapata">Emiliano Zapata</option>
                                        <option value="Huitzilac">Huitzilac</option>
                                        <option value="Jantetelco">Jantetelco </option>
                                        <option value="Jiutepec">Jiutepec</option>
                                        <option value="Jojutla">Jojutla</option>
                                        <option value="Jonacatepec de Leandro Valle">Jonacatepec de Leandro Valle</option>
                                        <option value="Mazatepec">Mazatepec</option>
                                        <option value="Miacatlán">Miacatlán</option>
                                        <option value="Ocuituco">Ocuituco</option>
                                        <option value="Puente de Ixtla">Puente de Ixtla </option>
                                        <option value="Temixco">Temixco</option>
                                        <option value="Tepalcingo">Tepalcingo</option>
                                        <option value="Tepoztlán">Tepoztlán</option>
                                        <option value="Tetecala">Tetecala</option>
                                        <option value="Tetela del Volcán">Tetela del Volcán</option>
                                        <option value="Tlalnepantla">Tlalnepantla</option>
                                        <option value="Tlaltizapán de Zapata">Tlaltizapán de Zapata</option>
                                        <option value="Tlaquiltenango">Tlaquiltenango</option>
                                        <option value="Tlayacapan">Tlayacapan</option>
                                        <option value="Totolapan">Totolapan</option>
                                        <option value="Xochitepec">Xochitepec</option>
                                        <option value="Yautepec">Yautepec</option>
                                        <option value="Yecapixtla">Yecapixtla</option>
                                        <option value="Zacatepec">Zacatepec</option>
                                        <option value="Zacualpan de Amilpas">Zacualpan de Amilpas</option>
                                        <option value="Temoac">Temoac</option>
                                        <option value="Coatetelco">Coatetelco</option>
                                        <option value="Xoxocotla">Xoxocotla</option>
                                        <option value="Hueyapan">Hueyapan</option>
                                      </select>
                                </div>
                            </div>                  
                      </div>             <!-- Fin_row_2 -->

                      <div class="row"> <!-- Inicio_row_3 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>9.</b>¿Localidad de la escuela?</label>
                                    <input type="text" name="localidad" id="localidad" class="form-control" placeholder="Centro" required="">
                                </div>
                            </div>  
                    
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>10.</b>¿Motivo de la llamada?</label><br>
                                          <input type="checkbox" id="c_sos" name="c_sos" value="1">    
                                          <label for="c_sos"> Caso sospechoso </label><br>
                                          <input type="checkbox" id="c_conf" name="c_conf"value="2">  
                                          <label for="c_conf"> Caso positivo </label><br>
                                          <input type="checkbox" id="c_otro" name="c_otro" value="3">  
                                          <label for="c_otro"> Otro </label>
                                </div>
                            </div>    
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>11.</b>¿Cual es su No. telefónico?</label>
                                    <input type="number" name="tel" id="tel" class="form-control" placeholder="777 555 00 01" required="">
                                </div>
                            </div>
                           <div class="col-md-3">  
                                <div class="form-group">
                                    <label><b>12.</b>¿Algún caso presenta dificultad para respirar?</label>
                                    <select id="drespiracion" name="drespiracion" id="motivo" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>                  
                      </div>             <!-- Fin_row_3 -->
                      <br>
                
                    <center>
                      <div>
                      <input name="bton" type="hidden" value="Registrar" >
                      <button type="submit" class="btn btn-primary" name="guardar" id="guardar" onclick="return alerta()"> Guardar    </button> <!-- onclick="alerta();" -->
                      <button type="reset" class="btn btn-danger">Cancelar</button> 
                      </div>
                    </center>
                    <br>
                    <div hidden="">
                    <?php
                    $folio = $_GET["id"]; 
                    if($_GET["msj"]=='No_insert') { echo "<script> Swal.fire('No se realizo el registro',':(','error');</script>"; } 
                    if ($folio >=1) { echo "<script>Swal.fire('El folio del registro es: <br>'+'<b>'+$folio+'</b>', '', 'success'); </script>"; }
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
  <script src="vendor/select2/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function () 
      {
        $('.select2-single').select2();
        // Select2 Single  with Placeholder
        $('.select2-single-placeholder').select2({
          placeholder: "Select a Province",
          allowClear: true
          });      
        // Select2 Multiple
        $('.select2-multiple').select2();
    });
    </script>

</body>

</html>