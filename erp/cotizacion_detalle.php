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
  $sTitulo = "Registrar una nueva cotizacion";
  $sSubTitulo = "Por favor, ingresar la información de la cotizacion [(*) datos obligatorios]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idcotizacion = "";
  $servicio = "";
  $idcliente = "";
  $nombre = "";
  $origen = "";
  $destino = "";
  $fecha_cotizacion = "";
  $estado_cotizacion = "";
  $descripcion = "";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos de la cotización";
  $sSubTitulo = "Por favor, actualizar la información de la cotización [(*) datos obligatorios]:";
  $sCambioAccion = "update";
  if(isset($_GET["idcotizacion"])) $idcotizacion = $_GET["idcotizacion"];
  //Buscando los ultimos datos registrados
  $sql="Select * From cotizacion Where idcotizacion = $idcotizacion";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$nombre = $row["nombre"]; 
    $origen = $row["origen"]; 
    $destino = $row["destino"]; 
    $fecha_cotizacion = $row["fecha_cotizacion"];  
    $descripcion = $row["descripcion"]; 
    $estado_cotizacion = $row["estado_cotizacion"];
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["origen"])) $origen = $_POST["origen"];
  if(isset($_POST["destino"])) $destino = $_POST["destino"];
  if(isset($_POST["estado_cotizacion"])) $estado_cotizacion = $_POST["estado_cotizacion"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
  //Validaciones
  if($estado_cotizacion == "") $estado_cotizacion = 'P'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "INSERT INTO cotizacion ";
  //idcotizacion / fecha_cotizacion
  $sql.= "(`nombre`, `origen`, `destino`, `estado_cotizacion`, `descripcion` ) "; 
  $sql.=" VALUES ('$nombre', '$origen', '$destino', '$estado_cotizacion', '$descripcion' ) ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "cotizacion.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
    if(isset($_POST["idcotizacion"])) $idcotizacion = $_POST["idcotizacion"];
    if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
    if(isset($_POST["origen"])) $origen = $_POST["origen"];
    if(isset($_POST["destino"])) $destino = $_POST["destino"];
    if(isset($_POST["estado_cotizacion"])) $estado_cotizacion = $_POST["estado_cotizacion"];
    if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
  //Validaciones
  if($estado_cotizacion == "") $estado_cotizacion = 'I'; 
  
  //SQL
  $sql = "UPDATE cotizacion SET nombre = '$nombre', ";
  $sql.= "origen = '$origen', ";
  $sql.= "destino = '$destino', ";
  $sql.= "estado_cotizacion = '$estado_cotizacion', ";
  $sql.= "descripcion = '$descripcion' ";
  $sql.= "WHERE idcotizacion = $idcotizacion ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "cotizacion.php";
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
          <h1>Gestión de cotizaciones</h1>
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="cotizacion_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idcotizacion value="<?php echo $idcotizacion?>">
        
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="descripcion">Descripción (*):</label>
                  <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion;?>" required/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="origen">Origen (*):</label>
                  <input type="text" name="origen" id="origen" class="form-control" value="<?php echo $origen;?>" required />
                </div>
                <div class="col-6">
                  <label for="destino">Destino (*):</label>
                  <input type="text" name="destino" id="destino" class="form-control" value="<?php echo $destino;?>" required/>
                </div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-6">
                    <label for="estado_cotizacion">Estado:</label>
                    <select class="form-control" name="estado_cotizacion"> 
                        <option value="P" <?php if($estado_cotizacion == "P") echo "selected"; ?>>Pendiente</option>
                        <option value="A" <?php if($estado_cotizacion == "A") echo "selected"; ?>>Aceptada</option>
                        <option value="R" <?php if($estado_cotizacion == "R") echo "selected"; ?>>Rechazada</option>
                    </select>
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
                    <a href="cotizacion.php" class="btn btn-primary">Regresar</a>
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