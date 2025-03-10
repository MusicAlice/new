<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Eliminamos usando parámetros seguros
    $query = "DELETE FROM usuarios WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id));

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . pg_last_error($conn);
    }
}
?>

