<?php
include 'conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = $mysqli->query($query);
    $usuario = $resultado->fetch_assoc();
}

if (isset($_POST['nombre']) && isset($_POST['apreciacion']) && isset($_POST['cancion']) && isset($_POST['enlace'])) {
    $nombre = $_POST['nombre'];
    $apreciacion = $_POST['apreciacion'];
    $cancion = $_POST['cancion'];
    $enlace = $_POST['enlace'];

    $query = "UPDATE usuarios SET nombre='$nombre', apreciacion='$apreciacion', cancion='$cancion', enlace='$enlace' WHERE id=$id";

    if ($mysqli->query($query)) {
        header("Location: index.php"); // Redirigir a la página principal después de actualizar
        exit();
    } else {
        echo "Error al actualizar el usuario: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar tus datos</title>
    <link rel="stylesheet" href="estilosac.css"> <!-- Estilos externos -->
</head>
<body>

    <h1>Actualiza tus datos</h1>

    <div class="container">
        <div class="form-container">
            <?php if (isset($usuario)) { ?>
                <h3>Modificar Información</h3>
                <form action="actualizar.php?id=<?php echo $usuario['id']; ?>" method="POST">
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
