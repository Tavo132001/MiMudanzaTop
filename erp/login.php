<?php
session_start();
include ("conexion/database.php");

if(isset($_POST["correo"]) && isset($_POST["clave"]) ){
  //exit($_POST["correo"]."/".$_POST["clave"]);
  $correo = $_POST["correo"];
  $clave = $_POST["clave"];
  $sql = "Select * From usuario Where correo='$correo' and clave = '$clave' and estado='A'";
  //echo("<br />".$sql);
  //exit(0);
  $result = dbQuery($sql);
  $num_rows = mysqli_num_rows($result);
  if ($num_rows > 0 ) 
  { $row = mysqli_fetch_array($result, MYSQLI_BOTH);   
    $idusuario = $row["idusuario"];
    $_SESSION["IDUSUARIO"] = $idusuario; 
    $_SESSION["USUARIO"] = $row["nombre"]." ".$row["apellido"];	
    $_SESSION["PERFIL"] = $row["perfil"]; 
    $_SESSION["AVATAR"] = $row["nombre_imagen"]; 
    echo "<script language='JavaScript'>";
    echo "window.location.href='dashboard.php';";
    echo "</script>";

  }
  else
  { 	echo '<script language="JavaScript">';
      echo 'alert("La información registrada no es valida");';
      echo '</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="descargas/favicon.png" type="image/gif" />
  <title>Mi Mudanza Top | ERP</title>

  <!-- Google Font: Josefin Sans -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital@1&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="libreria/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="libreria/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="libreria/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-color:#FEFEEE;">
<div class="login-box">
  <div class="login-logo">
  <a style="color:#3d9970;" href="index.html"><b><b>MiMudanzaTop</b></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Por favor, ingresar sus datos</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="correo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<!--
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>-->
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="libreria/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="libreria/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="libreria/dist/js/adminlte.min.js"></script>
</body>
</html>
