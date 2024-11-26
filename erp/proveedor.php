<?php
include ("plantilla_cabecera.php");

$mensaje = "";
if (isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if (isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];

$idregistro = "";
if (isset($_POST["idregistro"])) $idregistro = $_POST["idregistro"];
if ($idregistro) {
    $sql = "DELETE FROM proveedor WHERE idproveedor = '$idregistro' ";
    dbQuery($sql);
    $mensaje = "3";
}
?>

<?php
include ("plantilla_menu.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #FEFEEE;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proveedores</h1>
                </div>
                <div class="col-sm-6">
                    <!-- Botón para agregar un nuevo registro de proveedor -->
                    <div class="text-right">
                        <a class="btn btn-block btn-primary" href="proveedor_detalle.php?sAccion=new" style="width: 100px;">Nuevo</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de proveedores</h3>
            </div>
            <!-- /.card-header -->

            <?php
            $sql = "SELECT idproveedor, ruc, nombre_comercial, estado, correo, clave, numero_contacto, metodo_pago FROM proveedor";
            $result = dbQuery($sql);
            $total_registros = mysqli_num_rows($result);
            ?>
            <div class="card-body">
                <table id="listado" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>RUC</th>
                            <th>Nombre Comercial</th>
                            <th>Estado</th>
                            <th>Correo</th>
                            <th>Clave</th>
                            <th>Número de Contacto</th>
                            <th>Método de Pago</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($total_registros > 0) { //Existen datos
                            while ($row = mysqli_fetch_array($result)) {
                                $estado = "Inactivo";
                                if ($row["estado"] == "A") {
                                    $estado = "Activo";
                                }
                        ?>
                                <tr>
                                    <td><?php echo $row["ruc"]; ?></td>
                                    <td><?php echo $row["nombre_comercial"]; ?></td>
                                    <td><?php echo $row["estado"]; ?></td>
                                    <td><?php echo $row["correo"]; ?></td>
                                    <td><?php echo $row["clave"]; ?></td>
                                    <td><?php echo $row["numero_contacto"]; ?></td>
                                    <td><?php echo $row["metodo_pago"]; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="proveedor_detalle.php?sAccion=edit&idproveedor=<?php echo $row["idproveedor"] ?>">
                                            <i class="fas fa-pencil-alt"></i> Editar
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#modal-delete" data-idregistro="<?php echo $row['idproveedor']; ?>">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan=8>No existen registros</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Resto del código para modales y scripts -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include ("plantilla_pie.php");
?>
<!-- Resto del código para scripts y mensajes TOASTR -->

<!-- MODAL: Confirmar eliminación de registro -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="proveedor.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Advertencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idregistro" id="idregistro">
                    <p>¿Está seguro de que desea eliminar el registro seleccionado?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="eliminar_registro" class="btn bg-danger btn-ok">Eliminar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include ("plantilla_pie.php");
?>
<!-- Page specific script -->
<script>
    $(function () {
        $("#listado").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#listado_wrapper .col-md-6:eq(0)');
    });
</script>
<!-- MODAL DELETE -->
<script>
    $('#modal-delete').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var idregistro = button.data('idregistro')
        var modal = $(this)
        modal.find('.modal-body #idregistro').val(idregistro);
    })
</script>
<!-- Agrega aquí tus scripts personalizados si es necesario -->
<?php
// Mensajes - TOASTR
if ($mensaje == '1') {
?>
    <script>
        toastr.success("La información se registró correctamente.");
    </script>
<?php
} else if ($mensaje == '2') {
?>
    <script>
        toastr.info("La información se actualizó correctamente.");
    </script>
<?php
} else if ($mensaje == '3') {
?>
    <script>
        toastr.warning("La información se eliminó correctamente..!");
    </script>
<?php } else if ($mensaje == '4') { ?>
    <script>
        toastr.error("Lo sentimos, se ha producido un error..!");
    </script>
<?php } ?>