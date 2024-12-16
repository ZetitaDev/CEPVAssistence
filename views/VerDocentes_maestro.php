<?php
include '../includes/sidebar_maestro.php'; // Conexión a la base de datos

// Consulta para obtener la lista de usuarios con rol 'usuario'
$sql = "SELECT u.nombre, u.apellido, u.sexo, u.rol, u.fecha_nacimiento, u.cedula, u.telefono, u.foto_perfil
        FROM usuarios u
        WHERE u.rol = 'usuario'";

// Ejecutar la consulta
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <h1>Lista de Docentes</h1>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <input class="form-control shadow bg-body rounded" id="myInput" type="text" placeholder="Buscar..." style="margin: 5px">
                                    
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Sexo</th>
                                                <th>Estado</th>
                                                <th>Curso</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <?php if ($result->num_rows > 0): ?>
                                                <?php while ($row = $result->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?php echo $row['nombre']; ?></td>
                                                        <td><?php echo $row['apellido']; ?></td>
                                                        <td><?php echo $row['sexo']; ?></td>
                                                        <td><?php echo $row['rol']; ?></td>
                                                        <td>Curso de ejemplo</td> <!-- Cambia esto si tienes información de curso -->
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No hay usuarios registrados.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>

    <script>
        // Función de búsqueda en vivo
        document.getElementById('myInput').addEventListener('keyup', function () {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#myTable tr');

            rows.forEach(function (row) {
                var cells = row.getElementsByTagName('td');
                var found = false;

                for (var i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(input)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            });
        });
    </script>
</body>
</html>
