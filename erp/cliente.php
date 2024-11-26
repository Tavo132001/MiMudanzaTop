<?php
include ("plantilla_cabecera.php");
$tipo_persona = "";//Definición de variable
if(isset($_POST["tipo_persona"])) $tipo_persona = $_POST["tipo_persona"];
?>

<?php
$mensaje = "";
if(isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if(isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];
$idregcliente = "";
if(isset($_POST["idregcliente"])) $idregcliente = $_POST["idregcliente"];
if ($idregcliente) {
  $sql = "DELETE FROM cliente WHERE idcliente = '$idregcliente' ";
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
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a class="btn btn-block btn-primary" href="cliente_detalle.php?sAccion=new" style="width: 100px;">  Nuevo  </a>
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
          <form action="cliente.php" method="post">
            <div class="d-flex align-items-end">
              <div class="col-6">
                <!-- select -->
                <div class="form-group">
                  <label>Tipo de persona:</label>
                  <select class="form-control" name="tipo_persona">
                    <option value="">TODOS</option>
                    <option value="N" <?php if($tipo_persona == "N") echo "selected"; ?>>Natural</option>
                    <option value="J" <?php if($tipo_persona == "J") echo "selected"; ?>>Jurídica</option>
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

        $sql = "SELECT idcliente, `tipo_persona`, `nombre`, `tipo_documento`, `numero_documento`, `direccion`, `telefono`, `correo`, `estado`, `fecha_hora_sistema` FROM `cliente` ";
        $sql.= "Where idcliente > 0 ";
        if($tipo_persona != "") $sql.= "and tipo_persona = '$tipo_persona' ";
        $sql.= "Order by nombre ";
        //echo $sql;
        $result=dbQuery($sql);
        $total_registros = mysqli_num_rows($result); //El numero de registros de resultado de la consulta
        ?>
        <div class="card-body">
          <table id="listado" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>Tipo persona</th>
              <th>Tipo de documento</th>
              <th>Nro. documento</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Estado</th>
              <th>Registro</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              if($total_registros > 0)
              { //Existen datos
                while ($row = mysqli_fetch_array($result)) {
                  $estado = "Inactivo";
                  if($row["estado"] == "A"){
                    $estado = "Activo";
                  }
                  $tipo_persona = "Natural";
                  if($row["tipo_persona"] == "J"){
                    $tipo_persona = "Jurídica";
                  }
                  ?>
                  <tr>
                    <td><?php echo $row["nombre"];?></td>
                    <td><?php echo $tipo_persona;?></td>
                    <td><?php echo $row["tipo_documento"];?></td>
                    <td><?php echo $row["numero_documento"];?></td>
                    <td><?php echo $row["direccion"];?></td>
                    <td><?php echo $row["telefono"];?></td>
                    <td><?php echo $row["correo"];?></td>
                    <td><?php echo $estado;?></td>
                    <td><?php echo $row["fecha_hora_sistema"];?></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="cliente_detalle.php?sAccion=edit&idcliente=<?php echo $row["idcliente"]?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Editar
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#modal-delete" data-idregcliente="<?php echo $row['idcliente']; ?>" >
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
            <form action="cliente.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Advertencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="idregcliente" id="idregcliente">
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
      var idregcliente = button.data('idregcliente')
      var modal = $(this)
      modal.find('.modal-body #idregcliente').val(idregcliente);
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




