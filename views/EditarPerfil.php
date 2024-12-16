<?php
// Incluir el archivo de conexión a la base de datos
include '../includes/sidebar.php';

// Suponemos que el correo del usuario está almacenado en la sesión
$correo = $_SESSION['username'];

// Consultar los datos del usuario usando el correo
$query = "SELECT nombre, apellido, sexo, correo, telefono, fecha_nacimiento, foto_perfil FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo); // 's' para indicar que es un string
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
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
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../css/styleperfil.css">
</head>

<style>
    input[readonly] {
        background-color: rgb(255, 255, 255);
        cursor: not-allowed;
    }

    /* Añadir margen para separación */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-column {
        margin-bottom: 2rem;
    }

    .modal-body .form-group {
        margin-bottom: 1.2rem;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Mi Perfil</h1>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user mr-1"></i>Editar Perfil</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-container">
                                        <div class="form-column">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" id="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" placeholder="Ingrese su nombre">
                                            </div>
                                            <div class="form-group">
                                                <label for="sexo">Sexo</label>
                                                <select id="sexo">
                                                    <option value="M" <?php echo ($user['sexo'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                                                    <option value="F" <?php echo ($user['sexo'] == 'F') ? 'selected' : ''; ?>>Femenino</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="correo">Correo Electrónico</label>
                                                <input type="email" id="correo" value="<?php echo htmlspecialchars($user['correo']); ?>" placeholder="Ingrese su Correo" readonly>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#passwordModal">Cambiar Contraseña</button>
                                            </div>
                                        </div>

                                        <div class="form-column">
                                            <div class="form-group">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" id="apellido" value="<?php echo htmlspecialchars($user['apellido']); ?>" placeholder="Ingrese su apellido">
                                            </div>
                                            <div class="form-group">
                                                <label for="nacimiento">Fecha de Nacimiento</label>
                                                <input type="date" id="nacimiento" value="<?php echo $user['fecha_nacimiento']; ?>" placeholder="Ingrese su Fecha de Nacimiento">
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" id="telefono" value="<?php echo htmlspecialchars($user['telefono']); ?>" placeholder="Ingrese su teléfono">
                                            </div>
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-warning" type="button" onclick="updateProfile()">Actualizar</button>
                                                <button class="btn btn-secondary" type="button" onclick="cancelEdit()">Cancelar</button>
                                            </div>
                                        </div>

                                        <!-- Perfil y foto -->
                                        <div class="profile-picture">
                                            <img src="../avatares/<?php echo htmlspecialchars($user['foto_perfil']); ?>" alt="Foto de perfil" id="profile-img" class="img-thumbnail">
                                            <br>
                                            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#avatarModal">Cambiar Foto</button>
                                            <input type="file" id="upload-photo" accept="image/*" onchange="updateProfileImage(event)" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../includes/footer.php'; ?>
    </div>

    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="newPassword">Nueva Contraseña</label>
                        <div class="input-group">
                            <input type="password" id="newPassword" class="form-control" placeholder="Ingrese su nueva contraseña" onkeyup="checkPasswordStrength()">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('newPassword')"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="passwordStrength">Nivel de Dificultad</label>
                        <input type="text" id="passwordStrength" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirmPassword">Confirmación de Contraseña</label>
                        <div class="input-group">
                            <input type="password" id="confirmPassword" class="form-control" placeholder="Confirme su nueva contraseña">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('confirmPassword')"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="confirmPasswordChange()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para selección de avatar -->
    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">Selecciona Tu Avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="upload-photo">Sube una imagen</label>
                        <input type="file" id="upload-photo" accept="image/*" onchange="updateProfileImage(event)" class="form-control">
                    </div>
                    <div class="row">
                        <!-- Opciones de avatar (opcional si no quieres cargar una imagen personalizada) -->
                        <div class="col-4 mb-3"><img src="../avatares/nino.png" class="img-thumbnail avatar-option" onclick="selectAvatar(this.src)"></div>
                        <div class="col-4 mb-3"><img src="../avatares/hombre.png" class="img-thumbnail avatar-option" onclick="selectAvatar(this.src)"></div>
                        <div class="col-4 mb-3"><img src="../avatares/mujer.png" class="img-thumbnail avatar-option" onclick="selectAvatar(this.src)"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="acceptAvatarSelection()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencia Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Función para mostrar u ocultar las contraseñas
        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const icon = passwordField.nextElementSibling.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Función para verificar la fuerza de la contraseña
        function checkPasswordStrength() {
            const password = document.getElementById('newPassword').value;
            const strengthField = document.getElementById('passwordStrength');
            
            let strength = 0;
            
            // Evalúa la fuerza de la contraseña
            if (password.length >= 8) strength += 1; // Al menos 8 caracteres
            if (/[A-Z]/.test(password)) strength += 1; // Letra mayúscula
            if (/[a-z]/.test(password)) strength += 1; // Letra minúscula
            if (/[0-9]/.test(password)) strength += 1; // Número
            if (/[^A-Za-z0-9]/.test(password)) strength += 1; // Caracter especial

            // Asignar nivel de dificultad
            if (strength === 0) {
                strengthField.value = "Muy débil";
            } else if (strength <= 2) {
                strengthField.value = "Débil";
            } else if (strength === 3) {
                strengthField.value = "Fuerte";
            } else {
                strengthField.value = "Muy fuerte";
            }
        }

        // Función para aceptar el cambio de contraseña
        function confirmPasswordChange() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword === confirmPassword) {
        // Enviar la nueva contraseña al backend para actualizarla
        fetch('cambiar_contrasena.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ newPassword: newPassword })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Contraseña actualizada correctamente.');
                document.getElementById('passwordModal').modal('hide');
            } else {
                alert('Error al cambiar la contraseña.');
            if (newPassword === confirmPassword) {
                // Aquí agregas la lógica para actualizar la contraseña en el servidor (AJAX, etc.)
                alert("Contraseña cambiada correctamente.");
                $('#passwordModal').modal('hide');
            } else {
                alert("Las contraseñas no coinciden.");
            }
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            alert('Hubo un problema al cambiar la contraseña.');
        });
    } else {
        alert('Las contraseñas no coinciden.');
    }
}

        // Función para actualizar la foto de perfil
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

        // Función para aceptar selección de avatar
        function selectAvatar(src) {
            document.getElementById('profile-img').src = src;
            $('#avatarModal').modal('hide');
        }

        function acceptAvatarSelection() {
            const imgSrc = document.getElementById('profile-img').src;
            // Lógica para guardar el nuevo avatar (puede ser un AJAX call)
        }
    </script>
</body>

</html>
