<?php
include("plantilla_cabecera.php");
$mensaje = "";

if (isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if (isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];

$id_contrato = "";
if (isset($_POST["id_contrato"])) $id_contrato = $_POST["id_contrato"];

// Agregar, editar o eliminar contratos de servicios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $accion = isset($_POST["accion"]) ? $_POST["accion"] : "";

  if ($accion == "nuevo") {
    // Aquí debes agregar el código para insertar un nuevo contrato en la base de datos.
    // Recupera los valores del formulario y realiza la inserción.
    $id_cliente = $_POST["id_cliente"];
    $fecha_inicio_contrato = $_POST["fecha_inicio_contrato"];
    $fecha_finalizacion_contrato = $_POST["fecha_finalizacion_contrato"];
    $tipo_servicio = $_POST["tipo_servicio"];
    $detalles_servicio = $_POST["detalles_servicio"];
    $costo_servicio = $_POST["costo_servicio"];
    $terminos_condiciones = $_POST["terminos_condiciones"];
    $estado = $_POST["estado"];

    // Realiza la inserción en la base de datos y maneja los errores si los hubiera.
    // Puedes usar consultas preparadas para mayor seguridad.

    // Después de la inserción, puedes mostrar un mensaje de éxito o error.
    $mensaje = "Nuevo contrato de servicio insertado con éxito";
  } elseif ($accion == "editar") {
    // Aquí debes agregar el código para actualizar un contrato existente en la base de datos.
    // Recupera los valores del formulario y realiza la actualización.
    $id_cliente = $_POST["id_cliente"];
    $fecha_inicio_contrato = $_POST["fecha_inicio_contrato"];
    $fecha_finalizacion_contrato = $_POST["fecha_finalizacion_contrato"];
    $tipo_servicio = $_POST["tipo_servicio"];
    $detalles_servicio = $_POST["detalles_servicio"];
    $costo_servicio = $_POST["costo_servicio"];
    $terminos_condiciones = $_POST["terminos_condiciones"];
    $estado = $_POST["estado"];

    // Realiza la actualización en la base de datos y maneja los errores si los hubiera.
    // Puedes usar consultas preparadas para mayor seguridad.

    // Después de la actualización, puedes mostrar un mensaje de éxito o error.
    $mensaje = "Contrato de servicio actualizado con éxito";
  } elseif ($accion == "eliminar") {
    // Aquí debes agregar el código para eliminar un contrato de la base de datos.
    // Utiliza el ID del contrato para realizar la eliminación.

    // Realiza la eliminación en la base de datos y maneja los errores si los hubiera.
    $mensaje = "Contrato de servicio eliminado con éxito";
  }
}

include("plantilla_menu.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #FEFEEE;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- Encabezado del contrato de servicios -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de Contratos de Servicios</h3>
      </div>

      <!-- Contenido del contrato de servicios -->
      <div class="card-body">
        <!-- Formulario para agregar/editar contrato de servicios -->
        <form action="tu_archivo.php" method="POST">
          <input type="hidden" name="accion" value="nuevo">
          <label for="id_cliente">ID del Cliente:</label>
          <input type="text" name="id_cliente" id="id_cliente">
          <!-- Agrega los demás campos del contrato de servicios aquí -->

          <button type="submit">Agregar Contrato</button>
        </form>

        <!-- Mensaje de éxito/error -->
        <?php if ($mensaje) : ?>
          <div class="mensaje"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <!-- Lista de contratos de servicios -->
        <table id="listado" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID Contrato</th>
              <th>ID Cliente</th>
              <th>Fecha de Inicio</th>
              <th>Fecha de Finalización</th>
              <th>Tipo de Servicio</th>
              <th>Detalles del Servicio</th>
              <th>Costo del Servicio</th>
              <th>Terminos y Condiciones</th>
              <th>Estado</th>
              <th>Fecha de Sistema</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <!-- Muestra la lista de contratos de servicios aquí -->
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<!-- /.card -->
     <!-- MODAL: /AdminLTE-3.2.0/pages/UI/modals.html -->
     <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="usuario.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Advertencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="idregistro" id="idregistro">
                  <p>¿Esta seguro que desea eliminar el registro seleccionado?</p>
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

      <!-- MODAL IMAGEN -->
      <div class="modal fade" id="gallery-image-modal" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-gallery-image">
            </div>
          </div>
        </div>
      </div>

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
  $('#modal-delete').on('show.bs.modal', function(e){
      var button = $(e.relatedTarget)
      var idregistro = button.data('idregistro')
      var modal = $(this)
      modal.find('.modal-body #idregistro').val(idregistro);
    }
  )
</script>
<!-- MODAL IMAGEN -->
<script>
function openImgModal(img_src)
{   console.log(img_src);
    $('.modal-gallery-image').html('<img src="'+img_src+'" class="img-responsive" />');
    $("#gallery-image-modal").modal('show');
}
</script>
<?php 
//Mensajes - TOASTR
if ($mensaje == '1') { ?>
    <script>
        toastr.success("La información se registró correctamente..!");
    </script>
<?php } else if ($mensaje == '2') { ?>
    <script>
        toastr.info("La información se actualizó correctamente..!");
    </script>
<?php } else if ($mensaje == '3') { ?>
    <script>
        toastr.warning("La información se eliminó correctamente..!");
    </script>
<?php } else if ($mensaje == '4') { ?>
    <script>
        toastr.error("Lo sentimos, se ha producido un error..!");
    </script>
<?php } ?>