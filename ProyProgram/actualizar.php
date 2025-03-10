<?php
include 'conexion.php';

$usuario = null;
$id = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM usuarios WHERE id = $1";
    $resultado = pg_query_params($conn, $query, array($id));

    if ($resultado && pg_num_rows($resultado) > 0) {
        $usuario = pg_fetch_assoc($resultado);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['nombre'], $_POST['apreciacion'], $_POST['cancion'], $_POST['enlace'])) {

    $nombre = $_POST['nombre'];
    $apreciacion = $_POST['apreciacion'];
    $cancion = $_POST['cancion'];
    $enlace = $_POST['enlace'];

    $updateQuery = "UPDATE usuarios SET nombre=$1, apreciacion=$2, cancion=$3, enlace=$4 WHERE id=$5";
    $result = pg_query_params($conn, $updateQuery, array($nombre, $apreciacion, $cancion, $enlace, $id));

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el usuario: " . pg_last_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar tus datos</title>
    <link rel="stylesheet" href="estilosac.css">
</head>
<body>

    <h1>Actualiza tus datos</h1>

    <div class="container">
        <div class="form-container">
            <?php if ($usuario) { ?>
                <h3>Modificar Información</h3>
                <form action="actualizar.php?id=<?php echo htmlspecialchars($usuario['id']); ?>" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

                    <label for="apreciacion">Apreciación:</label>
                    <input type="text" name="apreciacion" value="<?php echo htmlspecialchars($usuario['apreciacion']); ?>" required>

                    <label for="cancion">Canción/Obra:</label>
                    <input type="text" name="cancion" value="<?php echo htmlspecialchars($usuario['cancion']); ?>" required>

                    <label for="enlace">Enlace:</label>
                    <input type="url" name="enlace" value="<?php echo htmlspecialchars($usuario['enlace']); ?>" required>

                    <input type="submit" value="Actualizar">
                </form>
            <?php } else { ?>
                <p>Usuario no encontrado.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>

