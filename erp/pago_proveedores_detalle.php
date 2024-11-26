<?php
include("plantilla_cabecera.php");

$sAccion = "";

if (isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if (isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if (isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0) {
  // Salvamos el archivo en su ruta
  $Url = "descargas/proveedores";
  $subir_archivo = $_FILES['subir_archivo']['name'];
  $subir_archivo = strtolower(quitar_acentos($subir_archivo));
  $subir_archivo = str_replace(" ", ".", $subir_archivo);
  // Si existe el archivo, se elimina
  if (file_exists($Url . "/" . $subir_archivo)) unlink($Url . "/" . $subir_archivo);
  move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url . "/" . $subir_archivo);
}

if ($sAccion == "new") {
  $sTitulo = "Registrar un nuevo pago a proveedores";
  $sSubTitulo = "Por favor, ingrese la información del pago a proveedores [(*) campos obligatorios]:";
  $sCambioAccion = "insert";

  $id_pago_proveedor = "";
  $proveedor = "";
  $fecha_transaccion = date("Y-m-d");
  $concepto = "";
  $monto = "";
  $estado_pago = "";
  $metodo_pago = "";
  $fecha_vencimiento = date("Y-m-d");
  $fecha_sistema = date("Y-m-d");
}
elseif ($sAccion == "edit") {
  $sTitulo = "Modificar datos del pago a proveedores";
  $sSubTitulo = "Por favor, actualice la información del pago a proveedores [(*) campos obligatorios]:";
  $sCambioAccion = "update";

  if (isset($_GET["id_pago_proveedor"])) $id_pago_proveedor = $_GET["id_pago_proveedor"];

  // Recupera los datos del pago a proveedores desde la base de datos y asígnalos a las variables
  // ...

}
elseif ($sAccion == "insert") {
  // Valida y procesa los datos para insertar el nuevo pago a proveedores en la base de datos
  // ...
}
elseif ($sAccion == "update") {
  // Valida y procesa los datos para actualizar el pago a proveedores en la base de datos
  // ...
}
?>

<?php
include("plantilla_menu.php");
?>
<script type="text/javascript">
  
</script>

<div class="content-wrapper" style="background-color:#FEFEEE;">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $sTitulo?></h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
      </div>

      <div class="card-body">
        <form name="frmDatos" action="proveedores_detalle.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>">
          <input type="hidden" name=id_pago_proveedor value="<?php echo $id_pago_proveedor?>">
          <input type="hidden" name=nombre_archivo value="<?php echo $nombre_archivo?>">
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="proveedor">Proveedor (*):</label>
                <input type="text" name="proveedor" id="proveedor" class="form-control" value="<?php echo $proveedor;?>"  autofocus required />
              </div>
              <div class="col-6">
                <label for="concepto">Concepto (*):</label>
                <input type="text" name="concepto" id="concepto" class="form-control" value="<?php echo $concepto;?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="fecha_transaccion">Fecha de transacción (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_transaccion" id="fecha_transaccion" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_transaccion?>">
                </div>
              </div>
              <div class="col-6">
                <label for="monto">Monto (*):</label>
                <input type="text" name="monto" id="monto" class="form-control" value="<?php echo $monto;?>" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="estado_pago">Estado de pago:</label>
                <select class="form-control" name="estado_pago">
                  <option value="Pendiente" <?php if($estado_pago == "Pendiente") echo "selected"; ?>>Pendiente</option>
                  <option value="Pagado" <?php if($estado_pago == "Pagado") echo "selected"; ?>>Pagado</option>
                  <option value="Rechazado" <?php if($estado_pago == "Rechazado") echo "selected"; ?>>Rechazado</option>
                </select>
              </div>
              <div class="col-6">
                <label for="metodo_pago">Método de pago:</label>
                <select class="form-control" name="metodo_pago">
                  <option value="Efectivo" <?php if($metodo_pago == "Efectivo") echo "selected"; ?>>Efectivo</option>
                  <option value="Transferencia bancaria" <?php if($metodo_pago == "Transferencia bancaria") echo "selected"; ?>>Transferencia bancaria</option>
                  <option value="Tarjeta de crédito" <?php if($metodo_pago == "Tarjeta de crédito") echo "selected"; ?>>Tarjeta de crédito</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="fecha_vencimiento">Fecha de vencimiento (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_vencimiento?>">
                </div>
              </div>
              <div class="col-6">
                <label for="fecha_sistema">Fecha del sistema (*):</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="fecha_sistema" id="fecha_sistema" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_sistema?>">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <a href="proveedores.php" class="btn btn-primary">Regresar</a>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<?php
include("plantilla_pie.php");
?>
<!-- bs-custom-file-input COMPONENTE PARA ADJUNTAR ARCHIVOS/IMÁGENES -->
<script src="libreria/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
  //Datemask yyyy-mm-dd
  $('#fecha_transaccion').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
  $('#fecha_vencimiento').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
  $('#fecha_sistema').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
});
</script>