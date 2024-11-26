<?php
include("plantilla_cabecera.php");

$sAccion = "";
if (isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if (isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if ($sAccion == "new") {
  $sTitulo = "Registrar una nueva planilla";
  $sSubTitulo = "Por favor, ingresar la información de la planilla [(*) datos obligatorios]:";
  $sCambioAccion = "insert";
  $id_planilla = "";
  $id_personal = "";
  $fecha_planilla = date("Y-m-d"); // Establecer la fecha de hoy
  $horas_trabajadas = "";
  $salario_base = "";
  $bonificaciones = "";
  $deducciones = "";
  $monto_total = "";
  $fecha_sistema = date("Y-m-d H:i:s"); // Establecer la fecha y hora del sistema
}
elseif ($sAccion == "edit") {
  $sTitulo = "Modificar los datos de la planilla";
  $sSubTitulo = "Por favor, actualizar la información de la planilla [(*) datos obligatorios]:";
  $sCambioAccion = "update";

  if (isset($_GET["id_planilla"])) {
    $id_planilla = $_GET["id_planilla"];
    // Obtener los datos de la planilla a editar
    $sql = "SELECT * FROM planillas WHERE id_planilla = $id_planilla";
    $result = dbQuery($sql);

    if ($row = mysqli_fetch_array($result)) {
      $id_personal = $row["id_personal"];
      $fecha_planilla = $row["fecha_planilla"];
      $horas_trabajadas = $row["horas_trabajadas"];
      $salario_base = $row["salario_base"];
      $bonificaciones = $row["bonificaciones"];
      $deducciones = $row["deducciones"];
      $monto_total = $row["monto_total"];
      $fecha_sistema = $row["fecha_sistema"];
    }
  }
}

elseif ($sAccion == "insert") {
  // Insertar un nuevo registro de planilla
  if (isset($_POST["id_personal"])) $id_personal = $_POST["id_personal"];
  if (isset($_POST["fecha_planilla"])) $fecha_planilla = $_POST["fecha_planilla"];
  if (isset($_POST["horas_trabajadas"])) $horas_trabajadas = $_POST["horas_trabajadas"];
  if (isset($_POST["salario_base"])) $salario_base = $_POST["salario_base"];
  if (isset($_POST["bonificaciones"])) $bonificaciones = $_POST["bonificaciones"];
  if (isset($_POST["deducciones"])) $deducciones = $_POST["deducciones"];
  if (isset($_POST["monto_total"])) $monto_total = $_POST["monto_total"];
  if (isset($_POST["fecha_sistema"])) $fecha_sistema = $_POST["fecha_sistema"];

  // Realizar las validaciones necesarias

  $sql = "INSERT INTO planillas (id_personal, fecha_planilla, horas_trabajadas, salario_base, bonificaciones, deducciones, monto_total, fecha_sistema) VALUES ('$id_personal', '$fecha_planilla', '$horas_trabajadas', '$salario_base', '$bonificaciones', '$deducciones', '$monto_total', '$fecha_sistema')";
  dbQuery($sql);

  $pagina = "planillas.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje);
}
elseif ($sAccion == "update") {
  // Actualizar un registro de planilla existente
  if (isset($_POST["id_planilla"])) $id_planilla = $_POST["id_planilla"];
  if (isset($_POST["id_personal"])) $id_personal = $_POST["id_personal"];
  if (isset($_POST["fecha_planilla"])) $fecha_planilla = $_POST["fecha_planilla"];
  if (isset($_POST["horas_trabajadas"])) $horas_trabajadas = $_POST["horas_trabajadas"];
  if (isset($_POST["salario_base"])) $salario_base = $_POST["salario_base"];
  if (isset($_POST["bonificaciones"])) $bonificaciones = $_POST["bonificaciones"];
  if (isset($_POST["deducciones"])) $deducciones = $_POST["deducciones"];
  if (isset($_POST["monto_total"])) $monto_total = $_POST["monto_total"];
  if (isset($_POST["fecha_sistema"])) $fecha_sistema = $_POST["fecha_sistema"];

  // Realizar las validaciones necesarias

  $sql = "UPDATE planillas SET id_personal = '$id_personal', fecha_planilla = '$fecha_planilla', horas_trabajadas = '$horas_trabajadas', salario_base = '$salario_base', bonificaciones = '$bonificaciones', deducciones = '$deducciones', monto_total = '$monto_total', fecha_sistema = '$fecha_sistema' WHERE id_planilla = $id_planilla";
  dbQuery($sql);

  $pagina = "planillas.php";
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
            <h1><?php echo $sTitulo?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="planillas_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sAccion" value="<?php echo $sCambioAccion?>">
            <input type="hidden" name="id_planilla" value="<?php echo $id_planilla?>">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="id_personal">ID Personal (*):</label>
                  <input type="text" name="id_personal" id="id_personal" class="form-control" value="<?php echo $id_personal;?>" required />
                </div>
                <div class="col-6">
                  <label for="fecha_planilla">Fecha de la Planilla (*):</label>
                  <input type="date" name="fecha_planilla" id="fecha_planilla" class="form-control" value="<?php echo $fecha_planilla;?>" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-4">
                  <label for="horas_trabajadas">Horas Trabajadas:</label>
                  <input type="text" name="horas_trabajadas" id="horas_trabajadas" class="form-control" value="<?php echo $horas_trabajadas;?>" />
                </div>
                <div class="col-4">
                  <label for="salario_base">Salario Base:</label>
                  <input type="text" name="salario_base" id="salario_base" class="form-control" value="<?php echo $salario_base;?>" />
                </div>
                <div class="col-4">
                  <label for="bonificaciones">Bonificaciones:</label>
                  <input type="text" name="bonificaciones" id="bonificaciones" class="form-control" value="<?php echo $bonificaciones;?>" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-4">
                  <label for="deducciones">Deducciones:</label>
                  <input type="text" name="deducciones" id="deducciones" class="form-control" value="<?php echo $deducciones;?>" />
                </div>
                <div class="col-4">
                  <label for="monto_total">Monto Total:</label>
                  <input type="text" name="monto_total" id="monto_total" class="form-control" value="<?php echo $monto_total;?>" />
                </div>
                <div class="col-4">
                  <label for="fecha_sistema">Fecha del Sistema (*):</label>
                  <input type="text" name="fecha_sistema" id="fecha_sistema" class="form-control" value="<?php echo $fecha_sistema;?>" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="planillas.php" class="btn btn-primary">Regresar</a>
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

<!-- bs-custom-file-input COMPONENTE PARA ADJUNTAR ARCHIVOS/IMAGENES -->
<script src="libreria/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
  // Datemask yyyy-mm-dd
  $('#fecha_planilla').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
  // Add other specific scripts if needed
});
</script>