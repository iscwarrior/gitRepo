<?php session_start(); if(!isset($_SESSION['login_user_sys']) || $_SESSION["MM_UserGroup"] !=1){ echo' <meta http-equiv="refresh" CONTENT="0;URL=sesion.php">'; exit(); } ?>
<? require ('file/conex.php'); ?>
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
        if(valor==10){
            document.getElementById("otros").disabled = false;
            }
            else {
                document.getElementById("otros").disabled = true;
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
        <div class="sidebar-brand-text mx-3">Atención a escuelas para COVID-19  </div>
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary"> <center>Seguimiento de incidencias (Regresar llamada)</center></h5>
                </div>
                <div class="card-body">
                  <form autocomplete="off" action="insertar_a.php" method="post" id="myForm2" accept-charset="utf-8">
                      <div class="row"> <!-- Inicio_row_1 -->
                           <div class="col-md-3">  
                                <div class="form-group">
                                    <label>Folio del reporte:</label> 
                                    <input type="number" name="folio" id="folio" min=0 class="form-control" placeholder="" value="" required="">
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label> Responsable de captura:</label>
                                    <input type="text" name="responsabler" id="responsabler" class="form-control" disabled="" value="<?php echo $_SESSION['login_user_sys'];?>" required="">
                                </div>  
                            </div>      <!-- Fin_Inicio_row_1 -->
                      </div>
                      <h6 class="m-0 font-weight-bold text-primary"><center>a) Caso sospechoso </center></h6><br>
                      <div class="row"> <!-- Inicio_row_2 -->
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label><b>13. </b>Los casos sospechosos son: </label>
                                    <select id="a_casos" name="a_casos" class="form-control" onchange="habilitar_otro(this.value);">
                                        <option value="0">Alumnos</option>
                                        <option value="1">Director</option>
                                        <option value="2">Docente</option>
                                        <option value="3">Secretaria</option>
                                        <option value="4">Prefecto</option>
                                        <option value="5">Intendente</option>
                                        <option value="6">Cooperativa</option>
                                        <option value="7">Responsable de laboratorio</option>
                                        <option value="8">Papas</option>
                                        <option value="9">Algún familiar del alumno</option>
                                        <option value="10"> Otro </option>
                                    </select>
                                </div>
                            </div>
                          <div class="col-md-6">  
                                <div class="form-group">
                                    <label><b> </b> Otro:</label>
                                    <input type="text" name="otros" id="otros" class="form-control" placeholder="Otro sospechoso" disabled="">
                                </div>
                            </div>    
                      </div>  <!-- Fin_Inicio_row_2 -->

                        <div class="row"> <!-- Inicio_row_3 -->
                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label><b>14.</b>¿Cuantos sospechosos son: </label>
                                </div>
                            </div>    
                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label><b> </b> Alumnos:</label>
                                    <input type="number" name="nalumnos" id="nalumnos" min=0 class="form-control" placeholder="#" value="<?php echo 0;?>">
                                </div>
                            </div>
                           <div class="col-md-2">  
                                <div class="form-group">
                                    <label><b> </b> Docentes: </label>
                                    <input type="number" name="ndocentes" id="ndocentes"min=0  class="form-control" placeholder="#" value="<?php echo 0;?>">
                                </div>
                            </div>
                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label><b> </b> (otro) Trabajador: </label>
                                    <input type="number" name="ntescuela" id="ntescuela" min=0  class="form-control" placeholder="#" value="<?php echo 0;?>">
                                </div>
                            </div>
                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label><b> </b> Padres / Titutor: </label>
                                    <input type="number" name="nfamiliar" id="nfamiliar" min=0  class="form-control" placeholder="#" value="<?php echo 0;?>">
                                </div>
                            </div>                     
                      </div>             <!-- Fin_row_3 -->
                  
                      <div class="row">       <!-- Inicio_row_4 -->   
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>15.</b> ¿Que sintomas presentan?</label>
                              </div>
                          </div>   
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Dificultad al respirar?</label>
                                  <select id="respiracion" name="respiracion" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Dolor torácico?<br><br></label>
                                  <select id="toracico" name="toracico" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b>¿Fiebre >= a 37.5°?<br><br></label>
                                  <select id="fiebre" name="fiebre" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>                                             
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Dolor de cabeza?<br><br></label>
                                  <select id="cabeza" name="cabeza" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Tos seca?<br><br></label>
                                  <select id="tos" name="tos" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                      </div>                  <!-- fin_row_4 -->

                     <div class="row">       <!-- Inicio_row_5 -->      
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Dolor de garganta?</label>
                                  <select id="garganta" name="garganta" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Ojos rojos e hinchados?</label>
                                  <select id="ojos_r" name="ojos_r" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>                                             
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Congestión nasal?<br><br></label>
                                  <select id="congestion" name="congestion" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Dolor de cuerpo?<br><br></label>
                                  <select id="cuerpo" name="cuerpo" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Dolor de articulaciones?</label>
                                  <select id="articulacion" name="articulacion" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Cansancio extremo/fatiga?</label>
                                  <select id="cansancio" name="cansancio" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div> 
                      </div>                  <!-- fin_row_5 -->
                      
                      <div class="row">       <!-- Inicio_row_6 -->                                                                          
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Escalofríos?<br><br></label>
                                  <select id="escalofrios" name="escalofrios" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Sudoración?<br><br></label>
                                  <select id="sudoracion" name="sudoracion" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label><b>* </b> ¿Malestar estomacal/diarrea?</label>
                                  <select id="diarrea" name="diarrea" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>* </b> ¿Vomito / Náusea?<br><br></label>
                                  <select id="vomito" name="vomito" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>                                             
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>* </b> ¿Disminución en la percepción de olores o sabores?</label>
                                  <select id="sabor_olor" name="sabor_olor" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          
                      </div>                  <!-- fin_row_6 -->
                      
                      <div class="row">       <!-- Inicio_row_7 --> 
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>* </b> ¿irritabilidad?</label>
                                  <select id="irritabilidad" name="irritabilidad" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>               
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>* </b> ¿Salpullido?</label>
                                  <select id="salpullido" name="salpullido" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><b>* </b> Comentarios de los sintomas</label>
                                  <input type="textarea" name="com_sintomas" id='com_sintomas' class="form-control" placeholder=" comentarios ...">
                              </div>
                          </div>
                      </div>                <!-- fin_row_7 --> 

                      <div class="row">       <!-- Inicio_row_8 --> 
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>16. </b> ¿Pertenece a la misma área?</label>
                                  <select id="marea" name="marea" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>               
                          <div class="col-md-9">
                              <div class="form-group">
                                  <label><b>16.1. </b> Comentarios: </label>
                                  <input type="text" name="comentarios_a" id="comentarios_a" class="form-control" placeholder=" Si es necesario escribir comentarios" value=" ">
                                 
                              </div>
                          </div>
                      </div>                <!-- fin_row_8 -->

                      <div class="row">     <!-- Inicio_row_9 --> 
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>17. </b> ¿Cuantos son de la misma área?</label>
                                  <input type="number" name="narea" id="narea" class="form-control" placeholder="###" value="<?php echo 0;?>">
                              </div>
                          </div>               
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label><b>18. </b> ¿Actualmente asisten a la escuela? </label>
                                  <select id="aescuela" name="aescuela" class="form-control">
                                      <option value="0" selected="">No</option>
                                      <option value="1">Si</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>19. </b> ¿Cuanto iniciaron los sintomas? (o estimación) </label>
                                    <input type="date" name="fechasin" class="form-control" required="">
                                </div>
                          </div>
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>20. </b> ¿Cual es su derechohabiencia? </label>
                                    <select id="derechohabiencia" name="derechohabiencia" class="form-control">
                                        <option value="0">IMSS</option>
                                        <option value="1">ISSSTE</option>
                                        <option value="2">INSABI</option>
                                        <option value="3">PEMEX</option>
                                        <option value="4">DEFENSA</option>
                                        <option value="5">MARINA</option>
                                        <option value="6">PARTICULAR</option>
                                        <option value="7" selected="">NINGUNO</option>
                                    </select>
                                </div>
                          </div>
                      </div>                <!-- fin_row_9 --> 

                      <div class="row">     <!-- Inicio_row_10 --> 
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><b>21. </b> Referir a: </label>
                                  <select id="a_referir" name="a_referir" class="form-control">
                                        <option value="0" selected=""> Ningún lugar </option>
                                        <option value="1">C.S. Tlaltenango - 08:30 a.m. a 10:00 a.m. - Lunes a viernes - Cuernavaca y Jiutepec</option>
                                        <option value="2">C.S. Villa de las Flores - 08:30 a.m. a 11:00 a.m. - Martes y Jueves - Temixco y Zapata</option>
                                        <option value="3">C.S. Tepoztlan - 08:30 a.m. a 11:00 a.m. - Martes y Viernes - Tepoztlán</option>
                                        <option value="4">C.S. Jojutla - 08:30 a.m. a 10:30 a.m. - Martes y Jueves - Jojutla y Zacatepec</option>
                                        <option value="5">C.S. Pena Flores - 10:00 a.m. a 14:00 a.m. - Lunes y Viernes - Todos lo municipios</option>
                                        <option value="6">Modulo de prueba COVID-19</option>
                                    </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><b>* </b> Indicaciones realizadas: </label>
                                  <select id="a_indicaciones" name="a_indicaciones" class="form-control">
                                        <option value="0" selected=""> Ninguna</option>
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
                      </div>                <!-- fin_row_10 -->         
                      <br>
          
                    <center>
                      <div>
                            <input name="bton" type="hidden" value="Registrar" >
                            <button type="submit" class="btn btn-primary" onclick="return alerta();">Guardar </button>
                            <button type="reset" class="btn btn-danger">Cancelar</button> 
                      </div>
                    </center>
                    <br>
                    <div hidden="">
                      <?php
                      $folio = $_GET["idseg"];
                      if($_GET["msj"]=='No_insert') { echo "<script> Swal.fire('No se realizo el registro',':(','error');</script>"; }
                      if ($folio >=1) { echo "<script>Swal.fire('Seguimiento registrado exitosamente :) ','','success'); </script>"; } 
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

</body>

</html>