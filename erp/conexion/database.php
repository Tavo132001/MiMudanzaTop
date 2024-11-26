<?php

function dbQuery($sql) {
  // Reemplace  las variables con la información requerida para conectarse a la base de datos 
  $DBHost = "localhost";
  $DBname = "ads_2023_2_g08";
  $DBUser = "root";
  $DBPass = "";
  $connDB = mysqli_connect("$DBHost","$DBUser","$DBPass", $DBname);
  if (mysqli_connect_errno())  { 
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "<br>" . mysqli_connect_errno() . PHP_EOL;
    exit;
  }
  $result = mysqli_query($connDB, $sql);
  if (!$result)
  { 
    echo "Error: No se pudo ejecutar la sentencia sql: " . $sql;
    exit;
  }
  mysqli_close($connDB);

  return $result;
}

//FUNCIONES ADICIONALES
function redireccionar($pagina, $mensaje) 
{	//Redireccionar de pagina
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $pagina= $pagina.'?mensaje='.$mensaje;
  //header("Location: http://$host$uri/$pagina");
  echo "<script language='JavaScript'>";
  echo "window.location.href='http://$host$uri/$pagina';";
  echo "</script>";
}

function quitar_acentos($cadena) 
{	//arregla caracteres extraños
  $search = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ");
  $replace = explode(",","a,e,i,o,u,n,A,E,I,O,U,N");
  $cadena= str_replace($search, $replace, $cadena);
  return $cadena;
}
function extraer_valor($sql) // Generar el código de la operación
{	// Retorna el valor de la sentencia SQL: Select [VALOR] From [TABLA] Where [CONDICIONES] 
  $resFuncion = dbQuery($sql);
  if($rowFuncion = mysqli_fetch_array($resFuncion)) 
    return $rowFuncion["valor"];
  else
    return "";
}

function numero_documento($tipo) 
{	//Nos brinda el numero siguiente de la Factura/Boleta
  $numero = 1; //Valor por defecto
  $sql = "SELECT (max(numero_documento) + 1) AS numero FROM venta WHERE tipo_documento = '$tipo' ";
  //exit($sql);
  $resFuncion=dbQuery($sql);
  if ($rowFuncion = mysqli_fetch_array($resFuncion)) {
    if($rowFuncion["numero"]) $numero = $rowFuncion["numero"];
  }
  return $numero;
}
?>