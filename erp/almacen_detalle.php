<?php
include("plantilla_cabecera.php");

// PASO 1 - RECIBIR LOS PARÁMETROS
$sAccion = "";
if(isset($_GET["sAccion"]))
  $sAccion = $_GET["sAccion"];
else if(isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

// Inicializar variables
$idproductoa = "";
$idproducto = "";
$cantidad = 0;
$estado = "";

if(isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0)
{
    // Salvar el archivo en su ruta
    $Url = "descargas/almacen";
    $subir_archivo = $_FILES['subir_archivo']['name'];
    $subir_archivo = strtolower($subir_archivo);
    $subir_archivo = quitar_acentos($subir_archivo);
    $subir_archivo = str_replace(" ", ".", $subir_archivo);
    // Si existe el archivo, eliminarlo
    if (file_exists($Url . "/" . $subir_archivo)) {
        unlink($Url . "/" . $subir_archivo);
    }
    move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url . "/" . $subir_archivo);
}

if ($sAccion == "new")
{
    // PASO 2 - CARGAR EL FORMULARIO NUEVO
    $sTitulo = "Registrar un nuevo producto en almacén";
    $sSubTitulo = "Por favor, ingresar la información del producto en almacén [(*) datos obligatorios]:";
    $sCambioAccion = "insert";
}
elseif ($sAccion == "edit")
{
    // PASO 4 - CARGAR EL FORMULARIO PARA ACTUALIZAR INFORMACIÓN
    $sTitulo = "Modificar los datos del producto en almacén";
    $sSubTitulo = "Por favor, actualizar la información del producto en almacén [(*) datos obligatorios]:";
    $sCambioAccion = "update";
    if (isset($_GET["idproductoa"])) $idproductoa = $_GET["idproductoa"];
    // Buscar los últimos datos registrados
    $sql = "SELECT * FROM almacen WHERE idproductoa = $idproductoa";
    $result = dbQuery($sql);
    if ($row = mysqli_fetch_array($result)) {
        $idproducto = $row["idproducto"];
        $cantidad = $row["cantidad"];
        $estado = $row["estado"];
    }
}
elseif ($sAccion == "insert")
{
    // PASO 3 - Insertar el registro
    if (isset($_POST["idproducto"])) $idproducto = $_POST["idproducto"];
    if (isset($_POST["cantidad"])) $cantidad = $_POST["cantidad"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    
    // SQL
    $sql = "INSERT INTO almacen ";
    $sql .= "(`idproducto`, `cantidad`, `estado`) ";
    $sql .= "VALUES ('$idproducto', '$cantidad', '$estado')";
    dbQuery($sql);
    
    // Fin de inserción
    $pagina = "almacen.php";
    $mensaje = "1";
    redireccionar($pagina, $mensaje);
    // Redireccionando... se termina la ejecución en esta página
}
elseif ($sAccion == "update")
{
    // PASO 5 - Editar el registro
    if (isset($_POST["idproductoa"])) $idproductoa = $_POST["idproductoa"];
    if (isset($_POST["idproducto"])) $idproducto = $_POST["idproducto"];
    if (isset($_POST["cantidad"])) $cantidad = $_POST["cantidad"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    
    // SQL
    $sql = "UPDATE almacen SET idproducto = '$idproducto', ";
    $sql .= "cantidad = '$cantidad', ";
    $sql .= "estado = '$estado' ";
    $sql .= "WHERE idproductoa = $idproductoa";
    dbQuery($sql);
    
    // Fin de actualización
    $pagina = "almacen.php";
    $mensaje = "2";
    redireccionar($pagina, $mensaje);
    // Redireccionando... se termina la ejecución en esta página
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
                <form name="frmDatos" action="almacen_detalle.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sAccion" value="<?php echo $sCambioAccion; ?>">
                <input type="hidden" name=idproductoa value="<?php echo $idproductoa?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="idproducto">Producto:</label>
                                <input type="text" name="idproducto" id="idproducto" class="form-control" value="<?php echo $idproducto; ?>" required />
                            </div>
                            <div class="col-6">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?php echo $cantidad; ?>" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="estado">Estado:</label>
                                <input type="text" name="estado" id="estado" class="form-control" value="<?php echo $estado; ?>" required />
                            </div>
                            <div class="col-6">
                                <!-- Agregar más campos aquí si es necesario -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <a href="almacen.php" class="btn btn-primary">Regresar</a>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--/.card-body-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include("plantilla_pie.php");
?>