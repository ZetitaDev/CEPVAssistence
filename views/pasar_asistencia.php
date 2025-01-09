<?php
include('sidebar.php'); // Incluye la conexión a la base de datos

// Consulta para obtener la lista de cursos (tablas) en la base de datos
$sql_cursos = "SHOW TABLES LIKE 'preprimario_%'";
$result_cursos = $conn->query($sql_cursos);
$cursos = [];
while ($row = $result_cursos->fetch_array()) {
    $cursos[] = $row[0]; // Obtiene los nombres de las tablas
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Asistencia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Pasar Asistencia</h1>

    <!-- Formulario para seleccionar el curso -->
    <form id="formCurso" method="POST" action="pasar_asistencia.php">
        <div class="mb-3">
            <label for="curso" class="form-label">Selecciona un curso</label>
            <select class="form-select" id="curso" name="curso" required>
                <option value="">-- Seleccionar curso --</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso ?>"><?= $curso ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cargar Estudiantes</button>
    </form>

    <?php
    // Mostrar los estudiantes del curso seleccionado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['curso'])) {
        $curso_seleccionado = $conn->real_escape_string($_POST['curso']);

        // Consulta para obtener los estudiantes del curso seleccionado
        $sql_estudiantes = "SELECT * FROM `$curso_seleccionado`";
        $result_estudiantes = $conn->query($sql_estudiantes);

        if ($result_estudiantes->num_rows > 0): ?>
            <form id="formAsistencia" method="POST" action="guardar_asistencia.php">
                <input type="hidden" name="curso" value="<?= $curso_seleccionado ?>">
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Asistencia</th>
                            <th>Justificación (si aplica)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($estudiante = $result_estudiantes->fetch_assoc()): ?>
                            <tr>
                                <td><?= $estudiante['id'] ?></td>
                                <td><?= $estudiante['nombre'] ?></td>
                                <td><?= $estudiante['apellidos'] ?></td>
                                <td>
                                    <select name="asistencia[<?= $estudiante['id'] ?>]" class="form-select" required>
                                        <option value="">-- Seleccionar --</option>
                                        <option value="Presente">Presente</option>
                                        <option value="Tardanza">Tardanza</option>
                                        <option value="Ausente">Ausente</option>
                                        <option value="Justificado">Ausencia Justificada</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="justificacion[<?= $estudiante['id'] ?>]" class="form-control" placeholder="Escribir motivo">
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Guardar Asistencia</button>
            </form>
        <?php else: ?>
            <p class="mt-4 text-warning">No hay estudiantes registrados en el curso seleccionado.</p>
        <?php endif;
    }
    ?>
</div>
</body>
</html>
