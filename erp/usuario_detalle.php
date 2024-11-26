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
  $Url = "descargas/usuario";
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
  $sTitulo = "Registrar un nuevo usuario";
  $sSubTitulo = "Por favor, ingresar la información del usuario [(*) datos obligatorio]:";
  $sCambioAccion = "insert";
  //VALORES POR DEFECTO
  $idusuario = "";
  $nombre = "";
  $apellido = "";
  $perfil = "ADMIN";
  $nombre_imagen = "";
  $fecha_nacimiento = date("Y-m-d"); //Setea el día de hoy
  $correo = "";
  $clave = "";
  $estado = "A";
}
elseif($sAccion=="edit")
{ //PASO 4 -CARGAMOS EL FORMULARIO PERO PARA ACTUALIZAR INFORMACIÓN  
  $sTitulo = "Modificar los datos del usuario";
  $sSubTitulo = "Por favor, actualizar la información del usuario [(*) datos obligatorio]:";
  $sCambioAccion = "update";
  if(isset($_GET["idusuario"])) $idusuario = $_GET["idusuario"];
  //Buscando los ultimos datos registrados
  $sql="Select * From usuario Where idusuario = $idusuario";
  $result=dbQuery($sql);
  //print($sql);
  if($row = mysqli_fetch_array($result))
  {	$nombre = $row["nombre"]; 
    $apellido = $row["apellido"]; 
    $perfil = $row["perfil"]; 
    $nombre_imagen = $row["nombre_imagen"]; 
    $fecha_nacimiento = $row["fecha_nacimiento"]; 
    $correo = $row["correo"]; 
    $clave = $row["clave"]; 
    $estado = $row["estado"]; 
    $fecha_hora_sistema = $row["fecha_hora_sistema"]; 
  }
}
elseif ($sAccion=="insert")
{	//PASO 3 - Insertando el registro
  //exit($_POST["nombre"]);
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["apellido"])) $apellido = $_POST["apellido"];
  if(isset($_POST["perfil"])) $perfil = $_POST["perfil"];
  if(isset($_POST["nombre_imagen"])) $nombre_imagen = $_POST["nombre_imagen"];
  if(isset($_POST["fecha_nacimiento"])) $fecha_nacimiento = $_POST["fecha_nacimiento"];
  if(isset($_POST["correo"])) $correo = $_POST["correo"];
  if(isset($_POST["clave"])) $clave = $_POST["clave"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "INSERT INTO usuario ";
  //idusuario / fecha_hora_sistema
  $sql.= "(`nombre`, `apellido`, `perfil`, `nombre_imagen`, `fecha_nacimiento`, `correo`, `clave`, `estado`) "; 
  $sql.=" VALUES ('$nombre', '$apellido', '$perfil', '$nombre_imagen', '$fecha_nacimiento', '$correo', '$clave', '$estado') ";
  //exit($sql);
  dbQuery($sql);
  //Fin de insercion
  $pagina = "usuario.php";
  $mensaje = "1";
  redireccionar($pagina, $mensaje) ;
  //Redireccionando... se termina ejecución en esta pagina
}
elseif($sAccion=="update")
{	//PASO 5 - Editando el registro
  if(isset($_POST["idusuario"])) $idusuario = $_POST["idusuario"];
  if(isset($_POST["nombre"])) $nombre = $_POST["nombre"];
  if(isset($_POST["apellido"])) $apellido = $_POST["apellido"];
  if(isset($_POST["perfil"])) $perfil = $_POST["perfil"];
  if(isset($_POST["nombre_imagen"])) $nombre_imagen = $_POST["nombre_imagen"];
  if(isset($_POST["fecha_nacimiento"])) $fecha_nacimiento = $_POST["fecha_nacimiento"];
  if(isset($_POST["correo"])) $correo = $_POST["correo"];
  if(isset($_POST["clave"])) $clave = $_POST["clave"];
  if(isset($_POST["estado"])) $estado = $_POST["estado"];
  //Validaciones
  if($estado == "") $estado = 'I'; 
  if($subir_archivo != "") $nombre_imagen = $subir_archivo;
  //SQL
  $sql = "UPDATE usuario SET nombre = '$nombre', ";
  $sql.= "apellido = '$apellido', ";
  $sql.= "perfil = '$perfil', ";
  $sql.= "nombre_imagen = '$nombre_imagen', ";
  $sql.= "fecha_nacimiento = '$fecha_nacimiento', ";
  $sql.= "correo = '$correo', ";
  $sql.= "clave = '$clave', ";
  $sql.= "estado = '$estado' ";
  $sql.= "WHERE idusuario = $idusuario ";
  //exit($sql);
  dbQuery($sql);
  //Fin de actualización
  $pagina = "usuario.php";
  $mensaje = "2";
  redireccionar($pagina, $mensaje) ;
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
          <h3 class="card-title"><?php echo $sSubTitulo;?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <form name="frmDatos" action="usuario_detalle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name=sAccion value="<?php echo $sCambioAccion?>"><!-- hidden -->
            <input type="hidden" name=idusuario value="<?php echo $idusuario?>">
            <input type="hidden" name=nombre_imagen value="<?php echo $nombre_imagen?>">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="apellido">Apellido (*):</label>
                  <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $apellido;?>"  autofocus required />
                </div>
                <div class="col-6">
                  <label for="nombre">Nombre (*):</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="avatar">Avatar:</label>
                  <input type="text" name="avatar" id="avatar" class="form-control" value="<?php echo $nombre_imagen;?>" disabled/>
                </div>
                <div class="col-6">
                  <label for="subir_archivo">Subir avatar:</label>
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
                  <label for="fecha_nacimiento">Fecha nacimiento (*):</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $fecha_nacimiento?>">
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="col-6">
                  <label for="perfil">Perfil:</label>
                  <select class="form-control" name="perfil">
                    <option value="ADMIN" <?php if($perfil == "ADMIN") echo "selected"; ?>>Administrador</option>
                    <option value="CONTA" <?php if($perfil == "CONTA") echo "selected"; ?>>Contador</option>
                    <option value="TESOR" <?php if($perfil == "TESOR") echo "selected"; ?>>Tesoreria</option>
                    <option value="OPERA" <?php if($perfil == "OPERA") echo "selected"; ?>>Operario</option>
                    <option value="GPROY" <?php if($perfil == "GPROY") echo "selected"; ?>>Gestión de proyectos</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="correo">Correo / Login (*):</label>
                  <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo;?>" required />
                </div>
                <div class="col-3">
                  <label for="clave">Clave (*):</label>
                  <input type="text" name="clave" id="clave" class="form-control" value="<?php echo $clave;?>" required />
                </div>
                <div class="col-3"><br>
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
                  <div class="form-group">
                    <a href="usuario.php" class="btn btn-primary">Regresar</a>
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
  //Datemask dd/mm/yyyy
  $('#fecha_documento').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
});
</script>