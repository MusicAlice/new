<?php
// conexion.php
$host = "localhost";
$port = "5432";
$dbname = "nombre_de_tu_base_de_datos";
$user = "tu_usuario";
$password = "tu_contraseña";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error al conectar a la base de datos PostgreSQL.");
}
?>
