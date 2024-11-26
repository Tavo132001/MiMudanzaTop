<?php
include("plantilla_cabecera.php");

// PASO 1 - RECIBIMOS LOS PARÁMETROS
$sAccion = "";
if (isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if (isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if (isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0) {	
  // Salvamos el archivo en su ruta
  $Url = "descargas/personal";
  $subir_archivo = $_FILES['subir_archivo']['name'];
  $subir_archivo = strtolower($subir_archivo);
  $subir_archivo = quitar_acentos($subir_archivo);
  $subir_archivo = str_replace(" ", ".", $subir_archivo);
  // Si existe el archivo se elimina
  if (file_exists($Url . "/" . $subir_archivo)) unlink($Url . "/" . $subir_archivo);
  move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url . "/" . $subir_archivo);
}

if ($sAccion == "new") { 
  // PASO 2 - CARGAMOS EL FORMULARIO NUEVO
  $sTitulo = "Registrar un nuevo personal";
  $sSubTitulo = "Por favor, ingresar la información del personal [(*) datos obligatorios]:";
  $sCambioAccion = "insert";
  // VALORES POR DEFECTO
  $id_personal = "";
  $nombre = "";
  $apellido = "";
  $fecha_nacimiento = date("Y-m-d");
  $correo = "";
  $dni = "";
  $celular = "";
  $area = "";
  $puesto = "";
  $fecha_inicio = date("Y-m-d");
  $salario = "";
  $fotografia = "";
}
elseif ($sAccion == "edit") { 
  // PASO 4 - CARGAMOS EL FORMULARIO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del personal";
  $sSubTitulo = "Por favor, actualizar la información del personal [(*) datos obligatorios]:";
  $sCambioAccion = "update";
  if (isset($_GET["id_personal"])) $id_personal = $_GET["id_personal"];
  // Buscando los últimos datos registrados
  $sql = "Select * From personal Where id_personal = $id_personal";
  $result = dbQuery($sql);
  if ($row = mysqli_fetch_array($result)) {
    $nombre = $row["nombre"];
    $apellido = $row["apellido"];
    $fecha_nacimiento = $row["fecha_nacimiento"];
    $correo = $row["correo"];
    $dni = $row["dni"];
    $celular = $row["celular"];
    $area = $row["area"];
    $puesto = $row["puesto"];
    $fecha_inicio = $row["fecha_inicio"];
    $salario = $row["salario"];
    $fotografia = $row["fotografia"];
    $fecha_sistema = $row["fecha_sistema"];
  }
}
elseif ($sAccion == "insert") {
  // PASO 3 - Insertando el registro
  if (isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if (isset($_POST["apellido"])) $apellido = $_POST["apellido"];
  if (isset($_POST["fecha_nacimiento"])) $fecha_nacimiento = $_POST["fecha_nacimiento"];
  if (isset($_POST["correo"])) $correo = $_POST["correo"];
  if (isset($_POST["dni"])) $dni = $_POST["dni"];
  if (isset($_POST["celular"])) $celular = $_POST["celular"];
  if (isset($_POST["area"])) $area = $_POST["area"];
  if (isset($_POST["puesto"])) $puesto = $_POST["puesto"];
  if (isset($_POST["fecha_inicio"])) $fecha_inicio = $_POST["fecha_inicio"];
  if (isset($_POST["salario"])) $salario = $_POST["salario"];
 
  // Validaciones
    if ($subir_archivo != "") $fotografia = $subir_archivo;
  // SQL
  $sql = "INSERT INTO personal ";
  $sql .= "(`nombre`, `apellido`, `fecha_nacimiento`, `correo`, `dni`, `celular`, `area`, `puesto`, `fecha_inicio`, `salario`, `fotografia`) ";
  $sql .= "VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$correo', '$dni', '$celular', '$area', '$puesto', '$fecha_inicio', '$salario', '$fotografia')";
  dbQuery($sql);
  // Fin de inserción
  $pagina = "personal.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje);
}
elseif ($sAccion == "update") { 
  // PASO 5 - Editando el registro
  if (isset($_POST["id_personal"])) $id_personal = $_POST["id_personal"];
  if (isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if (isset($_POST["apellido"])) $apellido = $_POST["apellido"];
  if (isset($_POST["fecha_nacimiento"])) $fecha_nacimiento = $_POST["fecha_nacimiento"];
  if (isset($_POST["correo"])) $correo = $_POST["correo"];
  if (isset($_POST["dni"])) $dni = $_POST["dni"];
  if (isset($_POST["celular"])) $celular = $_POST["celular"];
  if (isset($_POST["area"])) $area = $_POST["area"];
  if (isset($_POST["puesto"])) $puesto = $_POST["puesto"];
  if (isset($_POST["fecha_inicio"])) $fecha_inicio = $_POST["fecha_inicio"];
  if (isset($_POST["salario"])) $salario = $_POST["salario"];
   // Validaciones
 
  if ($subir_archivo != "") $fotografia = $subir_archivo;
  // SQL
  $sql = "UPDATE personal SET nombre = '$nombre', ";
  $sql .= "apellido = '$apellido', ";
  $sql .= "fecha_nacimiento = '$fecha_nacimiento', ";
  $sql .= "correo = '$correo', ";
  $sql .= "dni = '$dni', ";
  $sql .= "celular = '$celular', ";
  $sql .= "area = '$area', ";
  $sql .= "puesto = '$puesto', ";
  $sql .= "fecha_inicio = '$fecha_inicio', ";
  $sql .= "salario = '$salario', ";
  $sql .= "fotografia = '$fotografia' ";
  $sql .= "WHERE id_personal = $id_personal ";
  dbQuery($sql);
  // Fin de actualización
  $pagina = "personal.php";
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
        <form name="frmDatos" action="personal_detalles.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name=sAccion value="<?php echo $sCambioAccion ?>"> <!-- hidden -->
          <input type="hidden" name=id_personal value="<?php echo $id_personal ?>">
          <input type="hidden" name=fotografia value="<?php echo $fotografia ?>">
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
                <input type="text" name="avatar" id="avatar" class="form-control" value="<?php echo $fotografia; ?>" disabled />
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
                <!-- /.input group -->
              </div>
              <div class="col-6">
                <label for="correo">Correo (*):</label>
                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="dni">DNI (*):</label>
                <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $dni; ?>" required />
              </div>
              <div class="col-6">
                <label for="celular">Celular (*):</label>
                <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $celular; ?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="area">Área (*):</label>
                <input type="text" name="area" id="area" class="form-control" value="<?php echo $area; ?>" required />
              </div>
              <div class="col-6">
                <label for="puesto">Puesto (*):</label>
                <input type="text" name="puesto" id="puesto" class="form-control" value="<?php echo $puesto; ?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="fecha_inicio">Fecha de inicio (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_inicio ?>">
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-6">
                <label for="salario">Salario (*):</label>
                <input type="text" name="salario" id="salario" class="form-control" value="<?php echo $salario; ?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <a href="personal.php" class="btn btn-primary">Regresar</a>
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
  // Datemask yyyy-mm-dd
  $('#fecha_documento').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
});
</script>