<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
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

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include '../includes/sidebar.php';

        // Consulta para obtener todos los cursos concatenando curso y nivel
        $cursos = [];
        $sql = "SELECT id, CONCAT(curso, ' - ', nivel) AS curso_nivel FROM cursos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cursos[] = $row;
            }
        }
        ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="container">
                    <div style="margin-top: 10px; margin-bottom: -20px">
                        <h1>Lista de Estudiantes</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-9" style="margin-top: -40px; margin-bottom: 5px;">
                            <label for="curso_id" class="form-label" style="margin-bottom: -15px;">Selecciona el curso:</label>
                            <select id="curso_id" name="curso_id" class="form-control" required>
                                <option value="" selected disabled>Seleccione un curso</option>
                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?php echo $curso['id']; ?>">
                                        <?php echo $curso['curso_nivel']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Curso</th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentsTable">
                                            <!-- Aquí se cargarán los estudiantes con AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
        include '../includes/footer.php';
        ?>
    </div>

    <script>
        $(document).ready(function () {
            // Evento para detectar el cambio en el selector de curso
            $('#curso_id').change(function () {
                const cursoId = $(this).val();
                if (cursoId) {
                    // Hacer una solicitud AJAX para obtener estudiantes
                    $.ajax({
                        url: '../ajax/getStudents.php',
                        method: 'GET',
                        data: { curso_id: cursoId },
                        success: function (response) {
                            $('#studentsTable').html(response);
                        },
                        error: function () {
                            alert('Error al cargar los estudiantes.');
                        }
                    });
                } else {
                    $('#studentsTable').html(''); // Limpiar la tabla si no se selecciona ningún curso
                }
            });
        });
    </script>
</body>

</html>
