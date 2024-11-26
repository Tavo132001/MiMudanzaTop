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

if ($sAccion=="new")
{ //PASO 2 - CARGAMOS EL FORMULARIO NUEVO
  $sTitulo = "Registrar un nuevo servicio";
  $sSubTitulo = "Por favor, ingresar la información del servicio [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idservicio = "";
  $nombre = "";
  $descripcion = "";
  $idcategoria = "0";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del servicio";
  $sSubTitulo = "Por favor, actualizar la información del servicio [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idservicio"])) $idservicio = $_GET["idservicio"];
  //Buscando los ultimos datos registrados
  $sql="Select * From servicio Where idservicio = $idservicio";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$nombre = $row["nombre"]; 
    $idcategoria = $row["idcategoria"]; 
    $descripcion = $row["descripcion"]; 
    $fecha_hora_sistema = $row["fecha_hora_sistema"]; 
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["idcategoria"])) $idcategoria = $_POST["idcategoria"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
  //Validaciones
  //SQL
  $sql = "INSERT INTO servicio ";
  //idservicio / fecha_hora_sistema
  $sql.= "(`nombre`, `idcategoria`, `descripcion`) "; 
  $sql.=" VALUES ('$nombre', '$idcategoria', '$descripcion') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "tipo_servicio.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
  if(isset($_POST["idservicio"])) $idservicio = $_POST["idservicio"];
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["idcategoria"])) $idcategoria = $_POST["idcategoria"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];

  //SQL
  $sql = "UPDATE servicio SET nombre = '$nombre', ";
  $sql.= "idcategoria = '$idcategoria', ";
  $sql.= "descripcion = '$descripcion' ";
  $sql.= "WHERE idservicio = $idservicio ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "tipo_servicio.php";
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
          <form name="frmDatos" action="servicio_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>">
            <!-- hidden -->
            <input type="hidden" name=idservicio value="<?php echo $idservicio?>">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="idcategoria">Tipo:</label>
                  <select class="form-control" name="idcategoria">
                    <?php 
                    $sql = "Select * From categoria_servicio Order by nombre";
                    $result = dbQuery($sql);
                    while($row = mysqli_fetch_array($result))
                    {	$selected = "";
                      if($row["idcategoria"]==$idcategoria) $selected = "selected";?>
                      <option value="<?php echo $row["idcategoria"]?>" <?php echo $selected?>><?php echo $row["nombre"]?></option><?php 
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
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="tipo_servicio.php" class="btn btn-primary">Regresar</a>
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