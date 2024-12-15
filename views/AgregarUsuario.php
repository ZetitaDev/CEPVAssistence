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

    // Validación básica (puedes agregar más validaciones si es necesario)
    if (empty($nombre) || empty($apellido) || empty($sexo) || empty($fecha_nacimiento) || empty($cedula) || empty($rol) || empty($correo) || empty($password)) {
        echo "<div class='alert alert-danger'>Por favor, complete todos los campos.</div>";
    } else {
        // Hashear la contraseña para mayor seguridad
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar los datos en la base de datos
        $query = "INSERT INTO usuarios (nombre, apellido, sexo, telefono, fecha_nacimiento, cedula, rol, correo, password) 
                  VALUES ('$nombre', '$apellido', '$sexo', '$telefono', '$fecha_nacimiento', '$cedula', '$rol', '$correo', '$hashed_password')";

        if ($conn->query($query) === TRUE) {
            // Redirigir a la página de inicio de sesión si el registro es exitoso
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
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese la contraseña" required>
                    <i class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Imagen de perfil -->
    <div class="form-group text-center">
        <div class="profile-picture">
            <img src="../avatares/usuario.png" alt="Foto de perfil" id="profile-img"><br>
            <input type="file" id="upload-photo" name="foto" accept="image/*" onchange="updateProfileImage(event)">
            <button type="button" class="btn btn-secondary mt-2" onclick="openFilePicker()">Cambiar Foto</button>
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

        <!-- Modal de confirmación -->
        <div class="modal fade" id="modalExito" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Usuario agregado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">El usuario ha sido agregado correctamente.</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mostrar modal si registro fue exitoso -->
        <?php if (isset($registroExitoso) && $registroExitoso): ?>
            <script>
                const modalExito = new bootstrap.Modal(document.getElementById('modalExito'));
                modalExito.show();
            </script>
        <?php endif; ?>
        <?php include '../includes/footer.php'; ?>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function openFilePicker() {
            document.getElementById('upload-photo').click();
        }

        function updateProfileImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile-img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
