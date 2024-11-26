<?php
include("plantilla_cabecera.php");

$sAccion = "";
if(isset($_GET["sAccion"]))
  $sAccion = $_GET["sAccion"];
else if(isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if ($sAccion == "new")
{
    $sTitulo = "Registrar un nuevo proveedor";
    $sSubTitulo = "Por favor, ingresar la información del proveedor [(*) datos obligatorios]:";
    $sCambioAccion = "insert";

    $idproveedor = "";
    $ruc = "";
    $nombre_comercial = "";
    $estado = "Activo";
    $correo = "";
    $clave = "";
    $numero_contacto = "";
    $metodo_pago = "";
}
elseif ($sAccion == "edit")
{
    $sTitulo = "Modificar los datos del proveedor";
    $sSubTitulo = "Por favor, actualizar la información del proveedor [(*) datos obligatorios]:";
    $sCambioAccion = "update";

    if (isset($_GET["idproveedor"])) $idproveedor = $_GET["idproveedor"];

    $sql = "SELECT * FROM proveedor WHERE idproveedor = $idproveedor";
    $result = dbQuery($sql);
    if ($row = mysqli_fetch_array($result)) {
        $ruc = $row["ruc"];
        $nombre_comercial = $row["nombre_comercial"];
        $estado = $row["estado"];
        $correo = $row["correo"];
        $clave = $row["clave"];
        $numero_contacto = $row["numero_contacto"];
        $metodo_pago = $row["metodo_pago"];
    }
}
elseif ($sAccion == "insert")
{
    if (isset($_POST["ruc"])) $ruc = $_POST["ruc"];
    if (isset($_POST["nombre_comercial"])) $nombre_comercial = $_POST["nombre_comercial"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    if (isset($_POST["correo"])) $correo = $_POST["correo"];
    if (isset($_POST["clave"])) $clave = $_POST["clave"];
    if (isset($_POST["numero_contacto"])) $numero_contacto = $_POST["numero_contacto"];
    if (isset($_POST["metodo_pago"])) $metodo_pago = $_POST["metodo_pago"];

    if ($estado == "") $estado = 'Inactivo';

    $sql = "INSERT INTO proveedor ";
    $sql .= "(`ruc`, `nombre_comercial`, `estado`, `correo`, `clave`, `numero_contacto`, `metodo_pago`) ";
    $sql .= "VALUES ('$ruc', '$nombre_comercial', '$estado', '$correo', '$clave', '$numero_contacto', '$metodo_pago')";
    dbQuery($sql);

    $pagina = "proveedor.php";
    $mensaje = "1";
    redireccionar($pagina, $mensaje);
}
elseif ($sAccion == "update")
{
    if (isset($_POST["idproveedor"])) $idproveedor = $_POST["idproveedor"];
    if (isset($_POST["ruc"])) $ruc = $_POST["ruc"];
    if (isset($_POST["nombre_comercial"])) $nombre_comercial = $_POST["nombre_comercial"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    if (isset($_POST["correo"])) $correo = $_POST["correo"];
    if (isset($_POST["clave"])) $clave = $_POST["clave"];
    if (isset($_POST["numero_contacto"])) $numero_contacto = $_POST["numero_contacto"];
    if (isset($_POST["metodo_pago"])) $metodo_pago = $_POST["metodo_pago"];

    if ($estado == "") $estado = 'Inactivo';

    $sql = "UPDATE proveedor SET ruc = '$ruc', ";
    $sql .= "nombre_comercial = '$nombre_comercial', ";
    $sql .= "estado = '$estado', ";
    $sql .= "correo = '$correo', ";
    $sql .= "clave = '$clave', ";
    $sql .= "numero_contacto = '$numero_contacto', ";
    $sql .= "metodo_pago = '$metodo_pago' ";
    $sql .= "WHERE idproveedor = $idproveedor";
    dbQuery($sql);

    $pagina = "proveedor.php";
    $mensaje = "2";
    redireccionar($pagina, $mensaje);
}
?>

<?php
include("plantilla_menu.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#FEFEEE;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $sTitulo ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $sSubTitulo; ?></h3>
            </div>
            <div class="card-body">
                <form name="frmDatos" action="proveedor_detalle.php" method="post">
                    <input type="hidden" name="sAccion" value="<?php echo $sCambioAccion; ?>">
                    <input type="hidden" name=idproveedor value="<?php echo $idproveedor?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="ruc">RUC (*):</label>
                                <input type="text" name="ruc" id="ruc" class="form-control" value="<?php echo $ruc; ?>" required />
                            </div>
                            <div class="col-6">
                                <label for="nombre_comercial">Nombre Comercial (*):</label>
                                <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control" value="<?php echo $nombre_comercial; ?>" required />
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
                                <label for="correo">Correo (*):</label>
                                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="clave">Clave (*):</label>
                                <input type="text" name="clave" id="clave" class="form-control"
                                value="<?php echo $clave; ?>" required />
                            </div>
                            <div class="col-6">
                                <label for="numero_contacto">Número de Contacto (*):</label>
                                <input type="text" name="numero_contacto" id="numero_contacto" class="form-control" value="<?php echo $numero_contacto; ?>" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="metodo_pago">Método de Pago:</label>
                        <input type="text" name="metodo_pago" id="metodo_pago" class="form-control" value="<?php echo $metodo_pago; ?>" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <a href="proveedor.php" class="btn btn-primary">Regresar</a>
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