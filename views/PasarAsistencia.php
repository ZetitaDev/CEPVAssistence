<?php
include '../includes/sidebar.php';

// Obtener todos los cursos para el selector
$cursos = [];
$queryCursos = "SELECT id, CONCAT(curso, ' - ', nivel) AS curso_nivel FROM cursos";
$result = $conn->query($queryCursos);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="container mt-5">
                <h1 class="text-center">Pasar Asistencia</h1>
                <div class="mb-4">
                    <label for="curso_id" class="form-label">Selecciona el Curso:</label>
                    <select id="curso_id" name="curso_id" class="form-select" required>
                        <option value="" selected disabled>Seleccione un curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id']; ?>"><?= $curso['curso_nivel']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="asistenciaForm" method="POST">
                    <input type="hidden" name="curso_id" id="hidden_curso_id">
                    <table class="table table-bordered" id="studentsTable">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Estado</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los estudiantes se cargarán dinámicamente aquí -->
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success w-100 mt-3" style="display: none;" id="guardarBtn">Guardar Asistencia</button>
                </form>
            </div>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>

    <script>
$(document).ready(function () {
    $('#curso_id').change(function () {
        const cursoId = $(this).val(); // Obtener el ID del curso seleccionado
        if (cursoId) {
            // Hacer la solicitud AJAX a `getStudentsAsistencia.php`
            $.ajax({
                url: 'getStudentsAsistencia.php?curso_id=' + cursoId,
                method: 'GET',
                success: function (response) {
                    $('#studentsTable tbody').html(response);
                    $('#hidden_curso_id').val(cursoId); // Asignar curso al formulario
                    $('#guardarBtn').show(); // Mostrar botón de guardar
                },
                error: function () {
                    alert('Error al cargar los estudiantes.');
                }
            });
        } else {
            // Limpiar la tabla si no se selecciona un curso válido
            $('#studentsTable tbody').html('');
            $('#guardarBtn').hide();
        }
    });
});
    </script>
</body>
</html>
