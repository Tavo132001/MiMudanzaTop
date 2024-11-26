<?php
$conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL
$consulta = "SELECT * FROM tabla";
$resultado = $conexion->query($consulta);

while ($fila = $resultado->fetch_assoc()) {
    echo "Nombre: " . $fila["nombre"] . "<br>";
}


if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Nombre: " . $fila["nombre"] . ", Edad: " . $fila["edad"] . "<br>";
    }
} else {
    echo "No se encontraron registros.";
}

//INSERT
//-----------------------------------------------------------------------------
$nombre = "Ejemplo";
$edad = 25;

$consulta = "INSERT INTO usuarios (nombre, edad) VALUES ('$nombre', $edad)";

if ($conexion->query($consulta) === TRUE) {
    echo "Registro insertado correctamente.";
} else {
    echo "Error al insertar registro: " . $conexion->error;
}

//UPDATE
//-----------------------------------------------------------------------------
$nuevoNombre = "Nuevo Ejemplo";
$nuevaEdad = 30;

$consulta = "UPDATE usuarios SET nombre='$nuevoNombre', edad=$nuevaEdad WHERE id=2";

if ($conexion->query($consulta) === TRUE) {
    echo "Registro actualizado correctamente.";
} else {
    echo "Error al actualizar registro: " . $conexion->error;
}

//DELETE
//-----------------------------------------------------------------------------
$idUsuario = 2;

$consulta = "DELETE FROM usuarios WHERE id=$idUsuario";

if ($conexion->query($consulta) === TRUE) {
    echo "Registro eliminado correctamente.";
} else {
    echo "Error al eliminar registro: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();


?>