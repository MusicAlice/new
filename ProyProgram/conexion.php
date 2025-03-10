<?php
// Cambia los datos por los que tengas en tu servidor PostgreSQL
$conn = pg_connect("host=localhost dbname=tu_base_de_datos user=tu_usuario password=tu_contraseña");

if (!$conn) {
    die("Error de conexión a la base de datos PostgreSQL.");
}
?>

