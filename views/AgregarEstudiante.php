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
    <style>
        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        .form-column {
            flex: 1;
        }

        .profile-picture {
            text-align: center;
        }

        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Nuevo Estudiante</h1>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-graduation-cap nav-icon"></i> Agrega un nuevo Estudiante</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-container">
                                    <!-- Columna 1 -->
                                    <div class="form-column">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese los apellidos" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sexo">Sexo</label>
                                            <select id="sexo" name="sexo" required>
                                                <option value="">Seleccione</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select id="estado" name="estado" required>
                                                <option value="">Seleccione</option>
                                                <option value="Activo">Activo</option>
                                                <option value="Retirado">Retirado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Columna 2 -->
                                    <div class="form-column">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                                            <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" id="telefono" name="telefono" placeholder="Ingrese el teléfono" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono_tutor">Teléfono del Tutor</label>
                                            <input type="text" id="telefono_tutor" name="telefono_tutor" placeholder="Ingrese el teléfono del tutor" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Foto de Perfil</label>
                                            <input type="file" id="foto" name="foto" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Registrar Estudiante</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../includes/footer.php'; ?>
    </div>

    <!-- Procesar formulario -->
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear conexión
    $conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

    // Verificar conexión
    if ($conn->connect_error) {
        die('Error de conexión: ' . $conn->connect_error);
    }

    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $sexo = $_POST['sexo'];
    $estado = $_POST['estado'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $telefono = $_POST['telefono'];
    $telefono_tutor = $_POST['telefono_tutor'];

    // Manejo de la foto
    $foto_nombre = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $directorio = __DIR__ . "/uploads/";

    // Crear la carpeta "uploads" si no existe
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $foto_destino = $directorio . basename($foto_nombre);

    if (move_uploaded_file($foto_tmp, $foto_destino)) {
        // Guardar la ruta relativa en la base de datos
        $foto_db_path = "uploads/" . basename($foto_nombre);

        // Preparar la consulta SQL
        $query = "INSERT INTO preprimario_a (nombre, apellidos, sexo, estado, fecha_nacimiento, fecha_ingreso, telefono, telefono_tutor, foto) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('sssssssss', $nombre, $apellidos, $sexo, $estado, $fecha_nacimiento, $fecha_ingreso, $telefono, $telefono_tutor, $foto_db_path);

            if ($stmt->execute()) {
                echo "<script>alert('Estudiante registrado correctamente');</script>";
            } else {
                echo "<script>alert('Error al registrar al estudiante: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error en la consulta SQL: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error al subir la foto');</script>";
    }

    $conn->close();
}
?>
</body>
</html>
