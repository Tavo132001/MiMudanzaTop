<?php
include ("plantilla_cabecera.php");
//PASO 1 - RECIBIMOS LOS PARAMETROS
$sAccion = "";
if(isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if(isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if(isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0)
{	//Salvamos el archivo en su ruta
  $Url = "descargas/producto";
  $subir_archivo = $_FILES['subir_archivo']['name'];
  //exit($subir_archivo);
  $subir_archivo = strtolower($subir_archivo);
  $subir_archivo = quitar_acentos($subir_archivo);
  $subir_archivo = str_replace(" ", ".", $subir_archivo);
  //Si existe el archivo se elimina
  if (file_exists($Url."/".$subir_archivo)) unlink($Url."/".$subir_archivo);
  move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url."/".$subir_archivo);
}

if ($sAccion=="new")
{ //PASO 2 - CARGAMOS EL FORMULARIO NUEVO
  $sTitulo = "Registrar una nueva venta";
  $sSubTitulo = "Por favor, ingresar la información de la venta [(*) datos obligatorios]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idventa = "";
  $idusuario = "";
  $idcliente = "";
  $fecha_documento = "";
  $tipo_documento = "";
  $numero_documento = "";
  $razon_social = "";
  $forma_pago = "";
  $numero_operacion = "";
  $subtotal = "";
  $igv = "";
  $total = "";
  $estado = "";
  $fecha_hora_sistema = "";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos de la venta";
  $sSubTitulo = "Por favor, actualizar la información de la venta [(*) datos obligatorios]:";
  $sCambioAccion = "update";
  if(isset($_GET["idventa"])) $idventa = $_GET["idventa"];
  //Buscando los ultimos datos registrados
  $sql="Select * From venta Where idventa = $idventa";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$idventa = $row["idventa"]; 
    $idusuario = $row["idusuario"]; 
    $idcliente = $row["idcliente"]; 
    $fecha_documento = $row["fecha_documento"];  
    $tipo_documento = $row["tipo_documento"]; 
    $numero_documento = $row["numero_documento"];
    $razon_social = $row["razon_social"];
    $forma_pago = $row["forma_pago"];
    $total = $row["total"];
    $estado = $row["estado"];
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["idventa"])) $idventa = $_POST["idventa"];
  if(isset($_POST["idusuario"])) $idusuario = $_POST["idusuario"];
  if(isset($_POST["idcliente"])) $idcliente = $_POST["idcliente"];
  if(isset($_POST["fecha_documento"])) $fecha_documento = $_POST["fecha_documento"];
  if(isset($_POST["tipo_documento"])) $tipo_documento = $_POST["tipo_documento"];
  if(isset($_POST["numero_documento"])) $numero_documento = $_POST["numero_documento"];
  if(isset($_POST["razon_social"])) $razon_social = $_POST["razon_social"];
  if(isset($_POST["forma_pago"])) $forma_pago = $_POST["forma_pago"];
  if(isset($_POST["total"])) $total = $_POST["total"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 

  //SQL
  $sql = "INSERT INTO venta ";
  //idventa / fecha_venta
  $sql.= "(`idventa`, `idusuario`, `idcliente`, `fecha_documento`, `tipo_documento`, `numero_documento`, `razon_social`, `forma_pago`, `total`, `estado` ) "; 
  $sql.=" VALUES ('$idventa', '$idusuario', '$idcliente', '$fecha_documento', '$tipo_documento', '$numero_documento', '$razon_social', '$forma_pago', '$total', '$estado'  ) ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "venta.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
    if(isset($_POST["idventa"])) $idventa = $_POST["idventa"];
    if(isset($_POST["idusuario"])) $idusuario = $_POST["idusuario"];
    if(isset($_POST["idcliente"])) $idcliente = $_POST["idcliente"];
    if(isset($_POST["fecha_documento"])) $fecha_documento = $_POST["fecha_documento"];
    if(isset($_POST["tipo_documento"])) $tipo_documento = $_POST["tipo_documento"];
    if(isset($_POST["numero_documento"])) $numero_documento = $_POST["numero_documento"];
    if(isset($_POST["razon_social"])) $razon_social = $_POST["razon_social"];
    if(isset($_POST["forma_pago"])) $forma_pago = $_POST["forma_pago"];
    if(isset($_POST["total"])) $total = $_POST["total"];
    if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I';  
  
  //SQL
  $sql = "UPDATE venta SET idventa = '$idventa', ";
  $sql.= "idusuario = '$idusuario', ";
  $sql.= "idcliente = '$idcliente', ";
  $sql.= "fecha_documento = '$fecha_documento', ";
  $sql.= "tipo_documento = '$tipo_documento', ";
  $sql.= "numero_documento = '$numero_documento', ";
  $sql.= "razon_social = '$razon_social', ";
  $sql.= "forma_pago = '$forma_pago', ";
  $sql.= "total = '$total', ";
  $sql.= "estado = '$estado' ";
  $sql.= "WHERE idventa = $idventa ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "venta.php";
  $mensaje = "2";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
?>

<?php
include ("plantilla_menu.php");
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
          <h1>Gestión de ventas</h1>
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="venta_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idventa value="<?php echo $idventa?>">
        
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="idventa">ID Venta (*):</label>
                  <input type="text" name="idventa" id="idventa" class="form-control" value="<?php echo $idventa;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="idusuario">ID Usuario :</label>
                  <input type="text" name="idusuario" id="idusuario" class="form-control" value="<?php echo $idusuario;?>" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="idcliente">ID Cliente (*):</label>
                  <input type="text" name="idcliente" id="idcliente" class="form-control" value="<?php echo $idcliente;?>" required />
                </div>
                <div class="col-6">
                  <label for="fecha_documento">Fecha de documento (*):</label>
                  <input type="text" name="fecha_documento" id="fecha_documento" class="form-control" value="<?php echo $fecha_documento;?>" required/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                    <label for="tipo_documento">Tipo de documento:</label>
                    <select class="form-control" name="tipo_documento"> 
                        <option value="BOLETA" <?php if($tipo_documento == "BOLETA") echo "selected"; ?>>BOLETA</option>
                        <option value="FACTURA" <?php if($tipo_documento == "FACTURA") echo "selected"; ?>>FACTURA</option>
                    </select>
                </div>
                <div class="col-6">
                  <label for="numero_documento">Numero de documento (*):</label>
                  <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="<?php echo $numero_documento;?>" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="razon_social">Razón social (*):</label>
                  <input type="text" name="razon_social" id="razon_social" class="form-control" value="<?php echo $razon_social;?>" required/>
                </div>
                <div class="col-6">
                    <label for="forma_pago">Forma de pago:</label>
                    <select class="form-control" name="forma_pago"> 
                        <option value="EFECTIVO" <?php if($tipo_documento == "EFECTIVO") echo "selected"; ?>>EFECTIVO</option>
                        <option value="TARJETA DEBITO" <?php if($tipo_documento == "TARJETA DEBITO") echo "selected"; ?>>TARJETA DEBITO</option>
                        <option value="TARJETA CREDITO" <?php if($tipo_documento == "TARJETA CREDITO") echo "selected"; ?>>TARJETA CREDITO</option>
                        <option value="TRANSFERENCIA" <?php if($tipo_documento == "TRANSFERENCIA") echo "selected"; ?>>TRANSFERENCIA</option>
                        <option value="YAPE" <?php if($tipo_documento == "YAPE") echo "selected"; ?>>YAPE</option>
                    </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="total">Total (*):</label>
                  <input type="text" name="total" id="total" class="form-control" value="<?php echo $total;?>" required />
                </div>
                <div class="col-6">
                    <label for="estado">Estado:</label>
                    <select class="form-control" name="estado"> 
                        <option value="I" <?php if($estado == "I") echo "selected"; ?>>Inactivo</option>
                        <option value="A" <?php if($estado == "A") echo "selected"; ?>>Activo</option>
                    </select>
                </div>
              </div>
            </div>


                     
            <!--<div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="imagen">Imagen:</label>
                  <input type="text" name="imagen" id="imagen" class="form-control" value="<?php echo $nombre_imagen;?>" disabled/>
                </div>
                <div class="col-6">
                  <label for="subir_archivo">Subir imagen:</label>
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
                  <label for="stock">Stock:</label>
                  <input type="number" name="stock" id="stock" class="form-control" value="<?php echo $stock;?>" min="0" max="1000" required />
                </div>
                <div class="col-6"><br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="estado" value="A" <?php if($estado == "A") echo "checked"; ?>>
                    <label class="form-check-label">Activo</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="precio_compra">Precio compra:</label>
                  <input type="number" name="precio_compra" id="precio_compra" class="form-control" value="<?php echo $precio_compra;?>" min="0" step="0.01" required />
                </div>
                <div class="col-6">
                  <label for="precio_venta">Precio venta:</label>
                  <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="<?php echo $precio_venta;?>" min="0" step="0.01" required />
                </div>
              </div>
            </div> -->
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="venta.php" class="btn btn-primary">Regresar</a>
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
include ("plantilla_pie.php");
?>

<!-- bs-custom-file-input COMPONENTE PARA ADJUNTAR ARCHIVOS/IMAGENES -->
<script src="libreria/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>