<?php
include ("plantilla_cabecera.php");
$mensaje = "";
if(isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if(isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];
$idregistro = "";
if(isset($_POST["idregistro"])) $idregistro = $_POST["idregistro"];
if ($idregistro) {
  $sql = "UPDATE orden_servicio SET estado = 'I' WHERE idordenservicio = '$idregistro' ";
  dbQuery($sql);
  $mensaje = "3";
}
?>
<!--MODAL IMAGEN -->
<style>
.img-responsive
  {
      cursor: pointer;
  }
</style>
<?php
include ("plantilla_menu.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de Ordenes de Servicio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a class="btn btn-block btn-primary" href="orden_servicio.php" style="width: 200px;">  Nueva Orden de Servicio  </a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!--
        <div class="card-header">
          <h3 class="card-title"></h3>
        </div>
        -->
        <!-- /.card-header -->
        <?php
        $sql = "SELECT os.`fecha_hora_sistema`, os.`idordenservicio`, os.`fecha_orden`, os.`ubicacion_origen`, os.`ubicacion_destino`, 
                os.`observacion`, os.`costo_orden`, os.`porcentaje_ganancia`, os.`total`, os.`estado`,
                u.`nombre` AS usuario, c.`tipo_persona`, c.`nombre` AS cliente, s.nombre AS servicio  "; 
        $sql.= "FROM  `orden_servicio` os, `usuario` u, `cliente` c, servicio s  ";
        $sql.= "WHERE os.idusuario = u.idusuario and os.idcliente = c.idcliente and os.idservicio = s.idservicio ";
        $sql.= "ORDER BY os.`fecha_hora_sistema` DESC ";
        $result=dbQuery($sql);
        $total_registros = mysqli_num_rows($result);
        ?>
        <div class="card-body">
          <table id="listado" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="width: 70px;"></th>
              <th style="width: 120px;"></th>
              <th>Tx</th>
              <th>Nro. O/S</th>
              <th>Fecha emisión</th>
              <th>Comercial</th>
              <th>Tipo Cliente</th>
              <th>Cliente</th>
              <th>Total</th>
              <th>Estado</th>
              <th style="width: 70px;"></th>
            </tr>
            </thead>
            <tbody>
            <?php 
              if($total_registros > 0)
              { //Existen datos
                while ($row = mysqli_fetch_array($result)) {
                  $estado = "Inativo";
                  if($row["estado"] == "A"){
                    $estado = "Activo";
                  }
                  $tipo_cliente = "Natural";
                  if($row["tipo_persona"] == "J"){
                    $tipo_cliente = "Jurídica";
                  }
                  ?>
                  <tr>
                    <td>
                      <a class="btn btn-warning btn-sm" href="orden_servicio_pdf.php?idordenservicio=<?php echo $row["idordenservicio"]?>"  target="_blank">
                            <i class="fas fa-file-pdf"></i> Imprimir
                      </a>
                    </td>
                    <td>
                      <?php 
                      if($estado == "Activo") {?>
                        <a class="btn btn-secondary btn-sm" href="orden_servicio_comprobante.php?idordenservicio=<?php echo $row["idordenservicio"]?>"  target="_blank">
                        <i class="fas fa-credit-card"></i> Comprobantes
                        </a>
                      <?php } ?>
                    </td>
                    <td><?php echo $row["fecha_hora_sistema"];?></td>
                    <td><?php echo $row["idordenservicio"];?></td>
                    <td><?php echo $row["fecha_orden"];?></td>
                    <td><?php echo $row["usuario"];?></td>
                    <td><?php echo $tipo_cliente;?></td>
                    <td><?php echo $row["cliente"];?></td>
                    <td><?php echo number_format($row["total"], 2, ".", ",");?></td>
                    <td><?php echo $estado;?></td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#modal-delete" data-idregistro="<?php echo $row['idordenservicio']; ?>" >
                            <i class="fas fa-trash">
                            </i>
                            Anular
                        </a>
                    </td>
                  </tr>
                  <?php
                } 
              }
              else
              { //No existen datos
                echo "<tr><td colspan=7>No existen registros</td></tr>";
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
            <form action="orden.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Advertencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="idregistro" id="idregistro">
                  <p>¿Esta seguro que desea anular la Orden se Servicio seleccionado?</p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button type="submit" name="eliminar_registro" class="btn bg-danger btn-ok">Anular</button>
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
        toastr.warning("La Oden de Servicio ha sido anulada..!");
    </script>
<?php } else if ($mensaje == '4') { ?>
    <script>
        toastr.error("Lo sentimos, se ha producido un error..!");
    </script>
<?php } ?>