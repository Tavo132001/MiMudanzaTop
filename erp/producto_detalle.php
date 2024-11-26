<?php
include ("plantilla_cabecera.php");
//PASO 1 - RECIBIMOS LOS PARAMETROS
$sAccion = "";
if(isset($_GET["sAccion"])) 
  $sAccion = $_GET["sAccion"];
else if(isset($_POST["sAccion"])) 
  $sAccion = $_POST["sAccion"];

if(isset($_FILES["subir_archivo"]) && $_FILES['subir_archivo']['size'] > 0)
{	//Salvamos el archivo en su ruta
  $Url = "descargas/producto";
  $subir_archivo = $_FILES['subir_archivo']['name'];
  //exit($subir_archivo);
  $subir_archivo = strtolower($subir_archivo);
  $subir_archivo = quitar_acentos($subir_archivo);
  $subir_archivo = str_replace(" ", ".", $subir_archivo);
  //Si existe el archivo se elimina
  if (file_exists($Url."/".$subir_archivo)) unlink($Url."/".$subir_archivo);
  move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $Url."/".$subir_archivo);
}

if ($sAccion=="new")
{ //PASO 2 - CARGAMOS EL FORMULARIO NUEVO
  $sTitulo = "Registrar un nuevo insumo/producto";
  $sSubTitulo = "Por favor, ingresar la información del producto [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idproducto = "";
  $nombre = "";
  $descripcion = "";
  $idcategoria = "0";
  $nombre_imagen = "";
  $codigo_barras = "";
  $stock = "0";
  $precio_compra = "0.0";
  $precio_venta = "0.0";
  $estado = "A";
}
elseif($sAccion=="edit")
{ //PASO4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del insumo/producto";
  $sSubTitulo = "Por favor, actualizar la información del producto [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idproducto"])) $idproducto = $_GET["idproducto"];
  //Buscando los ultimos datos registrados
  $sql="Select * From producto Where idproducto = $idproducto";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$nombre = $row["nombre"]; 
    $idcategoria = $row["idcategoria"]; 
    $descripcion = $row["descripcion"]; 
    $nombre_imagen = $row["nombre_imagen"]; 
    $codigo_barras = $row["codigo_barras"]; 
    $stock = $row["stock"]; 
    $precio_compra = $row["precio_compra"]; 
    $precio_venta = $row["precio_venta"]; 
    $estado = $row["estado"]; 
    $fecha_hora_sistema = $row["fecha_hora_sistema"]; 
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["idcategoria"])) $idcategoria = $_POST["idcategoria"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
  if(isset($_POST["nombre_imagen"])) $nombre_imagen = $_POST["nombre_imagen"];
  if(isset($_POST["codigo_barras"])) $codigo_barras = $_POST["codigo_barras"];
  if(isset($_POST["stock"])) $stock = $_POST["stock"];
  if(isset($_POST["precio_compra"])) $precio_compra = $_POST["precio_compra"];
  if(isset($_POST["precio_venta"])) $precio_venta = $_POST["precio_venta"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "INSERT INTO producto ";
  //idproducto / fecha_hora_sistema
  $sql.= "(`nombre`, `idcategoria`, `descripcion`, `nombre_imagen`, `codigo_barras`, `stock`, `precio_compra`, `precio_venta`, `estado`) "; 
  $sql.=" VALUES ('$nombre', '$idcategoria', '$descripcion', '$nombre_imagen', '$codigo_barras', '$stock', '$precio_compra', '$precio_venta', '$estado') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "producto.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
  if(isset($_POST["idproducto"])) $idproducto = $_POST["idproducto"];
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["idcategoria"])) $idcategoria = $_POST["idcategoria"];
  if(isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
  if(isset($_POST["nombre_imagen"])) $nombre_imagen = $_POST["nombre_imagen"];
  if(isset($_POST["codigo_barras"])) $codigo_barras = $_POST["codigo_barras"];
  if(isset($_POST["stock"])) $stock = $_POST["stock"];
  if(isset($_POST["precio_compra"])) $precio_compra = $_POST["precio_compra"];
  if(isset($_POST["precio_venta"])) $precio_venta = $_POST["precio_venta"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "UPDATE producto SET nombre = '$nombre', ";
  $sql.= "idcategoria = '$idcategoria', ";
  $sql.= "descripcion = '$descripcion', ";
  $sql.= "nombre_imagen = '$nombre_imagen', ";
  $sql.= "codigo_barras = '$codigo_barras', ";
  $sql.= "stock = '$stock', ";
  $sql.= "precio_compra = '$precio_compra', ";
  $sql.= "precio_venta = '$precio_venta', ";
  $sql.= "estado = '$estado' ";
  $sql.= "WHERE idproducto = $idproducto ";
  //print($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "usuario.php";
  $mensaje = "2";
  redireccionar($producto, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
?>

<?php
include ("plantilla_menu.php");
?>
<script type="text/javascript">
  
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#FEFEEE;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $sTitulo?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h1>Gestión de Insumos/Productos</h1>
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="producto_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idproducto value="<?php echo $idproducto?>">
            <input type="hidden" name=nombre_imagen value="<?php echo $nombre_imagen?>">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="idcategoria">Categoria:</label>
                  <select class="form-control" name="idcategoria">
                    <?php 
                    $sql = "Select * From categoria_producto Order by nombre";
                    $result = dbQuery($sql);
                    while($row = mysqli_fetch_array($result))
                    {	$selected = "";
                      if($row["idcategoria"]==$idcategoria) $selected = "selected";?>
                      <option value="<?php echo $row["idcategoria"]?>" <?php echo $selected?>><?php echo $row["nombre"]?></option><?php 
                    }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="descripcion">Descripción:</label>
                  <textarea class="form-control" rows="2" name="descripcion" id="descripcion" placeholder="Ingresar descripción ..."><?php echo $descripcion;?></textarea>
                </div>
                <div class="col-6">
                  <label for="codigo_barras">Código de Barras:</label>
                  <input type="text" name="codigo_barras" id="codigo_barras" class="form-control" value="<?php echo $codigo_barras;?>"/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="imagen">Imagen:</label>
                  <input type="text" name="imagen" id="imagen" class="form-control" value="<?php echo $nombre_imagen;?>" disabled/>
                </div>
                <div class="col-6">
                  <label for="subir_archivo">Subir imagen:</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="subir_archivo" name="subir_archivo">
                    <label class="custom-file-label" for="subir_archivo">Escoger imagen</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="stock">Stock:</label>
                  <input type="number" name="stock" id="stock" class="form-control" value="<?php echo $stock;?>" min="0" max="1000" required />
                </div>
                <div class="col-6"><br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="estado" value="A" <?php if($estado == "A") echo "checked"; ?>>
                    <label class="form-check-label">Activo</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="precio_compra">Precio compra:</label>
                  <input type="number" name="precio_compra" id="precio_compra" class="form-control" value="<?php echo $precio_compra;?>" min="0" step="0.01" required />
                </div>
                <div class="col-6">
                  <label for="precio_venta">Precio venta:</label>
                  <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="<?php echo $precio_venta;?>" min="0" step="0.01" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <a href="producto.php" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
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

<!-- bs-custom-file-input COMPONENTE PARA ADJUNTAR ARCHIVOS/IMAGENES -->
<script src="libreria/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>