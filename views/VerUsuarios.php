
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
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php
        include '../includes/header.php';
        include '../includes/sidebar.php';
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <h1>Lista de Usuarios</h1>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- ./card-header -->
                                <div class="card-body">
                                    <input class="form-control shadow bg-body rounded" id="myInput" type="text" placeholder="Buscar..." style="margin: 5px">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>

                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>sexo</th>
                                                <th>Estado</th>
                                                <th>Curso</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Marta</td>
                                                <td>González</td>
                                                <td>Femenino</td>
                                                <td>Retirado</td>
                                                <td>5to D</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>José</td>
                                                <td>Hernández</td>
                                                <td>Masculino</td>
                                                <td>Activo</td>
                                                <td>4to C</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Juan</td>
                                                <td>Pérez</td>
                                                <td>Masculino</td>
                                                <td>Activo</td>
                                                <td>4to A</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn  `1 btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Ana</td>
                                                <td>Gómez</td>
                                                <td>Femenino</td>
                                                <td>Retirado</td>
                                                <td>5to B</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Carlos</td>
                                                <td>Rodríguez</td>
                                                <td>Masculino</td>
                                                <td>Activo</td>
                                                <td>6to C</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Laura</td>
                                                <td>Martínez</td>
                                                <td>Femenino</td>
                                                <td>Activo</td>
                                                <td>4to D</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Pedro</td>
                                                <td>Lopez</td>
                                                <td>Masculino</td>
                                                <td>Retirado</td>
                                                <td>5to A</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>Elena</td>
                                                <td>Sánchez</td>
                                                <td>Femenino</td>
                                                <td>Activo</td>
                                                <td>6to E</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-warning">Editar Docente</button>
                                                    <button class="btn btn-danger">Eliminar Docente</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?php
        include '../includes/footer.php';
        ?>
    </div>
    <!-- ./wrapper -->



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

                // Mostrar u ocultar fila
                row.style.display = found ? '' : 'none';
            });
        });
    </script>

</body>
</html>