<?php

$host = "dpg-cv7mek3tq21c73cfa3eg-a";
$port = "5432";
$user = "pruejem_db_user";
$password = "97lfWDEmuy5uFqK2Q9Ql78EvhnqUuiMP";
$dbname = "pruejem_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit(); // Importante: salir si hay error
}
?>
