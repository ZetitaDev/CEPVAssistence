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
        include '../includes/sidebar.php';
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content"><div class="container">
                <h1>Asistencia de alumnos - <a class="btn btn-info">Presentar Asistencia</a></h1>        
    <div class="row">
      <div class="col-md-6 offset-md-9" style="margin-top: -55px; margin-bottom: 5px;">
        <label for="selectBox" class="form-label " style="margin-bottom: -15px;">Selecciona el curso:</label>
        <select id="selectBox" class="form-select w-50" style="margin-bottom: 15px;">
          <option value="" selected disabled>Elige un curso</option>
          <option value="1">Opción 1</option>
          <option value="2">Opción 2</option>
          <option value="3">Opción 3</option>
        </select>
      </div>
    </div>
  </div>


                <div class="container-fluid">


                <div class="d-flex justify-content-center align-items-center flex-column" style="margin-left: 55px;">
  <div class="container">
    <!-- Primera fila -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Varones</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Hembras</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Total de Presentes</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Total de Ausentes</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Segunda fila -->
    <div class="row mt-4">
      <div class="col-lg-3 col-6 offset-lg-1">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Tardanza</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Excusa Justificada</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="card text-center shadow" style="width: 18rem; border-radius: 10px;">
          <div class="card-body">
            <p class="card-text text-muted fs-5">Excusa</p>
            <h1 class="fw-bold display-4 mb-0">150</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


                    <div class="row">
                        <div class="col-12">
                            <hr style="background-color: black; height:2%; width: 100%">
                            <div class="card">
                                <!-- ./card-header -->

                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>•</th>
                                                <th>Usuario</th>
                                                <th>Hora de entrada</th>
                                                <th>Estado</th>
                                                <th>Curso</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>183</td>
                                                <td>John Doe</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Presente</td>
                                                <td>5to E Informatica.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>219</td>
                                                <td>Alexander Pierce</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Excusa</td>
                                                <td>4to E informatica.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Cerrar caja</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>657</td>
                                                <td>Alexander Pierce</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Presente</td>
                                                <td>6to A Enfermeria.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn  `1 btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>175</td>
                                                <td>Mike Doe</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Ausente</td>
                                                <td>5to C Comercio y Mercadeo.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>134</td>
                                                <td>Jim Doe</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Presente</td>
                                                <td>4to E Informatica.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>494</td>
                                                <td>Victoria Doe</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Excusa</td>
                                                <td>4to B Comercio y Mercadeo.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>832</td>
                                                <td>Michael Doe</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Presente</td>
                                                <td>6to D Tributaria.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
                                                    <button class="btn btn-danger">Eliminar Estudiante</button>
                                                </td>
                                            </tr>

                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>982</td>
                                                <td>Rocky Doe</td>
                                                <td>@DateTime.Now.ToString("D") @DateTime.Now.ToString("T")</td>
                                                <td>Ausente</td>
                                                <td>4to D Tributaria.</td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <button class="btn btn-primary">Editar Estudiante</button>
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
  <?php
            include '../includes/footer.php';
            ?>

    </div>
    <!-- ./wrapper -->
</body>

</html>