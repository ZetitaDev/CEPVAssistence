
<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <h1>Lista de Alumnos - <a href="" Class="btn btn-outline-info">Agregar Estudiante</a></h1>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Cerrar caja</button>
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
                                                    <button class="btn  `1 btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
                                                    <button class="btn btn-warning">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
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
    </div>
    <!-- ./wrapper -->



    <script>
        // Función de búsqueda en vivo
        document.getElementById('myInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#myTable tr');

            rows.forEach(function(row) {
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

<?php 
include '../includes/layout.php';
?>