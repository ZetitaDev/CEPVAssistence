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

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .strength-bar {
            width: 100%;
            height: 5px;
            margin-top: 5px;
            border-radius: 5px;
        }

        .strength-weak {
            background-color: red;
        }

        .strength-medium {
            background-color: orange;
        }

        .strength-strong {
            background-color: green;
        }

        .button-container {
            display: flex;
            gap: 10px;
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
                                                    <label for="password">Nueva Contraseña</label>
                                                    <div class="password-container">
                                                        <i class="toggle-password fas fa-eye" onclick="togglePassword('password')"></i>
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese la nueva contraseña" required>
                                                    </div>
                                                    <div id="strength-bar" class="strength-bar"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Confirmar Contraseña</label>
                                                    <div class="password-container">
                                                        <i class="toggle-password fas fa-eye" onclick="togglePassword('confirm_password')"></i>
                                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirme la contraseña" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_strength">Nivel de Dificultad</label>
                                                    <input type="text" id="password_strength" class="form-control" disabled>
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
                                                    </select><BR>
                                                    <div class="form-group">
                                                    <label for="telefono">Teléfono</label>
                                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="Ingrese el correo" required>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group text-center button-container">
                                            <button type="submit" class="btn btn-primary">Confirmar</button>
                                            <button type="button" class="btn btn-secondary" onclick="window.location.href='CancelarURL'">Cancelar</button>
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
    // Validar la fuerza de la contraseña
    document.getElementById('password').addEventListener('input', function () {
        var password = this.value;
        var strengthBar = document.getElementById('strength-bar');
        var strengthText = document.getElementById('password_strength');

        // Expresiones regulares para diferentes niveles de fuerza
        var weak = /^(?=\S)(?!.*\d)(?!.*[!@#$%^&*])[A-Za-z]{1,5}$/;  // Menos de 6 caracteres sin números ni símbolos
        var medium = /^(?=\S)(?=.*\d)(?=[A-Za-z0-9]{6,8}$)(?!.*[!@#$%^&*])[A-Za-z0-9]*$/;  // 6-8 caracteres con números
        var strong = /^(?=\S)(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{9,}$/;  // Más de 8 caracteres con números y símbolos

        // Verificación de la fuerza de la contraseña
        if (strong.test(password)) {
            strengthBar.classList.add('strength-strong');
            strengthBar.classList.remove('strength-medium', 'strength-weak');
            strengthText.value = "Fuerte";
        } else if (medium.test(password)) {
            strengthBar.classList.add('strength-medium');
            strengthBar.classList.remove('strength-strong', 'strength-weak');
            strengthText.value = "Medio";
        } else if (weak.test(password)) {
            strengthBar.classList.add('strength-weak');
            strengthBar.classList.remove('strength-strong', 'strength-medium');
            strengthText.value = "Débil";
        } else {
            strengthBar.classList.remove('strength-strong', 'strength-medium', 'strength-weak');
            strengthText.value = "Muy débil";
        }
    });
</script>
</body>

</html>
