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
  $sTitulo = "Registrar un nuevo reclamo";
  $sSubTitulo = "Por favor, ingresar la información del reclamo [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idreclamo = "";
  $idtiporeclamo = "0";
  $idcliente = "";
  $nombre = "";
  $descripcion = "";
  $estado = "P";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del reclamo";
  $sSubTitulo = "Por favor, actualizar la información del reclamo [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idreclamo"])) $idreclamo = $_GET["idreclamo"];
  //Buscando los ultimos datos registrados
  $sql="Select * From reclamo Where idreclamo = $idreclamo";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$idtiporeclamo = $row["idtiporeclamo"]; 
    $nombre = $row["nombre"]; 
    $fecha_reclamo = $row["fecha_reclamo"]; 
    $descripcion = $row["descripcion"]; 
    $estado = $row["estado"]; 
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["idtiporeclamo"])) $idtiporeclamo = $_POST["idtiporeclamo"];
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'P'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "INSERT INTO reclamo ";
  //idreclamo / fecha_reclamo
  $sql.= "(`idtiporeclamo`, `nombre`, `descripcion`, `estado`) "; 
  $sql.=" VALUES ('$idtiporeclamo', '$nombre', '$descripcion', '$estado') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "reclamo.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
    if(isset($_POST["idreclamo"])) $idreclamo = $_POST["idreclamo"];
    if(isset($_POST["idtiporeclamo"])) $idtiporeclamo = $_POST["idtiporeclamo"];
    if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
    if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
    if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'P'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "UPDATE reclamo SET idtiporeclamo = '$idtiporeclamo', ";
  $sql.= "nombre = '$nombre', ";
  $sql.= "descripcion = '$descripcion', ";
  $sql.= "estado = '$estado' ";
  $sql.= "WHERE idreclamo = $idreclamo ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "reclamo.php";
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
          <h1>Gestión de reclamos</h1>
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="reclamo_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idreclamo value="<?php echo $idreclamo?>">
        
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="idtiporeclamo">Categoria:</label>
                  <select class="form-control" name="idtiporeclamo">
                    <?php 
                    $sql = "Select * From tipo_reclamo Order by nombre";
                    $result = dbQuery($sql);
                    while($row = mysqli_fetch_array($result))
                    {	$selected = "";
                      if($row["idtiporeclamo"]==$idtiporeclamo) $selected = "selected";?>
                      <option value="<?php echo $row["idtiporeclamo"]?>" <?php echo $selected?>><?php echo $row["nombre"]?></option><?php 
                    }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="descripcion">Descripción:</label>
                  <textarea class="form-control" rows="2" name="descripcion" id="descripcion" placeholder="Ingresar descripción ..."><?php echo $descripcion;?></textarea>
                </div>
                <div class="col-6">
                  <label for="estado">Estado:</label>
                  <input type="text" name="estado" id="estado" class="form-control" value="<?php echo $estado;?>"/>
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
                    <a href="reclamo.php" class="btn btn-primary">Regresar</a>
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