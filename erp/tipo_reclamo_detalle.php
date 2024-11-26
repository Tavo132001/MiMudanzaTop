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
  $sTitulo = "Registrar un nuevo tipo de reclamo";
  $sSubTitulo = "Por favor, ingresar la información del tipo reclamo [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idtiporeclamo = "";
  $nombre = "";
  $descripcion = "";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del tipo de reclamo";
  $sSubTitulo = "Por favor, actualizar la información del tipo reclamo [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idtiporeclamo"])) $idtiporeclamo = $_GET["idtiporeclamo"];
  //Buscando los ultimos datos registrados
  $sql="Select * From tipo_reclamo Where idtiporeclamo = $idtiporeclamo";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	
    $nombre = $row["nombre"]; 
    $descripcion = $row["descripcion"]; 
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];

  //SQL
  $sql = "INSERT INTO tipo_reclamo ";
  $sql.= "(`nombre`, `descripcion`) "; 
  $sql.=" VALUES ('$nombre', '$descripcion') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "tipo_reclamo.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
    if(isset($_POST["idtiporeclamo"])) $idtiporeclamo = $_POST["idtiporeclamo"];
    if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
    if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
 
  //SQL
  $sql = "UPDATE tipo_reclamo SET nombre = '$nombre',";
  $sql.= "descripcion = '$descripcion' ";
  $sql.= "WHERE idtiporeclamo = $idtiporeclamo ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "tipo_reclamo.php";
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
          <h1>Gestión de tipo de reclamos</h1>
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="tipo_reclamo_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idtiporeclamo value="<?php echo $idtiporeclamo?>">
        
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="descripcion">Descripción:</label>
                  <textarea class="form-control" rows="2" name="descripcion" id="descripcion" placeholder="Ingresar descripción ..."><?php echo $descripcion;?></textarea>
                </div>
              </div>
            </div>
          
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="tipo_reclamo.php" class="btn btn-primary">Regresar</a>
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