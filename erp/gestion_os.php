<?php
include ("plantilla_cabecera.php");
$mensaje = "";
if(isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if(isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];
$idregistro = "";
if(isset($_POST["idregistro"])) $idregistro = $_POST["idregistro"];
if ($idregistro) {
  $sql = "DELETE FROM gestion_os WHERE idventa = '$idregistro' ";
  dbQuery($sql);
  $mensaje = "3";
}
//DEL FILTRO
$cliente = "";
if(isset($_POST["cliente"])) $cliente = $_POST["cliente"];
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
          <h1>Gestión de órdenes de servicio</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
  
        <div class="card-header">
          <div class="form-group">
            <div class="row">
              <div class="col-12">
                <h3 class="card-title">Lista de todas las órdenes de servicio contratados por los clientes</h3>
              </div>
            </div>
          </div>
          <!-- FILTRO PERSONALIZADO -->
          <form action="gestion_os.php" method="post">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <?php 
                  $sql = "SELECT * FROM gestion_os ORDER BY idventa ";
                  $resCategoria = dbQuery($sql);
                  ?>
                  <label>TIPO DE SERVICIO:</label>
                  <select class="form-control" name="cliente">
                    <option value="0">--TODOS--</option>
                    <?php 
                    while ($rowCategoria = mysqli_fetch_array($resCategoria)) {
                      $selected = "";
                      if($cliente == $rowCategoria["cliente"])
                      { $selected = "selected";  } ?>
                        <option value="<?php echo $rowCategoria["cliente"];?>" 
                        <?php echo $selected; ?>>
                        <?php echo $rowCategoria["cliente"];?>
                        </option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-6">
                  <!-- ESPACIO PARA OTRO FILTRO -->
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <button id="submit" name="button" value="submit" class="btn btn-primary">Consultar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-header -->

        <?php
        $sql = "SELECT `idventa`, `cliente`, `nombre`, `origen`, `destino`, `fecha_documento`, `comentarios`, `estado` FROM `gestion_os`"; 
        $sql.= "ORDER BY idventa";
        //echo ($sql);
        $result=dbQuery($sql);
        $total_registros = mysqli_num_rows($result);
        ?>
        <div class="card-body">
        <table id="listado" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID Venta</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Comentarios</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              if($total_registros > 0)
              { //Existen datos
                while ($row = mysqli_fetch_array($result)) {
                    
                  ?>
                  <tr>
                    <td><?php echo $row["idventa"];?></td>
                    <td><?php echo $row["cliente"];?></td>
                    <td><?php echo $row["nombre"];?></td>
                    <td><?php echo $row["origen"];?></td>
                    <td><?php echo $row["destino"];?></td>
                    <td><?php echo $row["fecha_documento"];?></td>
                    <td><?php echo $row["comentarios"];?></td>
                    <td><?php echo $row["estado"];?></td>
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
            <form action="tipo_servicio.php" method="post">
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