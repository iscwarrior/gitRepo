<?php include('login.php'); // Includes Login Script ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo2.png" rel="icon">
  <title>Atención línea covid- Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-7">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center">
                      <div class="sidebar-brand-icon">
                      <img src="img/logo/ssm2.png" width="200" height="120">
                      <h1 class="h4 text-gray-900 mb-4">Inicio de sesión</h1>
                      </div>
                    </a>
                  </div>
                  <form class="user" action="#" method="post" autocomplete="off">
                    <div><span style="color:red;">
                        <?php if($error!=''){ echo "<script> Swal.fire('$error',':(','error');</script>"; }?> </span>
                    </div>
                    <div class="form-group">
                      <label><i class="fas fa-user"></i> &nbsp; Usuario</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introducir usuario" required>
                    </div>
                    <div class="form-group">
                      <label><i class="fa fa-key"></i> &nbsp; Contraseña</label>
                      <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                    <!--<div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck"> Recordar contraseña</label>
                      </div> -->
                    </div>
                    <div class="form-group">
                      <center>
                        <button class="btn btn-primary" type="submit" name="submit">Ingresar al sistema &nbsp; <i class="fas fa-arrow-right"></i></button>
                      </center>
                    </div>
                    <hr>                  
                  </form>
                  <hr>
                  <div class="text-center">
                    Sistema de registro de insidencias, reportes de casos sospechosos y positivos de COVID-19 en escuelas del estado de Morelos.<br>
                    (Consulta indicadores <b><a href='index.php' value='<?php session_destroy();?>'>aqui</a></b> indicadores sin iniciar sesión).
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>
<?php 

//session_destroy();
?>