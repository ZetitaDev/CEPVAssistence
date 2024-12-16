<?php
include '../includes/sidebar.php'; // Conexión a la base de datos

// Verificar que se ha proporcionado un ID válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de estudiante no proporcionado');
}

$id = $_GET['id'];

// Obtener datos del estudiante con el ID proporcionado
$sql = "SELECT nombre, apellido, fecha_nacimiento, telefono, numero_tutor FROM estudiantes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el estudiante existe
if ($result->num_rows === 0) {
    die('Estudiante no encontrado');
}

$estudiante = $result->fetch_assoc();

// Verificar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $numero_tutor = $_POST['numero_tutor'];

    // Validar los datos antes de actualizar
    if (!empty($nombre) && !empty($apellido) && !empty($fecha_nacimiento) && !empty($telefono)) {
        // Actualizar los datos del estudiante
        $sql_update = "UPDATE estudiantes SET nombre = ?, apellido = ?, fecha_nacimiento = ?, telefono = ?, numero_tutor = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('sssssi', $nombre, $apellido, $fecha_nacimiento, $telefono, $numero_tutor, $id);

        if ($stmt_update->execute()) {
            echo "Estudiante actualizado correctamente. Redirigiendo...";
            echo "<script>setTimeout(() => { window.location.href = 'VerEstudiantes.php?mensaje=editado'; }, 1000);</script>";
        } else {
            $error = 'Error al actualizar el estudiante: ' . $conn->error;
        }
    } else {
        $error = 'Todos los campos son obligatorios.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <h1>Editar Estudiante</h1>
                <div class="container">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($estudiante['nombre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($estudiante['apellido']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($estudiante['fecha_nacimiento']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($estudiante['telefono']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="numero_tutor">Teléfono del Tutor</label>
                            <input type="text" class="form-control" id="numero_tutor" name="numero_tutor" value="<?php echo htmlspecialchars($estudiante['numero_tutor']); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="VerEstudiantes.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </section>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>
</body>
</html>
