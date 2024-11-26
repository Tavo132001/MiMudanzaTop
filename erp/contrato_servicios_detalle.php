<?php
include("plantilla_cabecera.php");

$sAccion = "";

if (isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if (isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if (isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0) {
  $Url = "descargas/usuario";
  $subir_archivo = $_FILES['subir_archivo']['name'];
  $subir_archivo = strtolower($subir_archivo);
  $subir_archivo = quitar_acentos($subir_archivo);
  $subir_archivo = str_replace(" ", ".", $subir_archivo);
  if (file_exists($Url . "/" . $subir_archivo)) unlink($Url . "/" . $subir_archivo);
  move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url . "/" . $subir_archivo);
}

if ($sAccion == "new") {
  $sTitulo = "Registrar un nuevo usuario";
  $sSubTitulo = "Por favor, ingresar la información del usuario [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  $idusuario = "";
  $nombre = "";
  $apellido = "";
  $perfil = "ADMIN";
  $nombre_imagen = "";
  $fecha_nacimiento = date("Y-m-d");
  $correo = "";
  $clave = "";
  $estado = "A";

  // Contrato de Servicios Fields
  $id_contrato = "";
  $id_cliente = "";
  $fecha_inicio_contrato = date("Y-m-d");
  $fecha_finalizacion_contrato = date("Y-m-d");
  $tipo_servicio = "";
  $detalles_servicio = "";
  $costo_servicio = "";
  $terminos_condiciones = "";
  $estado = "";
  $fecha_sistema = date("Y-m-d H:i:s");
} elseif ($sAccion == "edit") {
  $sTitulo = "Modificar los datos del usuario";
  $sSubTitulo = "Por favor, actualizar la información del usuario [(*) datos obligatorio]:";
  $sCambioAccion = "update";

  if (isset($_GET["idusuario"])) $idusuario = $_GET["idusuario"];

  // Buscando los últimos datos registrados
  $sql = "Select * From usuario Where idusuario = $idusuario";
  $result = dbQuery($sql);

  if ($row = mysqli_fetch_array($result)) {
    $nombre = $row["nombre"];
    $apellido = $row["apellido"];
    $perfil = $row["perfil"];
    $nombre_imagen = $row["nombre_imagen"];
    $fecha_nacimiento = $row["fecha_nacimiento"];
    $correo = $row["correo"];
    $clave = $row["clave"];
    $estado = $row["estado"];
    $fecha_hora_sistema = $row["fecha_hora_sistema"];
  }

  // Contrato de Servicios Fields
  $id_contrato = "";
  $id_cliente = "";
  $fecha_inicio_contrato = date("Y-m-d");
  $fecha_finalizacion_contrato = date("Y-m-d");
  $tipo_servicio = "";
  $detalles_servicio = "";
  $costo_servicio = "";
  $terminos_condiciones = "";
  $estado = "";
  $fecha_sistema = date("Y-m-d H:i:s");
} elseif ($sAccion == "insert") {
  // Insertando el registro
  if (isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if (isset($_POST["apellido"])) $apellido = $_POST["apellido"];
  if (isset($_POST["perfil"])) $perfil = $_POST["perfil"];
  if (isset($_POST["nombre_imagen"])) $nombre_imagen = $_POST["nombre_imagen"];
  if (isset($_POST["fecha_nacimiento"])) $fecha_nacimiento = $_POST["fecha_nacimiento"];
  if (isset($_POST["correo"])) $correo = $_POST["correo"];
  if (isset($_POST["clave"])) $clave = $_POST["clave"];
  if (isset($_POST["estado"])) $estado = $_POST["estado"];

  // Contrato de Servicios Fields
  if (isset($_POST["id_contrato"])) $id_contrato = $_POST["id_contrato"];
  if (isset($_POST["id_cliente"])) $id_cliente = $_POST["id_cliente"];
  if (isset($_POST["fecha_inicio_contrato"])) $fecha_inicio_contrato = $_POST["fecha_inicio_contrato"];
  if (isset($_POST["fecha_finalizacion_contrato"])) $fecha_finalizacion_contrato = $_POST["fecha_finalizacion_contrato"];
  if (isset($_POST["tipo_servicio"])) $tipo_servicio = $_POST["tipo_servicio"];
  if (isset($_POST["detalles_servicio"])) $detalles_servicio = $_POST["detalles_servicio"];
  if (isset($_POST["costo_servicio"])) $costo_servicio = $_POST["costo_servicio"];
  if (isset($_POST["terminos_condiciones"])) $terminos_condiciones = $_POST["terminos_condiciones"];
  if (isset($_POST["estado"])) $estado = $_POST["estado"];

  // Validaciones
  if ($estado == "") $estado = 'I';
  if ($subir_archivo != "") $nombre_imagen = $subir_archivo;

  // SQL
  $sql = "INSERT INTO usuario ";
  $sql .= "(`nombre`, `apellido`, `perfil`, `nombre_imagen`, `fecha_nacimiento`, `correo`, `clave`, `estado`) ";
  $sql .= " VALUES ('$nombre', '$apellido', '$perfil', '$nombre_imagen', '$fecha_nacimiento', '$correo', '$clave', '$estado')";
  dbQuery($sql);

  // Insertar Contrato de Servicios
  $sql_contrato = "INSERT INTO contrato_servicios ";
  $sql_contrato .= "(`id_cliente`, `fecha_inicio_contrato`, `fecha_finalizacion_contrato`, `tipo_servicio`, `detalles_servicio`, `costo_servicio`, `terminos_condiciones`, `estado`, `fecha_sistema`) ";
  $sql_contrato .= "VALUES ('$id_cliente', '$fecha_inicio_contrato', '$fecha_finalizacion_contrato', '$tipo_servicio', '$detalles_servicio', '$costo_servicio', '$terminos_condiciones', '$estado', '$fecha_sistema')";
  dbQuery($sql_contrato);

  $pagina = "usuario.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje);
} elseif ($sAccion == "update") {
  if (isset($_POST["idusuario"])) $idusuario = $_POST["idusuario"];
  if (isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if (isset($_POST["apellido"])) $apellido = $_POST["apellido"];
  if (isset($_POST["perfil"])) $perfil = $_POST["perfil"];
  if (isset($_POST["nombre_imagen"])) $nombre_imagen = $_POST["nombre_imagen"];
  if (isset($_POST["fecha_nacimiento"])) $fecha_nacimiento = $_POST["fecha_nacimiento"];
  if (isset($_POST["correo"])) $correo = $_POST["correo"];
  if (isset($_POST["clave"])) $clave = $_POST["clave"];
  if (isset($_POST["estado"])) $estado = $_POST["estado"];

  // Contrato de Servicios Fields
  if (isset($_POST["id_contrato"])) $id_contrato = $_POST["id_contrato"];
  if (isset($_POST["id_cliente"])) $id_cliente = $_POST["id_cliente"];
  if (isset($_POST["fecha_inicio_contrato"])) $fecha_inicio_contrato = $_POST["fecha_inicio_contrato"];
  if (isset($_POST["fecha_finalizacion_contrato"])) $fecha_finalizacion_contrato = $_POST["fecha_finalizacion_contrato"];
  if (isset($_POST["tipo_servicio"])) $tipo_servicio = $_POST["tipo_servicio"];
  if (isset($_POST["detalles_servicio"])) $detalles_servicio = $_POST["detalles_servicio"];
  if (isset($_POST["costo_servicio"])) $costo_servicio = $_POST["costo_servicio"];
  if (isset($_POST["terminos_condiciones"])) $terminos_condiciones = $_POST["terminos_condiciones"];
  if (isset($_POST["estado"])) $estado = $_POST["estado"];

  // Validaciones
  if ($estado == "") $estado = 'I';
  if ($subir_archivo != "") $nombre_imagen = $subir_archivo;

  // SQL
  $sql = "UPDATE usuario SET nombre = '$nombre', ";
  $sql .= "apellido = '$apellido', ";
  $sql .= "perfil = '$perfil', ";
  $sql .= "nombre_imagen = '$nombre_imagen', ";
  $sql .= "fecha_nacimiento = '$fecha_nacimiento', ";
  $sql .= "correo = '$correo', ";
  $sql .= "clave = '$clave', ";
  $sql .= "estado = '$estado' ";
  $sql .= "WHERE idusuario = $idusuario";
  dbQuery($sql);

  // Actualizar Contrato de Servicios
  $sql_contrato = "UPDATE contrato_servicios SET ";
  $sql_contrato .= "id_cliente = '$id_cliente', ";
  $sql_contrato .= "fecha_inicio_contrato = '$fecha_inicio_contrato', ";
  $sql_contrato .= "fecha_finalizacion_contrato = '$fecha_finalizacion_contrato', ";
  $sql_contrato .= "tipo_servicio = '$tipo_servicio', ";
  $sql_contrato .= "detalles_servicio = '$detalles_servicio', ";
  $sql_contrato .= "costo_servicio = '$costo_servicio', ";
  $sql_contrato .= "terminos_condiciones = '$terminos_condiciones', ";
  $sql_contrato .= "estado = '$estado', ";
  $sql_contrato .= "fecha_sistema = '$fecha_sistema' ";
  $sql_contrato .= "WHERE id_contrato = $id_contrato";
  dbQuery($sql_contrato);

  $pagina = "usuario.php";
  $mensaje = "2";
  redireccionar($pagina, $mensaje);
}
?>

<?php
include("plantilla_menu.php");
?>
<script type="text/javascript">
  
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#FEFEEE;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $sTitulo ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo $sSubTitulo; ?></h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form name="frmDatos" action="usuario_detalle.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name=sAccion value="<?php echo $sCambioAccion ?>"> <!-- hidden -->
          <input type="hidden" name=idusuario value="<?php echo $idusuario ?>">
          <input type="hidden" name=nombre_imagen value="<?php echo $nombre_imagen ?>">

          <!-- Usuario Fields -->
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="apellido">Apellido (*):</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $apellido; ?>" autofocus required />
              </div>
              <div class="col-6">
                <label for="nombre">Nombre (*):</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="avatar">Avatar:</label>
                <input type="text" name="avatar" id="avatar" class="form-control" value="<?php echo $nombre_imagen; ?>" disabled/>
              </div>
              <div class="col-6">
                <label for="subir_archivo">Subir avatar:</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="subir_archivo" name="subir_archivo">
                  <label class="custom-file-label" for="subir_archivo">Escoger imagen</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="fecha_nacimiento">Fecha nacimiento (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_nacimiento ?>">
                </div>
              </div>
              <div class="col-6">
                <label for="perfil">Perfil:</label>
                <select class="form-control" name="perfil">
                  <option value="ADMIN" <?php if ($perfil == "ADMIN") echo "selected"; ?>>Administrador</option>
                  <option value="CONTA" <?php if ($perfil == "CONTA") echo "selected"; ?>>Contador</option>
                  <option value="TESOR" <?php if ($perfil == "TESOR") echo "selected"; ?>>Tesoreria</option>
                  <option value="OPERA" <?php if ($perfil == "OPERA") echo "selected"; ?>>Operario</option>
                  <option value="GPROY" <?php if ($perfil == "GPROY") echo "selected"; ?>>Gestión de proyectos</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="correo">Correo / Login (*):</label>
                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" required />
              </div>
              <div class="col-3">
                <label for="clave">Clave (*):</label>
                <input type="text" name="clave" id="clave" class="form-control" value="<?php echo $clave; ?>" required />
              </div>
              <div class="col-3"><br>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="estado" value="A" <?php if ($estado == "A") echo "checked"; ?>>
                  <label class="form-check-label">Activo</label>
                </div>
              </div>
            </div>
          </div>

          <!-- Contrato de Servicios Fields -->
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="id_cliente">ID Cliente (*):</label>
                <input type="text" name="id_cliente" id="id_cliente" class="form-control" value="<?php echo $id_cliente; ?>" required />
              </div>
              <div class="col-6">
                <label for="fecha_inicio_contrato">Fecha Inicio Contrato (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_inicio_contrato" id="fecha_inicio_contrato" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_inicio_contrato ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="fecha_finalizacion_contrato">Fecha Finalización Contrato (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_finalizacion_contrato ?>">
                </div>
              </div>
              <div class="col-6">
                <label for="tipo_servicio">Tipo de Servicio:</label>
                <input type="text" name="tipo_servicio" id="tipo_servicio" class="form-control" value="<?php echo $tipo_servicio; ?>" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="detalles_servicio">Detalles del Servicio:</label>
                <input type="text" name="detalles_servicio" id="detalles_servicio" class="form-control" value="<?php echo $detalles_servicio; ?>" />
              </div>
              <div class="col-6">
                <label for="costo_servicio">Costo del Servicio:</label>
                <input type="text" name="costo_servicio" id="costo_servicio" class="form-control" value="<?php echo $costo_servicio; ?>" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-12">
                <label for="terminos_condiciones">Términos y Condiciones:</label>
                <textarea name="terminos_condiciones" id="terminos_condiciones" class="form-control"><?php echo $terminos_condiciones; ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <a href="usuario.php" class="btn btn-primary">Regresar</a>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include("plantilla_pie.php");
?>

<!-- bs-custom-file-input COMPONENTE PARA ADJUNTAR ARCHIVOS/IMÁGENES -->
<script src="libreria/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    bsCustomFileInput.init();
    // Datemask dd/mm/yyyy
    $('#fecha_documento').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
  });
</script>