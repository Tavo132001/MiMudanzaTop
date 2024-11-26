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
  $Url = "descargas/servicio";
  $subir_archivo = $_FILES['subir_archivo']['name'];
  //exit($subir_archivo);
  $subir_archivo = strtolower($subir_archivo);
  $subir_archivo = quitar_acentos($subir_archivo);
  $subir_archivo = str_replace(" ", ".", $subir_archivo);
  //Si existe el archivo se elimina
  if (file_exists($Url."/".$subir_archivo)) unlink($Url."/".$subir_archivo);
  move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url."/".$subir_archivo);
}

elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos de los detalles del servicio";
  $sSubTitulo = "Por favor, actualizar la información de los detalles del servicio [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idregistro"])) $idregistro = $_GET["idregistro"];
  //Buscando los ultimos datos registrados
  $sql="Select * From mudanza Where idregistro = $idregistro";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$nombre = $row["nombre"]; 
    $etapas = $row["etapas"]; 
    $incidentes = $row["incidentes"];
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["etapas"])) $etapas = $_POST["etapas"];
  if(isset($_POST["incidentes"])) $incidentes = $_POST["incidentes"];
  //Validaciones
  //SQL
  $sql = "INSERT INTO servicio ";
  //idregistro / fecha_hora_sistema
  $sql.= "(`nombre`, `etapas`, `incidentes`) "; 
  $sql.=" VALUES ('$nombre', '$etapas', '$incidentes') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "mudanza.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
  if(isset($_POST["idregistro"])) $idregistro = $_POST["idregistro"];
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["etapas"])) $etapas = $_POST["etapas"];
  if(isset($_POST["incidentes"])) $incidentes = $_POST["incidentes"];

  //SQL
  $sql = "UPDATE servicio SET nombre = '$nombre', ";
  $sql.= "etapas = '$etapas', ";
  $sql.= "incidentes = '$incidentes', ";
  $sql.= "WHERE idregistro = $idregistro ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "usuario.php";
  $mensaje = "2";
  redireccionar($servicio, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
?>

<?php
include ("plantilla_menu.php");
?>
<script type="text/javascript">
  
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
          <form name="frmDatos" action="mudanza.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>">
            <!-- hidden -->
            <input type="hidden" name=idregistro value="<?php echo $idregistro?>">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="etapas">Etapas:</label>
                  <input type="text" name="etapas" id="etapas" class="form-control" value="<?php echo $etapas;?>"  autofocus required />
                </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="incidentes">Incidentes:</label>
                  <textarea class="form-control" rows="2" name="incidentes" id="incidentes" placeholder="Ingresar descripción ..."><?php echo $incidentes;?></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="mudanza.php" class="btn btn-primary">Regresar</a>
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