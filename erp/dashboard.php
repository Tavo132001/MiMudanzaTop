<?php
include ("plantilla_cabecera.php");
?>

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
            <h1>Dashboard</h1>
          </div><!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>-->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Resumen de gestión</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <!-- CAJAS RESUMEN -->  
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <?php 
                  $sql = "SELECT SUM(total) as valor FROM orden_servicio WHERE estado = 'A' ";
                  $total_ordenesservicio = extraer_valor($sql);
                  ?>
                  <h3>S/ <?php echo number_format($total_ordenesservicio,2); ?></h3>
                  <p>Total de Ingresos por O/S</p>
                </div>
                <div class="icon">
                  <i class="ion ion-social-usd"></i>
                </div>
                <a href="orden.php" class="small-box-footer">Mas O/S <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <?php 
                  $sql = "SELECT COUNT(idcliente) as valor FROM cliente WHERE estado = 'A'  ";
                  $numero_clientes = extraer_valor($sql);
                  ?>
                  <h3><?php echo number_format($numero_clientes); ?></h3>
                  <p>Total de Clientes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="cliente.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php 
                  $sql = "SELECT COUNT(idproducto) as valor FROM producto WHERE estado = 'A'  ";
                  $numero_productos = extraer_valor($sql);
                  ?>
                  <h3><?php echo number_format($numero_productos); ?></h3>
                  <p>Total de Productos/Insumos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="producto.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php 
                  $sql = "SELECT (COUNT(*)/ (SELECT COUNT(*) FROM reclamo))*100 as valor 
                          FROM reclamo
                          WHERE estado='A' ";
                  $porcentaje_reclamo = extraer_valor($sql);
                  ?>
                  <h3> <?php echo number_format($porcentaje_reclamo,1).'%'; ?></h3>
                  <p>Porcentaje de reclamos atendidos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cast"></i>
                </div>
                <a href="reclamo.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Servicios mas requeridos</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">

          <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Grafico de Servicios vs Compras en cada día de semana</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<?php
include ("plantilla_pie.php");
?>
<script>
  $(function () {
    //-------------
    //- PIE CHART -
    //-------------
    //Leemos de la base de datos la información:
    <?php
    //Traemos la lista para 6 productos
    $labelsPie = "";
    $dataPie = "";
    $sql = "SELECT os.idservicio, s.nombre AS servicio, count(*) AS cantidad 
    FROM `orden_servicio` os, servicio s 
    WHERE os.idservicio = s.idservicio GROUP BY os.idservicio, s.nombre 
    ORDER BY 3 DESC LIMIT 0,6 ";
    $result=dbQuery($sql);
    $total_registros = mysqli_num_rows($result);
    if($total_registros > 0)
    { //Existen datos
      $contador = 0;
      while ($row = mysqli_fetch_array($result)) {
        $labelsPie .= "'".$row["servicio"]."',";
        $dataPie .= $row["cantidad"].",";
      }
    }
    ?>
    console.log("Lista de servicios: <?php echo $labelsPie?>");
    // Definimos el obeto a graficas
    var pieData        = {
      labels: [<?php echo $labelsPie; ?>],
      datasets: [
        {
          data: [<?php echo $dataPie; ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }

    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = pieData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    //Leemos de la base de datos la información:
    <?php
    /*
    The WEEKDAY() function returns the weekday number for a given date.
    Note: 0 = Monday, 1 = Tuesday, 2 = Wednesday, 3 = Thursday, 4 = Friday, 5 = Saturday, 6 = Sunday.
    */
    //Traemos la lista de ordenesservicio/compras para los dias de la semana
    $dataVenta = "";
    $sql = "SELECT 0, 'Lunes' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=0
    UNION
    SELECT 1, 'Martes' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=1
    UNION
    SELECT 2, 'Miercoles' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=2
    UNION
    SELECT 3, 'Jueves' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=3
    UNION
    SELECT 4, 'Viernes' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=4
    UNION
    SELECT 5, 'Sabado' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=5
    UNION
    SELECT 6, 'Domingo' AS dia, SUM(total) AS total FROM `orden_servicio` WHERE WEEKDAY(fecha_orden)=6 
    ORDER BY 1 ";
    $result=dbQuery($sql);
    $total_registros = mysqli_num_rows($result);
    if($total_registros > 0)
    { //Existen datos
      $contador = 0;
      while ($row = mysqli_fetch_array($result)) {
        $dataVenta .= "'".$row["total"]."',";
      }
    }
    $dataCompra = "";
    $sql = "SELECT 0, 'Lunes' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=0
    UNION
    SELECT 1, 'Martes' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=1
    UNION
    SELECT 2, 'Miercoles' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=2
    UNION
    SELECT 3, 'Jueves' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=3
    UNION
    SELECT 4, 'Viernes' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=4
    UNION
    SELECT 5, 'Sabado' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=5
    UNION
    SELECT 6, 'Domingo' AS dia, SUM(total) AS total FROM `compra` WHERE WEEKDAY(fecha_documento)=6 
    ORDER BY 1 ";
    $result=dbQuery($sql);
    $total_registros = mysqli_num_rows($result);
    if($total_registros > 0)
    { //Existen datos
      $contador = 0;
      while ($row = mysqli_fetch_array($result)) {
        $dataCompra .= "'".$row["total"]."',";
      }
    }
    ?>
    console.log("<?php echo $dataVenta?>");
    console.log("<?php echo $dataCompra?>");
    var areaChartData = {
      labels  : ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
      datasets: [
        {
          label               : 'Compras',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $dataCompra;?>]
        },
        {
          label               : 'Ventas',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $dataVenta;?>]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp0
    barChartData.datasets[1] = temp1

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    
  })
</script>