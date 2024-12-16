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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <title>Nuevo Usuario</title>
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .profile-picture {
            text-align: center;
        }

        #profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include '../includes/sidebar.php';
        // Verificar si se enviaron los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger los datos del formulario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $sexo = $_POST['sexo'];
            $telefono = $_POST['telefono'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $cedula = $_POST['cedula'];
            $rol = $_POST['rol'];
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            // Validación básica
            if (empty($nombre) || empty($apellido) || empty($sexo) || empty($fecha_nacimiento) || empty($cedula) || empty($rol) || empty($correo) || empty($password)) {
                echo "<div class='alert alert-danger'>Por favor, complete todos los campos.</div>";
            } else {
                // Hashear la contraseña
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Verificar si el rol es "usuario" (maestro) y obtener el curso
                $curso_id = null;
                if ($rol == 'usuario' && isset($_POST['curso_id'])) {
                    $curso_id = $_POST['curso_id'];
                }

                // Insertar los datos en la base de datos
                $query = "INSERT INTO usuarios (nombre, apellido, sexo, telefono, fecha_nacimiento, cedula, rol, correo, password, curso_id) 
                          VALUES ('$nombre', '$apellido', '$sexo', '$telefono', '$fecha_nacimiento', '$cedula', '$rol', '$correo', '$hashed_password', '$curso_id')";

                if ($conn->query($query) === TRUE) {
                    echo "<div class='alert alert-success'>Usuario agregado correctamente. <a href='../views/Login.php'>Iniciar sesión</a></div>";
                } else {
                    echo "<div class='alert alert-danger'>Error al agregar el usuario: " . $conn->error . "</div>";
                }
            }
        }
        ?>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Nuevo Usuario</h1>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user-plus nav-icon"></i> Agrega un nuevo Usuario</h3>
                                </div>
                                <div class="card-body">
                                    <form action="AgregarUsuario.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-container">
                                            <!-- Columna 1 -->
                                            <div class="form-column">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellido">Apellido</label>
                                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese el apellido" required>
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
                                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
                                                </div>
                                                <!-- Campo de curso (visible solo si el rol es 'usuario') -->
                                                <div class="form-group" id="curso-container" style="display: none;">
                                                    <label for="curso_id">Curso Asignado</label>
                                                    <select name="curso_id" id="curso_id" class="form-control">
                                                        <option value="" selected disabled>Seleccione un curso</option>
                                                        <?php
                                                        // Obtener los cursos disponibles
                                                        $sql = "SELECT id, curso, nivel FROM cursos";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<option value='" . $row['id'] . "'>" . $row['curso'] . " - " . $row['nivel'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Columna 2 -->
                                            <div class="form-column">
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cedula">Cédula</label>
                                                    <input type="text" id="cedula" name="cedula" class="form-control" placeholder="Ingrese la cédula" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rol">Rol</label>
                                                    <select id="rol" name="rol" class="form-control" required>
                                                        <option value="" selected disabled>Seleccione el rol</option>
                                                        <option value="Administrador">Administrador</option>
                                                        <option value="usuario">Maestro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="Ingrese el correo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Contraseña</label>
                                                    <div class="password-container">
                                                    <i class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
                                                        <input type="password" id="password" name="password" class="form-control"  placeholder="Ingrese la contraseña" required>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Mostrar campo de curso solo si el rol es 'usuario'
        document.getElementById('rol').addEventListener('change', function () {
            const cursoContainer = document.getElementById('curso-container');
            if (this.value == 'usuario') {
                cursoContainer.style.display = 'block';
            } else {
                cursoContainer.style.display = 'none';
            }
        });
    </script>
</body>

</html>
