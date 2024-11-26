<?php
include("plantilla_cabecera.php");

// PASO 1 - RECIBIR LOS PARÁMETROS
$sAccion = "";
if(isset($_GET["sAccion"]))
  $sAccion = $_GET["sAccion"];
else if(isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if(isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0)
{
    // Salvar el archivo en su ruta
    $Url = "descargas/transporte";
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
    $sTitulo = "Registrar un nuevo transporte";
    $sSubTitulo = "Por favor, ingresar la información del transporte [(*) datos obligatorios]:";
    $sCambioAccion = "insert";
    // VALORES POR DEFECTO
    $idtransporte = "";
    $marca = "";
    $modelo = "";
    $estado = "Activo";
    $placa = "";
    $capacidad_toneladas = 0;
    $fecha_compra = date("Y-m-d"); // Setear el día de hoy
    $consumo_combustible = 0.0;
}
elseif ($sAccion == "edit")
{
    // PASO 4 - CARGAR EL FORMULARIO PARA ACTUALIZAR INFORMACIÓN
    $sTitulo = "Modificar los datos del transporte";
    $sSubTitulo = "Por favor, actualizar la información del transporte [(*) datos obligatorios]:";
    $sCambioAccion = "update";
    if (isset($_GET["idtransporte"])) $idtransporte = $_GET["idtransporte"];
    // Buscar los últimos datos registrados
    $sql = "SELECT * FROM transporte WHERE idtransporte = $idtransporte";
    $result = dbQuery($sql);
    if ($row = mysqli_fetch_array($result)) {
        $marca = $row["marca"];
        $modelo = $row["modelo"];
        $estado = $row["estado"];
        $placa = $row["placa"];
        $capacidad_toneladas = $row["capacidad_toneladas"];
        $fecha_compra = $row["fecha_compra"];
        $consumo_combustible = $row["consumo_combustible"];
    }
}
elseif ($sAccion == "insert")
{
    // PASO 3 - Insertar el registro
    if (isset($_POST["marca"])) $marca = $_POST["marca"];
    if (isset($_POST["modelo"])) $modelo = $_POST["modelo"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    if (isset($_POST["placa"])) $placa = $_POST["placa"];
    if (isset($_POST["capacidad_toneladas"])) $capacidad_toneladas = $_POST["capacidad_toneladas"];
    if (isset($_POST["fecha_compra"])) $fecha_compra = $_POST["fecha_compra"];
    if (isset($_POST["consumo_combustible"])) $consumo_combustible = $_POST["consumo_combustible"];
    // Validaciones
    if ($estado == "") $estado = 'Inactivo';
    // SQL
    $sql = "INSERT INTO transporte ";
    $sql .= "(`marca`, `modelo`, `estado`, `placa`, `capacidad_toneladas`, `fecha_compra`, `consumo_combustible`) ";
    $sql .= "VALUES ('$marca', '$modelo', '$estado', '$placa', '$capacidad_toneladas', '$fecha_compra', '$consumo_combustible')";
    dbQuery($sql);
    // Fin de inserción
    $pagina = "transporte.php";
    $mensaje = "1";
    redireccionar($pagina, $mensaje);
    // Redireccionando... se termina la ejecución en esta página
}
elseif ($sAccion == "update")
{
    // PASO 5 - Editar el registro
    if (isset($_POST["idtransporte"])) $idtransporte = $_POST["idtransporte"];
    if (isset($_POST["marca"])) $marca = $_POST["marca"];
    if (isset($_POST["modelo"])) $modelo = $_POST["modelo"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    if (isset($_POST["placa"])) $placa = $_POST["placa"];
    if (isset($_POST["capacidad_toneladas"])) $capacidad_toneladas = $_POST["capacidad_toneladas"];
    if (isset($_POST["fecha_compra"])) $fecha_compra = $_POST["fecha_compra"];
    if (isset($_POST["consumo_combustible"])) $consumo_combustible = $_POST["consumo_combustible"];
    // Validaciones
    if ($estado == "") $estado = 'Inactivo';
    // SQL
    $sql = "UPDATE transporte SET marca = '$marca', ";
    $sql .= "modelo = '$modelo', ";
    $sql .= "estado = '$estado', ";
    $sql .= "placa = '$placa', ";
    $sql .= "capacidad_toneladas = '$capacidad_toneladas', ";
    $sql .= "fecha_compra = '$fecha_compra', ";
    $sql .= "consumo_combustible = '$consumo_combustible' ";
    $sql .= "WHERE idtransporte = $idtransporte";
    dbQuery($sql);
    // Fin de actualización
    $pagina = "transporte.php";
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
                <form name="frmDatos" action="transporte_detalle.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sAccion" value="<?php echo $sCambioAccion; ?>">
                <input type="hidden" name=idtransporte value="<?php echo $idtransporte?>">
                <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="marca">Marca:</label>
                                <input type="text" name="marca" id="marca" class="form-control" value="<?php echo $marca; ?>" required />
                            </div>
                            <div class="col-6">
                                <label for="modelo">Modelo:</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $modelo; ?>" required />
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
                                <label for="placa">Placa:</label>
                                <input type="text" name="placa" id="placa" class="form-control" value="<?php echo $placa; ?>" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="capacidad_toneladas">Capacidad (Toneladas):</label>
                                <input type="number" name="capacidad_toneladas" id="capacidad_toneladas" class="form-control" value="<?php echo $capacidad_toneladas; ?>" required />
                            </div>
                            <div class="col-6">
                  <label for="fecha_compra">Fecha de Compra (*):</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="fecha_compra" id="fecha_nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_compra?>">
                  </div>
                  <!-- /.input group -->
                </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="consumo_combustible">Consumo de Combustible:</label>
                        <input type="text" name="consumo_combustible" id="consumo_combustible" class="form-control" value="<?php echo $consumo_combustible; ?>" required />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <a href="transporte.php" class="btn btn-primary">Regresar</a>
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
