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
        <?php
        include '../includes/sidebar.php'; // Conexión a la base de datos
        
        // Consulta para obtener la lista de estudiantes con los datos requeridos
        $sql = "SELECT e.id, e.nombre, e.apellido, e.fecha_nacimiento, e.telefono, e.numero_tutor, 
               CONCAT(c.curso, ' - ', c.nivel) AS curso_nivel
        FROM estudiantes e
        INNER JOIN cursos c ON e.curso_id = c.id";
        $result = $conn->query($sql);
        ?>

        <div class="content-wrapper">
            <section class="content">
                <h1>Lista de Estudiantes
                    <a href="AgregarEstudiante.php" class="btn btn-outline-info">Agregar Estudiante</a>
                </h1>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <input class="form-control shadow bg-body rounded" id="myInput" type="text"
                                        placeholder="Buscar..." style="margin: 5px">
                                    <div class="table-responsive" style="max-height: 710px; overflow-x: auto;">

                                        <table class="table table-bordered table-hover">
                                            <thead style="position: sticky; top: 0; background-color: #f1f1f1; border: 1px solid #ddd; padding: 8px;">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Fecha de Nacimiento</th>
                                                    <th>Teléfono</th>
                                                    <th>Teléfono del Tutor</th>
                                                    <th>Curso</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($result->num_rows > 0): ?>
                                                    <?php while ($row = $result->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?php echo $row['nombre']; ?></td>
                                                            <td><?php echo $row['apellido']; ?></td>
                                                            <td><?php echo $row['fecha_nacimiento']; ?></td>
                                                            <td><?php echo $row['telefono']; ?></td>
                                                            <td><?php echo $row['numero_tutor']; ?></td>
                                                            <td><?php echo $row['curso_nivel']; ?></td>
                                                            <td>
                                                                <!-- Botón Editar -->
                                                                <a href="EditarEstudiante.php?id=<?php echo $row['id']; ?>"
                                                                    class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-edit"></i> Editar
                                                                </a>
                                                                <!-- Botón Eliminar -->
                                                                <button onclick="eliminarEstudiante(<?php echo $row['id']; ?>)"
                                                                    class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i> Eliminar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center">No hay estudiantes registrados
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                
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
        // Función de búsqueda en vivo
        document.getElementById('myInput').addEventListener('keyup', function () {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('tbody tr');

            rows.forEach(function (row) {
                row.style.display = Array.from(row.cells).some(cell =>
                    cell.textContent.toLowerCase().includes(input)
                ) ? '' : 'none';
            });
        });

        // Función para eliminar estudiante
        function eliminarEstudiante(id) {
            if (confirm('¿Seguro que deseas eliminar este estudiante?')) {
                window.location.href = 'EliminarEstudiante.php?id=' + id;
            }
        }
    </script>
</body>

</html>