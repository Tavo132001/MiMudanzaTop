<?php
include ("plantilla_cabecera.php");
$estado_cotizacion = "";//Definición de variable
if(isset($_POST["estado_cotizacion"])) $estado_cotizacion = $_POST["estado_cotizacion"];
?>

<?php
$mensaje = "";
if(isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if(isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];
$idregcotizacion = "";
if(isset($_POST["idregcotizacion"])) $idregcotizacion = $_POST["idregcotizacion"];
if ($idregcotizacion) {
  $sql = "DELETE FROM cotizacion WHERE idcotizacion = '$idregcotizacion' ";
  dbQuery($sql);
  $mensaje = "3";
}
?>

<?php
include ("plantilla_menu.php");
?>
<script type="text/javascript">
//Funcion Nuevo registro
function New()
{	/*document.frmBrowse.accion.value = "new";
	document.frmBrowse.action="usuario_detalle.php";
	document.frmBrowse.submit();*/
  alert("Implementar registro de cotización");
}
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#FEFEEE;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de cotizaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a class="btn btn-block btn-primary" href="cotizacion_detalle.php?sAccion=new" style="width: 100px;">  Nuevo  </a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- Filtración de combos -->
        <div class="card-header">
          <form action="cotizacion.php" method="post">
            <div class="d-flex align-items-end">
              <div class="col-6">
                <!-- select -->
                <div class="form-group">
                  <label>Estado de cotizacion:</label>
                  <select class="form-control" name="estado_cotizacion">
                    <option value="">TODOS</option>
                    <option value="P" <?php if($estado_cotizacion == "P") echo "selected"; ?>>Pendiente</option>
                    <option value="A" <?php if($estado_cotizacion == "A") echo "selected"; ?>>Aceptada</option>
                    <option value="R" <?php if($estado_cotizacion == "R") echo "selected"; ?>>Rechazada</option>
                  </select>
                </div>
              </div><!--
              <div class="col-4">
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>--> <!--división tabla-->
              <div class="col-6">
                <div class="form-group">
                  <button id="submit" name="button" value="submit" class="btn btn-primary">Consultar</button>
                  <button name="button" value="Nuevo" class="btn btn-success" onclick="javascript:New();">Nuevo</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        
        <!-- /.card-header -->
        <?php
        $sql = "SELECT `idcotizacion`, `idservicio`, `idcliente`, `nombre`, `origen`, `destino`, `fecha_cotizacion`, `estado_cotizacion`, `descripcion` FROM `cotizacion` ";
        $sql.= "Where idcotizacion > 0 ";
        if($estado_cotizacion != "") $sql.= "and estado_cotizacion = '$estado_cotizacion' ";
        $sql.= "Order by fecha_cotizacion ";
        //exit($sql);
        $result=dbQuery($sql);
        $total_registros = mysqli_num_rows($result);
        ?>
        <div class="card-body">
          <table id="listado" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>Origen</th>
              <th>Destino</th>
              <th>Fecha de cotización</th>
              <th>Descripción</th>
              <th>Estado de cotización</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              if($total_registros > 0)
              { //Existen datos
                while ($row = mysqli_fetch_array($result)) {
                  $estado_cotizacion = "Pendiente";
                  if($row["estado_cotizacion"] == "A"){
                    $estado_cotizacion = "Aceptada";
                  } elseif($row["estado_cotizacion"] == "R"){
                    $estado_cotizacion = "Rechazada";
                  }
        
                  ?>
                  <tr>
                    <td><?php echo $row["nombre"];?></td>
                    <td><?php echo $row["origen"];?></td>
                    <td><?php echo $row["destino"];?></td>
                    <td><?php echo $row["fecha_cotizacion"];?></td>
                    <td><?php echo $row["descripcion"];?></td>
                    <td><?php echo $estado_cotizacion;?></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="cotizacion_detalle.php?sAccion=edit&idcotizacion=<?php echo $row["idcotizacion"]?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Editar
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#modal-delete" data-idregcotizacion="<?php echo $row['idcotizacion']; ?>" >
                            <i class="fas fa-trash">
                            </i>
                            Eliminar
                        </a>
                    </td>
                  </tr>
                  <?php
                } 
              }
              else
              { //No existen datos
                echo "<tr><td colspan=9>No existen registros</td></tr>";
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
            <form action="cotizacion.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Advertencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="idregcotizacion" id="idregcotizacion">
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
      var idregcotizacion = button.data('idregcotizacion')
      var modal = $(this)
      modal.find('.modal-body #idregcotizacion').val(idregcotizacion);
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
