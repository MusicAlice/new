<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $id = $mysqli->real_escape_string($id);

    $query = "DELETE FROM usuarios WHERE id = '$id'";

    if ($mysqli->query($query)) {
        header("Location: index.php"); 
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $mysqli->error;
    }
}
?>
