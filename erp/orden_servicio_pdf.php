<?php
require_once 'conexion/database.php';
require_once 'libreria/fpdf/fpdf.php'; //Incluir libreria
if(isset($_GET["idordenservicio"])) 
{
  $idordenservicio = $_GET["idordenservicio"];
}

$pdf = new FPDF('P', 'mm', 'A4'); //El constructor se usa aquí con sus valores por defecto: las páginas son de tamaño a4 alargado y la unidad de medida es el milímetro
$pdf->AddPage(); //añadiremos una pagina
$pdf->SetMargins(10, 10, 10); //El origen de coordenadas está en la esquina superior izquierda y la posición actual está por defecto situada a 1 cm de los bordes; los márgenes pueden cambiarse con SetMargins().
$pdf->SetTitle("Orden de servicio");
//Datos de la orden_servicio
$sql = "SELECT * FROM orden_servicio WHERE idordenservicio = '$idordenservicio' ";
$resOrdenArticulo = dbQuery($sql);
if($rowVenta = mysqli_fetch_array($resOrdenArticulo))
{
  $idordenservicio	 = $rowVenta["idordenservicio"];
  $idservicio	 = $rowVenta["idservicio"];
  $idcliente = $rowVenta["idcliente"];
  $fecha_orden = $rowVenta["fecha_orden"];
  $ubicacion_origen = $rowVenta["ubicacion_origen"];
  $ubicacion_destino = $rowVenta["ubicacion_destino"];
  $observacion = $rowVenta["observacion"];
  $costo_orden = $rowVenta["costo_orden"];
  $porcentaje_ganancia = $rowVenta["porcentaje_ganancia"];
  $total = $rowVenta["total"];

  //Datos de la Empresa
  //Ubicación del logo ancho,altura
  $pdf->SetFont('Arial', 'B', 14); //Antes de que podamos imprimir texto, es obligatorio escoger una fuente con SetFont(). Escogemos Arial en negrita/B de tamaño 14:
  $pdf->Cell(185, 5, iconv("UTF-8", "ISO-8859-1", 'Mi Mudanza Top - Orden de servicio'), 0, 1, 'C'); //imprimir una celda con Cell()
  $pdf->Image("descargas/pucp.png", 170, 5, 30, 30, 'PNG');
  $pdf->Ln();//Linea en blanco
  //Telefono
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(35, 5, iconv("UTF-8", "ISO-8859-1", "Teléfono: "), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(120, 5, "(51) 1 4235522", 0, 1, 'L');
  //Dirección
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(35, 5, iconv("UTF-8", "ISO-8859-1", "Dirección: "), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(120, 5, iconv("UTF-8", "ISO-8859-1", "Av. universitaria 123"), 0, 1, 'L');
  $pdf->SetFont('Arial', 'B', 10);
  //Correo
  $pdf->Cell(35, 5, "Correo: ", 0, 0, 'L');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(120, 5, iconv("UTF-8", "ISO-8859-1", 'mhchavez@pucp.pe'), 0, 1, 'L');
  //Fecha
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(35, 5, iconv("UTF-8", "ISO-8859-1", 'Fecha de O/S: '), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(80, 5, $fecha_orden, 0, 0, 'L');//antes de L se cambia a cero para que se mantenga en la linea
  //Nro. de Orden de servicio
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(50, 5, "O/S Nro. ".$idordenservicio, 0, 1, 'L');

  //Datos del cliente
  $sql = "SELECT * FROM cliente WHERE idcliente = '$idcliente' ";
  $resCliente = dbQuery($sql);
  if($rowCliente = mysqli_fetch_array($resCliente))
  { 
    $pdf->Ln();//Linea en blanco
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(77, 83, 114); //Fondo Azul
    $pdf->SetTextColor(255, 255, 255); //Color blanco
    $pdf->Cell(190, 5, "Datos del cliente", 1, 1, 'C', 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(70, 5, iconv("UTF-8", "ISO-8859-1", 'Nombre'), 0, 0, 'L');
    $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", 'Teléfono'), 0, 0, 'L');
    $pdf->Cell(76, 5, iconv("UTF-8", "ISO-8859-1", 'Dirección'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(70, 5, iconv("UTF-8", "ISO-8859-1", $rowCliente['nombre']), 0, 0, 'L');
    $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", $rowCliente['telefono']), 0, 0, 'L');
    $pdf->Cell(76, 5, iconv("UTF-8", "ISO-8859-1", $rowCliente['direccion']), 0, 1, 'L');
    $pdf->Ln(3);

    //Datos del Servicio
    $sql = "SELECT * FROM servicio WHERE idservicio = '$idservicio' ";
    $resServicio = dbQuery($sql);
    if($rowServicio = mysqli_fetch_array($resServicio))
    { 
      //Datos del servicio
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->SetTextColor(255, 255, 255);
      $pdf->Cell(190, 5, "Detalle del Servicio", 1, 1, 'C', 1);
      $pdf->SetTextColor(0, 0, 0);
      //Servicio
      $pdf->Cell(50, 5, "Servicio: ", 0, 0, 'L');
      $pdf->SetFont('Arial', '', 10);
      $pdf->Cell(140, 5, iconv("UTF-8", "ISO-8859-1", $rowServicio['nombre']), 0, 1, 'L');
      //Ubicación Origen
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", 'Ubicación de origen: '), 0, 0, 'L');
      $pdf->SetFont('Arial', '', 10);
      $pdf->Cell(140, 5, iconv("UTF-8", "ISO-8859-1", $ubicacion_origen), 0, 1, 'L');
      //Ubicación Destino
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", 'Ubicación de destino: '), 0, 0, 'L');
      $pdf->SetFont('Arial', '', 10);
      $pdf->Cell(140, 5, iconv("UTF-8", "ISO-8859-1", $ubicacion_destino), 0, 1, 'L');
      //Observación
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", 'Observación: '), 0, 0, 'L');
      $pdf->SetFont('Arial', '', 10);
      $pdf->Cell(140, 5, iconv("UTF-8", "ISO-8859-1", $observacion), 0, 0, 'L');
      $pdf->Ln(7);
    }
    
    //Datos del detalle de la orden_servicio
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(190, 5, "Detalle de Producto", 1, 1, 'C', 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(5, 5, iconv("UTF-8", "ISO-8859-1", 'N°'), 0, 0, 'L');
    $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", 'Artículo'), 0, 0, 'L');
    $pdf->Cell(8, 5, 'Cant.', 0, 0, 'C');
    $pdf->Cell(20, 5, iconv("UTF-8", "ISO-8859-1", 'Valor'), 0, 0, 'C');
    $pdf->Cell(18, 5, 'Estado', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Insumo', 0, 0, 'L');
    $pdf->Cell(40, 5, iconv("UTF-8", "ISO-8859-1", 'Observación'), 0, 1, 'L');
    
    $pdf->SetFont('Arial', '', 8);
    $sql = "SELECT osa.`idordenservicioarticulo`, a.nombre AS articulo, osa.cantidad_articulo, osa.valor_articulo, osa.estado,
            p.`nombre` AS producto, osa.`cantidad_producto`, osa.`costo_articulo`, osa.`observacion` 
            FROM `orden_servicio_articulo` osa, articulo a, producto p ";
    $sql.= "WHERE osa.idordenservicio = '$idordenservicio' 
            AND osa.idarticulo = a.idarticulo 
            AND osa.idproducto = p.idproducto ";
    $sql.= "ORDER BY osa.idordenservicioarticulo ";
    $resOrdenArticulo = dbQuery($sql);
    $contador = 1;
    while ($row = mysqli_fetch_array($resOrdenArticulo)) {
        $estado = "Conservado";
        if($row["estado"] == "N"){
          $estado = "Nuevo";
        }
        else if($row["estado"] == "D"){
          $estado = "Desgastado";
        }
        $articulo = substr($row['articulo'],0,30).'...';
        $producto = substr($row['producto'],0,30).'...';
        $observacion = substr($row['observacion'],0,30).'...';
        $pdf->Cell(5, 5, $contador, 0, 0, 'C');
        $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", $articulo), 0, 0, 'L');
        $pdf->Cell(8, 5, $row['cantidad_articulo'], 0, 0, 'C');
        $pdf->Cell(20, 5, "S/ ".number_format($row["valor_articulo"], 2, ".", ","), 0, 0, 'C');
        $pdf->Cell(18, 5, $estado, 0, 0, 'L');
        $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", $producto), 0, 0, 'L');
        $pdf->Cell(50, 5, iconv("UTF-8", "ISO-8859-1", $observacion), 0, 0, 'L');
        $pdf->Ln();
        $contador++;
    }
    $pdf->Ln(5);
  }
}
$pdf->Output("ComprobanteVenta.pdf", "I");
?>
