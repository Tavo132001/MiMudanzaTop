<?php
include ("plantilla_cabecera.php");
//PASO 1 - RECIBIMOS LOS PARAMETROS
$sAccion = "";
if(isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if(isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

/*
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
} */

if ($sAccion=="new")
{ //PASO 2 - CARGAMOS EL FORMULARIO NUEVO
  $sTitulo = "Registrar un nuevo cliente";
  $sSubTitulo = "Por favor, ingresar la información del cliente [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idcliente = "";
  $tipo_persona = "";
  $nombre = "";
  $tipo_documento = "";
  $numero_documento = "";
  $direccion = "";
  $telefono = "";
  $correo = "";
  $estado = "";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del cliente";
  $sSubTitulo = "Por favor, actualizar la información del cliente [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idcliente"])) $idcliente = $_GET["idcliente"];
  //Buscando los ultimos datos registrados
  $sql="Select * From cliente Where idcliente = $idcliente";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$tipo_persona = $row["tipo_persona"]; 
    $nombre = $row["nombre"]; 
    $tipo_documento = $row["tipo_documento"]; 
    $numero_documento = $row["numero_documento"]; 
    $direccion = $row["direccion"]; 
    $telefono = $row["telefono"]; 
    $correo = $row["correo"]; 
    $estado = $row["estado"]; 
    $fecha_hora_sistema = $row["fecha_hora_sistema"]; 
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["tipo_persona"])) $tipo_persona = $_POST["tipo_persona"];
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["tipo_documento"])) $tipo_documento = $_POST["tipo_documento"];
  if(isset($_POST["numero_documento"])) $numero_documento = $_POST["numero_documento"];
  if(isset($_POST["direccion"])) $direccion = $_POST["direccion"];
  if(isset($_POST["telefono"])) $telefono = $_POST["telefono"];
  if(isset($_POST["correo"])) $correo = $_POST["correo"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 
  
  //SQL
  $sql = "INSERT INTO cliente ";
  //idcliente / fecha_cliente
  $sql.= "(`tipo_persona`, `nombre`, `tipo_documento`, `numero_documento`, `direccion`, `telefono`, `correo`, `estado` ) "; 
  $sql.=" VALUES ('$tipo_persona', '$nombre', '$tipo_documento', '$numero_documento', '$direccion', '$telefono', '$correo', '$estado') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "cliente.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
  if(isset($_POST["idcliente"])) $idcliente = $_POST["idcliente"];
    if(isset($_POST["tipo_persona"])) $tipo_persona = $_POST["tipo_persona"];
    if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
    if(isset($_POST["tipo_documento"])) $tipo_documento = $_POST["tipo_documento"];
    if(isset($_POST["numero_documento"])) $numero_documento = $_POST["numero_documento"];
    if(isset($_POST["direccion"])) $direccion = $_POST["direccion"];
    if(isset($_POST["telefono"])) $telefono = $_POST["telefono"];
    if(isset($_POST["correo"])) $correo = $_POST["correo"];
    if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 

  //SQL
  $sql = "UPDATE cliente SET tipo_persona = '$tipo_persona', ";
  $sql.= "nombre = '$nombre', ";
  $sql.= "tipo_documento = '$tipo_documento', ";
  $sql.= "numero_documento = '$numero_documento', ";
  $sql.= "direccion = '$direccion', ";
  $sql.= "telefono = '$telefono', ";
  $sql.= "correo = '$correo', ";
  $sql.= "estado = '$estado' ";
  $sql.= "WHERE idcliente = $idcliente ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "cliente.php";
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
          <h1>Gestión de clientes</h1>
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="cliente_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idcliente value="<?php echo $idcliente?>">
        
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                
                <div class="col-6">
                  <label for="tipo_persona">Tipo persona:</label>
                  <select class="form-control" name="tipo_persona"> 
                    <option value="N" <?php if($tipo_persona == "N") echo "selected"; ?>>Natural</option>
                    <option value="J" <?php if($tipo_persona == "J") echo "selected"; ?>>Jurídica</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="tipo_documento">Tipo de documento (DNI o RUC) (*):</label>
                  <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" value="<?php echo $tipo_documento;?>" required />
                </div>
                <div class="col-6">
                  <label for="numero_documento">Numero de documento (*):</label>
                  <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="<?php echo $numero_documento;?>" required/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="direccion">Dirección (*):</label>
                  <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion;?>" required />
                </div>
                <div class="col-6">
                  <label for="telefono">Teléfono (*):</label>
                  <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono;?>" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="correo">Correo (*):</label>
                  <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo;?>" required />
                </div>
                <div class="col-3"><br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="estado" value="A" <?php if($estado == "A") echo "checked"; ?>>
                    <label class="form-check-label">Activo</label>
                </div>
              </div>
            </div>
            <!--<div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="imagen">Imagen:</label>
                  <input type="text" name="imagen" id="imagen" class="form-control" value="" disabled/>
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
                  <input type="number" name="stock" id="stock" class="form-control" value="" min="0" max="1000" required />
                </div>
                <div class="col-6"><br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="estado" value="A" 
                    <label class="form-check-label">Activo</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="precio_compra">Precio compra:</label>
                  <input type="number" name="precio_compra" id="precio_compra" class="form-control" value="" min="0" step="0.01" required />
                </div>
                <div class="col-6">
                  <label for="precio_venta">Precio venta:</label>
                  <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="" min="0" step="0.01" required />
                </div>
              </div>
            </div> -->
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="cliente.php" class="btn btn-primary">Regresar</a>
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