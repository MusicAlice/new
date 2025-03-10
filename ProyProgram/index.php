<?php
include 'conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mortal'])) {
    $mortal = $_POST['mortal'];
    $cancion = $_POST['cancion'];
    $enlace = $_POST['enlace'];
    $apreciacion = $_POST['apreciacion'];

    // Escapar los datos para evitar inyección SQL
    $mortal = $mysqli->real_escape_string($mortal);
    $cancion = $mysqli->real_escape_string($cancion);
    $enlace = $mysqli->real_escape_string($enlace);
    $apreciacion = $mysqli->real_escape_string($apreciacion);

    // Insertar el nuevo usuario
    $query_insert = "INSERT INTO usuarios (nombre, cancion, enlace, apreciacion) 
                     VALUES ('$mortal', '$cancion', '$enlace', '$apreciacion')";
    
    if ($mysqli->query($query_insert)) {
        header("Location: index.php"); // Redirigir a la misma página después de insertar
        exit();
    } else {
        echo "Error al crear el usuario: " . $mysqli->error;
    }
}

// Verificar si se está enviando la búsqueda
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Modificar la consulta para filtrar los resultados según la búsqueda
$query = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%' OR cancion LIKE '%$search%'";
$resultado = $mysqli->query($query);

// Obtener todos los usuarios sin filtros
if ($search == '') {
    $query = "SELECT * FROM usuarios";
    $resultado = $mysqli->query($query);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <!-- Enlazamos el archivo CSS externo -->
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>MusicAlice</h1>

    <!-- Barra de búsqueda -->
    <div class="search-container">
        <form action="index.php" method="POST">
            <input type="text" name="search" placeholder="Buscar por nombre o canción" value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Buscar">
        </form>
    </div>

    
    <div class="container">
        <div class="form-container">
            <h3>Ingrese su preferencia</h3>
            <form action="index.php" method="POST">
                <label for="mortal">Nombre:</label>
                <input type="text" name="mortal" id="mortal" required><br><br>
                
                <label for="cancion">Canción/Obra:</label>
                <input type="text" name="cancion" id="cancion" required><br><br>
                
                <label for="enlace">Enlace (URL):</label>
                <input type="url" name="enlace" id="enlace" required><br><br>
                
                <label for="apreciacion">Apreciación:</label>
                <input type="text" name="apreciacion" id="apreciacion" required><br><br>
                
                <button type="submit">Guardar</button>
            </form>
        </div>

        <div class="table-container">
            <h3>Comentaristas</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Canción/Obra</th>
                        <th>Enlace</th>
                        <th>Apreciación</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { 
                        $nombre = htmlspecialchars($row["nombre"]);
                        $cancion = htmlspecialchars($row["cancion"]);
                        // Resaltar las coincidencias
                        if ($search) {
                            $nombre = preg_replace("/($search)/i", "<span class='highlight'>$1</span>", $nombre);
                            $cancion = preg_replace("/($search)/i", "<span class='highlight'>$1</span>", $cancion);
                        }
                    ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $cancion; ?></td>
                        <td><a href="<?php echo htmlspecialchars($row["enlace"]); ?>" target="_blank">Ver enlace</a></td>
                        <td><?php echo htmlspecialchars($row["apreciacion"]); ?></td>
                        <td>
                            <a href="actualizar.php?id=<?php echo $row['id']; ?>" class="btn-edit">Actualizar</a>
                        </td>
                        <td>
                            <form action="eliminar.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
