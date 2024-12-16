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
    <title>Nuevo Estudiante</title>
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

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Nuevo Estudiante</h1>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-graduation-cap nav-icon"></i> Agrega un nuevo Estudiante</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-container d-flex gap-4">
                                            <!-- Column 1 -->
                                            <div class="form-column w-50">
                                                <div class="form-group">
                                                    <label for="id">ID</label>
                                                    <input type="number" id="id" name="id" class="form-control" required placeholder="Ingrese el ID del estudiante">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" id="nombre" name="nombre" class="form-control" required placeholder="Ingrese el nombre">
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellido">Apellido</label>
                                                    <input type="text" id="apellido" name="apellido" class="form-control" required placeholder="Ingrese el apellido">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Column 2 -->
                                            <div class="form-column w-50">
                                                <div class="form-group">
                                                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                                                    <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sexo">Sexo</label>
                                                    <select id="sexo" name="sexo" class="form-control" required>
                                                        <option value="" selected disabled>Seleccione</option>
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Femenino</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telefono">Teléfono</label>
                                                    <input type="text" id="telefono" name="telefono" class="form-control" required placeholder="Ingrese el teléfono">
                                                </div>
                                                <div class="form-group">
                                                    <label for="numero_tutor">Número de Tutor</label>
                                                    <input type="text" id="numero_tutor" name="numero_tutor" class="form-control" required placeholder="Ingrese el número del tutor">
                                                </div>
                                                <div class="form-group">
                                                    <label for="curso_id">Curso</label>
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
                                        <div class="text-center mt-4">
                                            <button type="submit" name="submit" class="btn btn-primary">Registrar Estudiante</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../includes/footer.php'; ?>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $numero_tutor = $_POST['numero_tutor'];
    $curso_id = $_POST['curso_id'];

    $sql = "INSERT INTO estudiantes (id, nombre, apellido, fecha_nacimiento, fecha_ingreso, sexo, telefono, numero_tutor, curso_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssisi", $id, $nombre, $apellido, $fecha_nacimiento, $fecha_ingreso, $sexo, $telefono, $numero_tutor, $curso_id);

    if ($stmt->execute()) {
        echo "<script>alert('Estudiante registrado correctamente');</script>";
    } else {
        echo "<script>alert('Error al registrar el estudiante: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>
