<?php
include '../includes/sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar asistencia en la base de datos
    $curso_id = intval($_POST['curso_id']);
    $fecha = date('Y-m-d');
    $estados = $_POST['estado'] ?? [];
    $comentarios = $_POST['comentario'] ?? [];

    foreach ($estados as $estudiante_id => $estado) {
        $comentario = $comentarios[$estudiante_id] ?? null;
        $comentario = $conn->real_escape_string($comentario);

        $query = "INSERT INTO asistencia (estudiante_id, curso_id, fecha, estado, comentario)
                  VALUES ($estudiante_id, $curso_id, '$fecha', '$estado', '$comentario')";
        $conn->query($query);
    }

    echo "<script>alert('Asistencia guardada correctamente'); window.location.href='PasarAsistencia.php';</script>";
    exit;
}

// Obtener los cursos para el selector
$queryCursos = "SELECT id, curso, nivel, seccion FROM cursos";
$resultCursos = $conn->query($queryCursos);

$cursoSeleccionado = isset($_GET['curso_id']);
if ($cursoSeleccionado) {
    $curso_id = intval($_GET['curso_id']);

    // Detalles del curso
    $queryCurso = "SELECT curso, nivel, seccion FROM cursos WHERE id = $curso_id";
    $curso = $conn->query($queryCurso)->fetch_assoc();

    // Estudiantes activos del curso
    $queryEstudiantes = "SELECT id, nombre, apellido FROM estudiantes WHERE curso_id = $curso_id AND estado = 'activo'";
    $resultEstudiantes = $conn->query($queryEstudiantes);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Asistencia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Pasar Asistencia</h2>
        <?php if (!$cursoSeleccionado) { ?>
            <!-- Formulario para seleccionar curso -->
            <div class="card shadow">
                <div class="card-body">
                    <form method="GET" action="PasarAsistencia.php">
                        <div class="mb-3">
                            <label for="curso" class="form-label">Seleccione el Curso:</label>
                            <select name="curso_id" id="curso" class="form-select" required>
                                <option value="" disabled selected>Seleccione un curso</option>
                                <?php while ($row = $resultCursos->fetch_assoc()) { ?>
                                    <option value="<?= $row['id'] ?>">
                                        <?= $row['curso'] ?> - <?= $row['nivel'] ?> - <?= $row['seccion'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Continuar</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <!-- Lista de estudiantes -->
            <div class="card shadow">
                <div class="card-body">
                    <h3>Curso: <?= $curso['curso'] ?> - <?= $curso['nivel'] ?> - <?= $curso['seccion'] ?></h3>
                    <form method="POST" action="PasarAsistencia.php">
                        <input type="hidden" name="curso_id" value="<?= $curso_id ?>">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $resultEstudiantes->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $row['nombre'] . ' ' . $row['apellido'] ?></td>
                                        <td>
                                            <select name="estado[<?= $row['id'] ?>]" class="form-select" required>
                                                <option value="presente">Presente</option>
                                                <option value="ausente">Ausente</option>
                                                <option value="tardanza">Tardanza</option>
                                                <option value="justificado">Justificado</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="comentario[<?= $row['id'] ?>]" class="form-control" placeholder="Comentario opcional">
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success w-100">Guardar Asistencia</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tema AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</head>


<title>Dashboard</title>
<body>
    <?php
       include '../includes/sidebar.php';
       ?>
</body>

<?php
     include '../includes/footer.php';
     ?>





</html>
