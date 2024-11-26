<?php
include ("plantilla_cabecera.php");
$idordenservicio = "";
$porcentaje_ganancia = 0;
$mensaje = "";
if(isset($_GET["idordenservicio"])) 
{
  //Viene de la Cabecera -> orden_servicio.php
  $idordenservicio = $_GET["idordenservicio"];
  $mensaje = "1"; //"Por favor, complete la orden de servicio registrando al menos un producto..!"
}  
else if(isset($_POST["idordenservicio"])) 
{
  $idordenservicio = $_POST["idordenservicio"];
  //Viene de Seleccionar un articulo para Insertar -> orden_servicio_articulo.php
  if(isset($_POST["idarticulo"])) 
  { //Información del articulo a agregar a la orden de servicio
    $idarticulo = $_POST["idarticulo"];
    $cantidad_articulo = $_POST["cantidad_articulo"];
    $valor_articulo = $_POST["valor_articulo"];
    $estado = $_POST["estado"];
    //Información del producto a agregar a la venta
    $idproducto = $_POST["idproducto"];
    $cantidad_producto = $_POST["cantidad_producto"];
    $observacion = $_POST["observacion"];
    //PASO1: Traemos el precio_compra y precio_venta del producto/insumo, para calcular el costo por emplear el insumo
    $sql = "SELECT precio_compra, precio_venta FROM producto WHERE idproducto = '$idproducto' ";
    //exit($sql);
    $resProducto = dbQuery($sql);
    if($rowProducto = mysqli_fetch_array($resProducto)){
      $precio_compra = $rowProducto["precio_compra"];
      $precio_venta = $rowProducto["precio_venta"];
      $costo_articulo = $precio_venta * $cantidad_producto;
      //PASO2: Insertamos el producto en la tabla orden_servicio_articulo [`idordenservicioarticulo`]
      $sql = "INSERT INTO `orden_servicio_articulo`(`idordenservicio`, `idarticulo`, `cantidad_articulo`, `valor_articulo`, `estado`, 
              `idproducto`, `cantidad_producto`, `costo_articulo`, `observacion`) 
              VALUES ('$idordenservicio','$idarticulo', '$cantidad_articulo', '$valor_articulo', '$estado',
              '$idproducto', '$cantidad_producto','$costo_articulo', '$observacion')";
      //exit($sql);
      dbQuery($sql);
      //PASO3: Traemos información del Total de los costos hasta el momento, ya almacenado en orden_servicio_articulo
      $sql = "SELECT SUM(costo_articulo) as valor FROM orden_servicio_articulo WHERE idordenservicio = '$idordenservicio' ";
      $costo_orden = extraer_valor($sql);
      
      //PASO4: Preguntamos por el porcentaje de ganancia del la orden
      $sql = "SELECT porcentaje_ganancia as valor FROM orden_servicio WHERE idordenservicio = '$idordenservicio' ";
      $porcentaje_ganancia = extraer_valor($sql);

      //PASO5: Actualizamos el total de la Orden de Servicio
      $total = $costo_orden;
      if($porcentaje_ganancia >  0) $total = $total * (1 + $porcentaje_ganancia/100);
      $margen_ganancia = $total - $costo_orden;
      $sql = "UPDATE `orden_servicio` SET `costo_orden`='$costo_orden', `total`='$total' WHERE `idordenservicio`='$idordenservicio'";
      //exit($sql);
      dbQuery($sql);
      $mensaje = "2";
    }
  }
  //Para eliminar un registro
  $idregistro = "";
  if(isset($_POST["idregistro"])) 
  {
    $idregistro = $_POST["idregistro"];
    //PASO1: Eliminamos el registro de la venta hasta el momento
    $sql = "DELETE FROM orden_servicio_articulo WHERE idordenservicioarticulo = '$idregistro' ";
    dbQuery($sql);

    //PASO2: Traemos información del Total de los costos hasta el momento, ya almacenado en orden_servicio_articulo
    $sql = "SELECT SUM(costo_articulo) as valor FROM orden_servicio_articulo WHERE idordenservicio = '$idordenservicio' ";
    $costo_orden = extraer_valor($sql);
    
    //PASO3: Preguntamos por el porcentaje de ganancia del la orden
    $sql = "SELECT porcentaje_ganancia as valor FROM orden_servicio WHERE idordenservicio = '$idordenservicio' ";
    $porcentaje_ganancia = extraer_valor($sql);

    //PASO4: Actualizamos el total de la Orden de Servicio
    $total = $costo_orden;
    if($porcentaje_ganancia >  0) $total = $total * (1 + $porcentaje_ganancia/100);
    $margen_ganancia = $total - $costo_orden;
    $sql = "UPDATE `orden_servicio` SET `costo_orden`='$costo_orden', `total`='$total' WHERE `idordenservicio`='$idordenservicio'";
    //exit($sql);
    dbQuery($sql);

    $mensaje = "3";
  }
}
?>

<?php
include ("plantilla_menu.php");
?>
<script type="text/javascript">

</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar la lista de Artículos a la Orden de Servicio: <?php echo $idordenservicio; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Comercial - Ventas</a></li>
              <li class="breadcrumb-item active">Orden de Servicio</li>
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
          <h3 class="card-title">Por favor, registrar la información de la Orden de Servicio [(*) datos obligatorio]:</h3><br>
          <form action="orden_servicio_articulo.php" method="post">
            <input type="hidden" name=idordenservicio value="<?php echo $idordenservicio; ?>"><!-- hidden -->
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <?php 
                  $sql = "SELECT idarticulo, nombre FROM articulo WHERE estado = 'A' ORDER BY orden, nombre ";
                  $resArticulo=dbQuery($sql);
                  $total_productos = mysqli_num_rows($resArticulo);
                  ?>
                  <label for="idarticulo">Artículo (*):</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="idarticulo" id="idarticulo" autofocus require>
                    <option value="" selected="selected">--SELECCIONE UN ARTÍCULO--</option>
                    <?php
                    while ($rowArticulo = mysqli_fetch_array($resArticulo)) {
                    ?> <option value="<?php echo $rowArticulo["idarticulo"]?>"><?php echo $rowArticulo["nombre"]?></option> <?php
                    } 
                    ?>
                  </select>
                </div>
                <div class="col-6">
                  <label for="cantidad_articulo">Cantidad Artículos (*):</label>
                  <input type="number" name="cantidad_articulo" id="cantidad_articulo" class="form-control" value="1" min="1" max="1000" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="valor_articulo">Valor del Artículo S/:</label>
                  <input type="number" name="valor_articulo" id="valor_articulo" class="form-control" value="10.0" min="0" max="100000" step="10" required />
                </div>
                <div class="col-6">
                  <div class="form-group">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="estado" value="N" checked>
                      <label class="form-check-label">Nuevo</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="estado" value="C">
                      <label class="form-check-label">Conservado</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="estado" value="D">
                      <label class="form-check-label">Desgastado</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <?php 
                  $sql = "SELECT idproducto, nombre FROM producto WHERE estado = 'A' ORDER BY nombre ";
                  $resProducto=dbQuery($sql);
                  $total_productos = mysqli_num_rows($resProducto);
                  ?>
                  <label for="idproducto">Producto / Insumo a emplear (*):</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="idproducto" id="idproducto" autofocus require>
                    <option value="" selected="selected">--SELECCIONE UN PRODUCTO--</option>
                    <?php
                    while ($rowProducto = mysqli_fetch_array($resProducto)) {
                    ?> <option value="<?php echo $rowProducto["idproducto"]?>"><?php echo $rowProducto["nombre"]?></option> <?php
                    } 
                    ?>
                  </select>
                </div>
                <div class="col-6">
                  <label for="cantidad_producto">Cantidad de Productos / Insumos(*):</label>
                  <input type="number" name="cantidad_producto" id="cantidad_producto" class="form-control" value="1" min="0" max="1000" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <label for="observacion">Observación:</label>
                  <textarea class="form-control" rows="2" name="observacion" id="observacion" placeholder="Ingresar alguna observacion de los artículos..."></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Agregar Artículo a la Orden de servicio</button>
                    <a href="orden_servicio_pdf.php?idordenservicio=<?php echo $idordenservicio; ?>" target="_blank" class="btn btn-warning">Imprimir Orden de Servicio</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-header -->
        <?php
        $sql = "SELECT osa.`idordenservicioarticulo`, a.nombre AS articulo, osa.cantidad_articulo, osa.valor_articulo, osa.estado,
                p.`nombre` AS producto, osa.`cantidad_producto`, osa.`costo_articulo`, osa.`observacion` 
                FROM `orden_servicio_articulo` osa, articulo a, producto p ";
        $sql.= "WHERE osa.idordenservicio = '$idordenservicio' 
                AND osa.idarticulo = a.idarticulo 
                AND osa.idproducto = p.idproducto ";
        $sql.= "ORDER BY osa.idordenservicioarticulo ";
        //exit($sql);
        $result=dbQuery($sql);
        $total_registros = mysqli_num_rows($result);
        ?>
        <div class="card-body">
          <?php 
          if($total_registros > 0){
            ?>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Artículo</th>
                  <th>Cant. Art.</th>
                  <th>Valor</th>
                  <th>Estado</th>
                  <th>Insumo</th>
                  <th>Cant. Insum.</th>
                  <th>Cotización</th>
                  <th>Observación</th>
                  <th style="width: 80px"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $contador = 1;
                while ($row = mysqli_fetch_array($result)) {
                  $estado = "Conservado";
                  if($row["estado"] == "N"){
                    $estado = "Nuevo";
                  }
                  else if($row["estado"] == "D"){
                    $estado = "Desgastado";
                  }
                  ?>
                  <tr>
                    <td><?php echo $contador;?></td>
                    <td><?php echo $row["articulo"];?></td>
                    <td><?php echo $row["cantidad_articulo"];?></td>
                    <td><?php echo $row["valor_articulo"];?></td>
                    <td><?php echo $estado;?></td>
                    <td><?php echo $row["producto"];?></td>
                    <td><?php echo $row["cantidad_producto"];?></td>
                    <td>S/ <?php echo number_format($row["costo_articulo"], 2, ".", ",");?></td>
                    <td><?php echo $row["observacion"];?></td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#modal-delete" data-idregistro="<?php echo $row['idordenservicioarticulo']; ?>" >
                            <i class="fas fa-trash">
                            </i>
                            Eliminar
                        </a>
                    </td>
                  </tr>
                  <?php
                  $contador++;
                }  ?>
              </tbody>
            </table>
            <br><br>
            <!--Resumen de la Venta-->
            <div class="row float-right">
              <div class="col-md-12">
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-warning">
                    <h3 class="font-weight-bold widget-user-username">Resumen de la Orden de Servicio</h3>
                  </div>
                  <div class="card-footer p-0">
                    <ul class="nav flex-column">
                      <li class="nav-item font-weight-bold">
                          Costos del servicio <span class="float-right">S/ <?php echo number_format($costo_orden, 2, ".", ",");?></span>
                      </li>
                      <li class="nav-item font-weight-bold">
                          Margen de ganancia [<?php echo $porcentaje_ganancia?>%] <span class="float-right">S/ <?php echo number_format($margen_ganancia, 2, ".", ",");?></span>
                      </li>
                      <li class="nav-item font-weight-bold">
                          Total <span class="float-right">S/ <?php echo number_format($total, 2, ".", ",");?></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /.widget-user -->
              </div>
            </div>
          <?php
          }
          else
           echo '<h3 class="card-title">No tenemos productos registrados aun.</h3>';
          ?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- MODAL: /AdminLTE-3.2.0/pages/UI/modals.html -->
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="orden_servicio_articulo.php" method="post">
            <input type="hidden" name=idordenservicio value="<?php echo $idordenservicio; ?>"><!-- hidden -->
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include ("plantilla_pie.php");
?>
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
<?php 
//Mensajes - TOASTR
if ($mensaje == '1') { ?>
    <script>
        toastr.success("Por favor, complete la Orden de Servicio registrando al menos un Artículo..!");
    </script>
<?php } else if ($mensaje == '2') { ?>
    <script>
        toastr.info("El Artículo se agrego correctamente a la Orden de Servicio..!");
    </script>
<?php } else if ($mensaje == '3') { ?>
    <script>
        toastr.warning("El Artículo se eliminó de la Orden de Servicio correctamente..!");
    </script>
<?php } else if ($mensaje == '4') { ?>
    <script>
        toastr.error("Lo sentimos, se ha producido un error..!");
    </script>
<?php } ?>
<!-- Page specific script -->
<script>
  $(function () {
    
    //Initialize select2bs4 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
   
  })
</script>