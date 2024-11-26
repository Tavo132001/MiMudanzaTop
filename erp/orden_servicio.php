<?php
include ("plantilla_cabecera.php");
$sAccion = "";
$estado = "A";
if(isset($_POST["sAccion"])) $sAccion = $_POST["sAccion"];
if ($sAccion=="insert")
{	//Insertando la venta
  $idusuario = $_SESSION["IDUSUARIO"];
  $idcliente = $_POST["idcliente"];
  $idservicio = $_POST["idservicio"];
  $fecha_orden = $_POST["fecha_orden"];
  $ubicacion_origen = $_POST["ubicacion_origen"];
  $ubicacion_destino = $_POST["ubicacion_destino"];
  $costo_orden = 0;
  $porcentaje_ganancia = $_POST["porcentaje_ganancia"];
  $total = 0;
  $observacion = $_POST["observacion"];
  $estado = 'A';
  //PASO1: SQL - Insertamos la orden_servicio [Cabecera]
  $sql = "INSERT INTO orden_servicio ";
  //idordenservicio / fecha_hora_sistema
  $sql.= "(`idusuario`, `idcliente`, `idservicio`, `fecha_orden`, `ubicacion_origen`, `ubicacion_destino`, 
           `costo_orden`, `porcentaje_ganancia`, total, `observacion`, `estado`) "; 
  $sql.=" VALUES ('$idusuario', '$idcliente', '$idservicio', '$fecha_orden', '$ubicacion_origen', '$ubicacion_destino', 
                  '$costo_orden', '$porcentaje_ganancia', '$total', '$observacion', '$estado') ";
  //exit($sql);
  dbQuery($sql);
  //PASO2: Obtenemos el ultimo ID de la orden de servicio, para al detalle y guardar los productos asociados
  $idordenservicio = extraer_valor("SELECT MAX(idordenservicio) AS valor FROM orden_servicio ") ;
  //PASO3: Redireccionado hacia la vista orden_servicio_articulo.php
  $mensaje = 0;
  $pagina= 'orden_servicio_articulo.php?idordenservicio='.$idordenservicio;
  redireccionar($pagina, $mensaje) ;
  //Fin de insercion
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
            <h1>Orden de Servicio</h1>
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
          <h3 class="card-title">Por favor, registrar la información de la Orden Servicio [(*) datos obligatorio]:</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form action="orden_servicio.php" method="post">
            <input type="hidden" name=sAccion value="insert"><!-- hidden -->
            <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION["IDUSUARIO"];?>"/>  
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="usuario">Empleado:</label>
                  <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $_SESSION["USUARIO"];?>"  disabled/>
                </div>
                <div class="col-6">
                  <label for="fecha_orden">Fecha orden (*):</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="fecha_orden" id="fecha_orden" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo date("Y-m-d")?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <?php 
                  $sql = "SELECT idcliente, nombre FROM cliente WHERE estado = 'A' ORDER BY nombre";
                  $resCliente=dbQuery($sql);
                  $total_clientes = mysqli_num_rows($resCliente);
                  ?>
                  <label for="idcliente">Cliente (*):</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="idcliente" id="idcliente" autofocus require>
                    <option value="" selected="selected">--SELECCIONE UN CLIENTE--</option>
                    <?php
                    while ($rowCliente = mysqli_fetch_array($resCliente)) {
                    ?> <option value="<?php echo $rowCliente["idcliente"]?>"><?php echo $rowCliente["nombre"]?></option> <?php
                    } 
                    ?>
                  </select>
                </div>
                <div class="col-6">
                  <?php 
                  $sql = "SELECT idservicio, nombre FROM servicio WHERE estado = 'A' ORDER BY nombre";
                  $resServicio=dbQuery($sql);
                  $total_servicios = mysqli_num_rows($resServicio);
                  ?>
                  <label for="idservicio">Servicio (*):</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="idservicio" id="idservicio" autofocus require>
                    <option value="" selected="selected">--SELECCIONE UN SERVICIO--</option>
                    <?php
                    while ($rowServicio = mysqli_fetch_array($resServicio)) {
                    ?> <option value="<?php echo $rowServicio["idservicio"]?>"><?php echo $rowServicio["nombre"]?></option> <?php
                    } 
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="ubicacion_origen">Ubicación de origen:</label>
                  <input type="text" name="ubicacion_origen" id="ubicacion_origen" class="form-control" value="" />
                </div>
                <div class="col-6">
                  <label for="ubicacion_destino">Ubicación de destino:</label>
                  <input type="text" name="ubicacion_destino" id="ubicacion_destino" class="form-control" value="" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="porcentaje_ganancia">Margen de Ganancia % sobre los costos:</label>
                  <input type="number" name="porcentaje_ganancia" id="porcentaje_ganancia" class="form-control" value="30" min="0" max="1000" step="5" required />
                </div>
                <div class="col-6">
                  <label for="observacion">Observación:</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" placeholder="Ingresar alguna observacion..."></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Ingresar los articulos de mudanza</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
    
    //Initialize select2bs4 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#fecha_orden').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    
  })
</script>