<?php
$mysqli = new mysqli("localhost", "root", "Colombia1*", "pruejem");

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit(); // Importante: salir si hay error
}
?>
