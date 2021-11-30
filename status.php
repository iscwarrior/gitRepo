<?php 
session_start(); 
if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1)
  { echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">';
  exit(); 
//session_start(); 

// if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1)
//   { echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">'; 
//  exit();
// } 

} ?>



<?php
      // Conexion MariaDB //////////////////////////////////////////////////////////////////
      $servername = "localhost"; // Nombre/IP del servidor
      $database = "bdr3p0r"; // Nombre de la BBDD
      $username = "root"; // Nombre del usuario
      $password = "root"; // Contraseña del usuario

      // Creamos la conexión
      $con = mysqli_connect($servername, $username, $password, $database);
      // Comprobamos la conexión
       if (!$con) { die("La conexión ha fallado: " . mysqli_connect_error()); }
      
      ////////////////////////////////////////////////////////////////////////////////////// 
      // Cod. Paginación ///////////////////////////////////////////////////////////////////
      //////////////////////////////////////////////////////////////////////////////////////
      
      $solsql=mysqli_query($con, "select * from primarios order by folio desc");

      $numElementos = 15;
   
      // Recogemos el parametro pag, en caso de que no exista, lo seteamos a 1
      if (isset($_GET['pag'])) {
          $pagina = $_GET['pag'];
      } else {
          $pagina = 1;
      }
   
      $sql = "SELECT * FROM primarios ORDER BY FOLIO DESC LIMIT " . (($pagina - 1) * $numElementos)  . "," . $numElementos;
      
      // Ejecutamos la consulta
      $resultado = mysqli_query($con, $sql);
   
        if(!$resultado) {
          var_dump(mysqli_error($con));
          exit;
          }

      // Contamos el número total de registros
      $sql = "SELECT count(*) as num_personas FROM primarios";
   
      // Ejecutamos la consulta
      $resultadoMaximo = mysqli_query($con, $sql);
   
      // Recojo el numero de registros de forma rápida
      $maximoElementos = mysqli_fetch_assoc($resultadoMaximo)['num_personas'];

?>

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

  <!-- JQuery para alerta unblur -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert-->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  

<!-- <style type="text/css">
  .tomatxt{background:#f3f0f0}
  .tomatxt:focus{background:#fff}
</style> -->

<script type="text/javascript">
$(document).ready(function() {

  $('input,select').on('blur', function() {

        // var folio = $('#fol').val();
        var field = $(this);
        var separacion = field.attr('name').split('-'); 
        var nombre = separacion[0];
        var folio2     = separacion[1];
        var validationField = field.parent().find('.validation');
        //var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&folio='+folio2;
        var dataString = 'value='+field.val()+'&field='+nombre+'&folio='+folio2;
    $.ajax({
            type: "POST",
            url: "update.php",
            data: dataString,
            success: function(data) {
            field.val(data);
                validationField.hide().empty();

                setTimeout(function() {
                    validationField.append('<i class="fa fa-check"></i>');
                validationField.show();
                }, 500);
            }
        });
  });
});
</script>

<script type="text/javascript">
  //comenario para el select de status
  $(document).ready(function(){

       $('select').on('blur', function() {   
       
          var field2 = $(this);
          var separacion2 = field2.attr('name').split('-'); 
          var nombre2 = separacion2[0];
          var folio3     = separacion2[1];
       Swal.fire('Cambiaste el estatus del caso: <br>'+'<b>'+folio3+'</b>', '', 'success'); }); // fin status
       });// fin_onblur

  //comenario para comentarios 
  $(document).ready(function(){

       $('input').on('blur', function() {   
       
          var field3 = $(this);
          var separacion3 = field3.attr('name').split('-'); 
          var nombre3 = separacion3[0];
          var folio4     = separacion3[1];
       Swal.fire('Actualizaste comentario del caso: '+'<b>'+folio4+'</b>', '', 'success'); }); // fin status
       });// fin_onblur
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
<?if (isset($_SESSION["login_user_sys"]) && $_SESSION["MM_UserGroup"]==1){ ?>          
        <?php echo 
        '<a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>'
        ?>
<? } ?>
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
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['login_user_sys'];?></span>
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
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                 <h5 class="m-0 font-weight-bold text-primary align-items-center">
                    Listado de reportes de atención de la línea COVID-19 para escuelas en Morelos</h5> 
                </div>
                <div class="card-body">
                    <div class="content table-responsive table-full-width">
                       <table id="table" class="table table-hover table-striped" style="width:150%">
                            <thead>
                                <th style="color:#456789; font-size:90%;"><center>Folio</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Fecha</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Escuela</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Municipio</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Localidad</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Teléfono</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Casos sospechosos</center></th>
                                <th style="color:#456789; font-size:90%;"><center>Casos positvos</center></th>
                                <th style="color:#456789; font-size:90%; width:10%;"><center>Status</center></th>
                                <th style="color:#456789; font-size:90%; width:50%;"><center>Comentarios</center></th>
                              </thead>
                              <?php 
                              while ($rowsol = mysqli_fetch_assoc($resultado)){
                              $sos ="SELECT (SUM(n_alum+n_doc+n_trab_e+n_papas)) as Sospechoso from datos_motivo where folio=".$rowsol['folio']." ";
                              $conf = "SELECT (SUM(b_nalumnos+b_ndocentes+b_ntescuela+b_nfamiliar)) as Confirmados from positivos where folio=".$rowsol['folio']." ";

                               $exe_sos = mysqli_query($con,$sos);
                               $exe_conf = mysqli_query($con,$conf);

                               $rowSos = mysqli_fetch_assoc($exe_sos);
                               $rowConf = mysqli_fetch_assoc($exe_conf);
                              ?> 
                            <tbody>
                              <tr class="odd pointer">
                                <td style="font-size:85%;"><b><center><?php echo $rowsol['folio'];?></center></b></td>
                                <td style="font-size:85%;"><center><?php echo $rowsol['fecha_reg'];?></center></td>
                                <td style="font-size:85%;"><center><?php echo $rowsol['name_esc'];?></center></td>
                                <td style="font-size:85%;"><center><?php echo $rowsol['municipio'];?></center></td>
                                <td style="font-size:85%;"><center><?php echo $rowsol['localidad'];?></center></td>
                                <td style="font-size:85%;"><center><?php echo $rowsol['telefono'];?></center></td>
                                <td style="font-size:85%;"><center><font color="purple">
                                <?php //echo $rowSos['Sospechoso'];
                                if($rowSos['Sospechoso']==0 ){ $s = 0; echo $s; }else { echo $rowSos['Sospechoso'];} 
                                ?></font></center></td>
                                <td style="font-size:85%;"><center><font color="red">
                                <?php if($rowConf['Confirmados']==0 ){ $c = 0; echo $c; }else { echo $rowConf['Confirmados'];} 
                                ?></font></center></td>
                                <td style="width:80px; font-size:30%;">
                                  <!-- <div class="input-group-prepend"><center><span class="input-group-text validation"></span></center></div> -->
                                  <center><span class="input-group-text validation"></span></center>
                                   <select id="status_caso" name="status_caso<?php echo '-'.$rowsol['folio'];?>" class="form-control" style="WIDTH: 100%; HEIGHT: 30%">
                                      <option value="<?$rowsol['status_caso'];?>"> 
                                                     <?php if($rowsol['status_caso']==0){echo 'Seguimiento';} else {echo 'Finalizado';}?></option>
                                      <option value=0>Seguimiento</option>
                                      <option value=1>Finalizado</option>
                                   </select>
                                   <input type='hidden' class="form-control" name="fol2<?php echo '-'.$rowsol['folio'];?>" 
                                                                      id='fol2' value="<?php echo $rowsol['folio'];?>">
                                 </td>
                                <td style="font-size:80%">
                                  <!-- <div class="input-group-prepend"><span class="input-group-text validation"></span></div> -->
                                  <span class="input-group-text validation"></span>
                                  <input type='text' name="comentarios_caso<?php echo '-'.$rowsol['folio'];?>" id="comentarios_seg" 
                                          value="<?php echo $rowsol['comentarios_caso'];?>"  style="WIDTH: 100%; HEIGHT: 80%"> 
                                    <input type='hidden' class="form-control" name="fol<?php echo '-'.$rowsol['folio'];?>" id='fol' value="<?php echo $rowsol['folio'];?>">
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                                <tfoot>
                                    <tr>
                                       <td colspan="6">
                                        <center>
                                        <?php // Si existe el parametro pag
                                            if (isset($_GET['pag'])) {
                                            if ($_GET['pag'] > 1) { // Si pag es mayor que 1, ponemos un enlace al anterior
                                        ?>
                                        <a href="status.php?pag=<?php echo $_GET['pag'] - 1; ?>"><button class="btn btn-primary">Anterior</button></a>
                                        <?php // Sino deshabilito el botón
                                              } else {
                                        ?>
                                        <a href="#"><button class="btn btn-primary">Anterior</button></a>
                                        <?php
                                            } // Fin_else
                                        ?>
                                        <?php
                                          } else { // Sino deshabilito el botón
                                        ?>
                                        <a href="#"><button class="btn btn-primary">Anterior</button></a>
                                        <?php
                                          } // Si existe la paginacion 
                                          if (isset($_GET['pag'])) { // Si el numero de registros actual es superior al maximo
                                          if ((($pagina) * $numElementos) < $maximoElementos) 
                                          {
                                        ?>
                                        <a href="status.php?pag=<?php echo $_GET['pag'] + 1; ?>"><button class="btn btn-primary">Siguiente</button></a>
                                        <?php // Sino deshabilito el botón
                                          } else {
                                        ?>
                                       <a href="#"><button class="btn btn-primary">Siguiente</button ></a>
                                        <?php } ?>
                                        <?php // Sino deshabilito el botón
                                          } else {
                                        ?>
                                        <a href="status.php?pag=2"><button class="btn btn-primary">Siguiente</button></a>
                                        <?php } ?>
                                      </center>
                                    </td>
                                    </tr>
                                </tfoot> 
                        </table> <!-- fin_table-->
                    </div> <!--Fin content table-responsive table-full-width-->
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

</body>
</html>