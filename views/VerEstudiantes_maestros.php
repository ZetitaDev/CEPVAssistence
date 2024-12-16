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
        include '../includes/sidebar_maestro.php'; // Conexión a la base de datos

        // Parámetros de paginación
        $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10; // Cantidad por página (por defecto 10)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual (por defecto 1)

        // Calcular el offset para la consulta SQL
        $offset = ($page - 1) * $perPage;

        // Consulta para obtener el total de estudiantes
        $totalSql = "SELECT COUNT(*) as total FROM estudiantes";
        $totalResult = $conn->query($totalSql);
        $totalRow = $totalResult->fetch_assoc();
        $totalStudents = $totalRow['total'];

        // Calcular el número total de páginas
        $totalPages = ceil($totalStudents / $perPage);

        // Consulta para obtener los estudiantes con paginación
        $sql = "SELECT e.id, e.nombre, e.apellido, e.fecha_nacimiento, e.telefono, e.numero_tutor, 
               CONCAT(c.curso, ' - ', c.nivel) AS curso_nivel
        FROM estudiantes e
        INNER JOIN cursos c ON e.curso_id = c.id
        LIMIT $perPage OFFSET $offset";
        $result = $conn->query($sql);
        ?>

        <div class="content-wrapper">
            <section class="content">
                <h1>Lista de Estudiantes
                </h1>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <input class="form-control shadow bg-body rounded" id="myInput" type="text"
                                        placeholder="Buscar..." style="margin: 5px">
                                    
                                    <!-- Selector para elegir la cantidad de estudiantes por página -->
                                    <div class="d-flex justify-content-between">
                                        <label for="perPage" class="form-label">Mostrar por página</label>
                                        <select id="perPage" class="form-control" style="width: auto;">
                                            <option value="10" <?php if ($perPage == 10) echo 'selected'; ?>>10</option>
                                            <option value="25" <?php if ($perPage == 25) echo 'selected'; ?>>25</option>
                                            <option value="50" <?php if ($perPage == 50) echo 'selected'; ?>>50</option>
                                        </select>
                                    </div>

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
                                            
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center">No hay estudiantes registrados</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Paginación -->
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=1&perPage=<?php echo $perPage; ?>" aria-label="Primera página">
                                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo $page - 1; ?>&perPage=<?php echo $perPage; ?>" aria-label="Página anterior">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>&perPage=<?php echo $perPage; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo $page + 1; ?>&perPage=<?php echo $perPage; ?>" aria-label="Página siguiente">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo $totalPages; ?>&perPage=<?php echo $perPage; ?>" aria-label="Última página">
                                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <?php
    include '../includes/footer.php';
    ?>
    </div>
 
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

        // Cambiar el número de resultados por página
        document.getElementById('perPage').addEventListener('change', function () {
            var perPage = this.value;
            var urlParams = new URLSearchParams(window.location.search);
            urlParams.set('perPage', perPage);
            urlParams.set('page', 1); // Volver a la página 1 al cambiar el número de resultados
            window.location.search = urlParams.toString();
        });
    </script>
</body>

</html>
