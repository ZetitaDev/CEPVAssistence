<?php
// Incluir el archivo de conexión a la base de datos
include '../includes/sidebar.php';

if (!isset($_SESSION['username'])) {
    // Si no hay usuario logueado, redirigir al login
    header('Location: login.php');
    exit();
}

$correo = $_SESSION['username'];

// Consultar los datos del usuario usando el correo
$query = "SELECT id, nombre, apellido, sexo, correo, telefono, fecha_nacimiento, foto_perfil FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo); // 's' para indicar que es un string
$stmt->execute();
$result = $stmt->get_result();

// Verificar si la consulta devuelve datos
if ($result->num_rows > 0) {
    // Obtener los datos del usuario
    $user = $result->fetch_assoc();
} else {
    // Si no se encuentra el usuario, redirigir o mostrar un mensaje
    echo "No se encontraron datos para este usuario.";
    exit();
}
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

    /* Estilo para mejorar separación en el modal de la contraseña */
    .modal-body .form-group {
        margin-bottom: 1.2rem;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper"><?php include '../includes/sidebar.php'; ?>
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
                                                <button class="btn btn-warning" onclick="openPasswordModal()">Cambiar Contraseña</button>
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
                                            <button class="btn btn-primary mt-2" onclick="openAvatarModal()">Cambiar Foto</button>
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
                    <button type="button" class="btn btn-primary" onclick="confirmPasswordChange()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openPasswordModal() {
            const passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
            passwordModal.show();
        }

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function checkPasswordStrength() {
            const password = document.getElementById('newPassword').value;
            let strength = '';
            const strengthBar = document.getElementById('passwordStrength');
            
            const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            const mediumPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,}$/;

            if (strongPasswordPattern.test(password)) {
                strength = 'Fuerte';
            } else if (mediumPasswordPattern.test(password)) {
                strength = 'Media';
            } else {
                strength = 'Débil';
            }

            strengthBar.value = strength;
        }

        function confirmPasswordChange() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword === confirmPassword) {
                alert('Contraseña cambiada correctamente');
                // Aquí puedes agregar la lógica para cambiar la contraseña en la base de datos
            } else {
                alert('Las contraseñas no coinciden.');
            }
        }

        function updateProfile() {
            alert('Perfil actualizado correctamente');
            // Aquí agregar lógica para actualizar los datos en la base de datos
        }

        function cancelEdit() {
            window.location.reload();
        }

        function openAvatarModal() {
            document.getElementById('upload-photo').click();
        }

        function updateProfileImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>

</html>
