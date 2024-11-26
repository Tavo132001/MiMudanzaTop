<?php
include ("plantilla_cabecera.php");
$mensaje = "";
if(isset($_POST["mensaje"])) $mensaje = $_POST["mensaje"];
if(isset($_GET["mensaje"])) $mensaje = $_GET["mensaje"];
$idregistro = "";
if(isset($_POST["idregistro"])) $idregistro = $_POST["idregistro"];
if ($idregistro) {
  $sql = "DELETE FROM mudanza WHERE idregistro = '$idregistro' ";
  dbQuery($sql);
  $mensaje = "3";
}
//DEL FILTRO
$idservicio = "";
if(isset($_POST["idservicio"])) $idservicio = $_POST["idservicio"];
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
  <div class="content-wrapper" style="background-color:#FEFEEE;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detalles de Servicios brindados</h1>
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
                <h3 class="card-title">Lista de todos los Servicios brindados con su detalle respectivo e incidentes posibles</h3>
              </div>
            </div>
          </div>
          <!-- FILTRO PERSONALIZADO -->
          
        </div>
        <!-- /.card-header -->

        <?php
        $sql = "SELECT p.`idregistro`, p.`idservicio`, p.`nombre`, p.`etapas`, p.`incidentes`"; 
        $sql.= "FROM `mudanza` p , servicio c ";
        $sql.= "WHERE p.idservicio = c.idservicio ";
        if($idservicio > 0) $sql.= "AND p.idservicio = $idservicio ";
        $sql.= "ORDER BY p.nombre";
        //echo ($sql);
        $result=dbQuery($sql);
        $total_registros = mysqli_num_rows($result);
        ?>
        <div class="card-body">
        <table id="listado" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre del servicio</th>
              <th>Etapas del servicio</th>
              <th>Incidentes posibles</th>
              <th>Editar</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              if($total_registros > 0)
              { //Existen datos
                while ($row = mysqli_fetch_array($result)) {
                  $estado = "Inativo";
                  ?>
                  <tr>
                    <td><?php echo $row["nombre"];?></td>
                    <td><?php echo $row["etapas"];?></td>
                    <td><?php echo $row["incidentes"];?></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="mudanza_detalle.php?sAccion=edit&idregistro=<?php echo $row["idregistro"]?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Editar
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