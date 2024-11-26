<?php
// Código PHP aquí
/*
Esto es para 
varias lineas
*/

/*
&& "y"
|| "o"
== "comparación"
= Asignación
*/

$nombre = "Manuel ";
$edad = 10;
$precio = 3.15;

echo "Hola, $nombre <br>"; // Imprime: Hola, Juan

if ($edad >= 18) {
    echo "Eres mayor de edad <br>";
} 
else 
{
    echo "Eres menor de edad <br>";
}

for ($i = 0; $i < 5; $i++) {
    echo "Número: $i<br>";
}


$contador = 0;
while ($contador < 4) {
    echo "Contador: $contador<br>";
    $contador++;
}

function suma($a, $b) {
    return $a + $b;
}

$resultado = suma(5, 3); // $resultado contiene 8
echo "Resultado: $resultado<br>";

$colores = array("rojo", "verde", "azul");

// Acceder a elementos del arreglo
echo $colores[0]."<br>"; // Imprime: rojo
echo $colores[1]." - segundo color <br>"; // Imprime: verde

// Recorrer un arreglo
foreach ($colores as $color) {
    echo $color . "<br>";
}

?>
<html>
Hola Mundo
Repasar el concepto de GET y POST  
SESSION

</html>