<?php
include ("plantilla_cabecera.php");
$mensaje = "";
if(isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if(isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];
$id_personal = "";
if(isset($_POST["id_personal"])) $id_personal = $_POST["id_personal"];
if ($id_personal) {
  $sql = "DELETE FROM personal WHERE id_personal = '$id_personal' ";
  dbQuery($sql);
  $mensaje = "3";
}
?>

<?php
include ("plantilla_menu.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#FEFEEE;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Personal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a class="btn btn-block btn-primary" href="personal_detalles.php?sAccion=new" style="width: 100px;">Nuevo</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
          <h3 class="card-title">Lista de todos los elementos de personal</h3>
        </div>
       
        <!-- /.card-header -->

        <?php
        $sql = "SELECT id_personal, nombre, apellido, fecha_nacimiento, correo, dni, celular, area, puesto, fecha_inicio, salario, fotografia, fecha_sistema FROM personal ORDER BY apellido, nombre, fecha_nacimiento";
        $result = dbQuery($sql);
        $total_registros = mysqli_num_rows($result);
        ?>
        <div class="card-body">
          <table id="listado" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Fotografía</th>
              <th>Apellido</th>
              <th>Nombre</th>
              <th>Área</th>
              <th>Fecha de Nacimiento</th>
              <th>Correo</th>
              <th>DNI</th>
              <th>Celular</th>
              <th>Puesto</th>
              <th>Fecha de Inicio</th>
              <th>Salario</th>
              <th>Fecha del Sistema</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              if($total_registros > 0)
              {
                while ($row = mysqli_fetch_array($result)) {
                  $ruta_imagen = "descargas/personal/".$row["fotografia"];
                  ?>
                  <tr>
                    <td><img src="<?php echo $ruta_imagen; ?>" alt="<?php echo $row["id_personal"]; ?>" width="50px" onclick="openImgModal('<?php echo $ruta_imagen; ?>')" class="img-responsive"></td>
                    <td><?php echo $row["apellido"]; ?></td>
                    <td><?php echo $row["nombre"]; ?></td>
                    <td><?php echo $row["area"]; ?></td>
                    <td><?php echo $row["fecha_nacimiento"]; ?></td>
                    <td><?php echo $row["correo"]; ?></td>
                    <td><?php echo $row["dni"]; ?></td>
                    <td><?php echo $row["celular"]; ?></td>
                    <td><?php echo $row["puesto"]; ?></td>
                    <td><?php echo $row["fecha_inicio"]; ?></td>
                    <td><?php echo $row["salario"]; ?></td>
                    <td><?php echo $row["fecha_sistema"]; ?></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="personal_detalles.php?sAccion=edit&id_personal=<?php echo $row["id_personal"] ?>">
                            <i class="fas fa-pencil-alt"></i>
                            Editar
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#modal-delete" data-id_personal="<?php echo $row['id_personal']; ?>">
                            <i class="fas fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                  </tr>
                  <?php
                } 
              }
              else
              {
                echo "<tr><td colspan=13>No existen registros</td></tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
     <!-- MODAL: /AdminLTE-3.2.0/pages/UI/modals.html -->
     <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="personal.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Advertencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="id_personal" id="id_personal">
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
      var id_personal = button.data('id_personal')
      var modal = $(this)
      modal.find('.modal-body #id_personal').val(id_personal);
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