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

                                            <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-warning" type="button" onclick="updateProfile()">Actualizar</button>
                                                <button class="btn btn-secondary" type="button" onclick="cancelEdit()">Cancelar</button>
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
                                            <div class="form-group">
                                                <label for="password">Contraseña</label>
                                                <input type="password" id="password" placeholder="Ingrese su contraseña">
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
                        </section>
                    </div>
                </div>
            </section>
        </div>

        <?php
        include '../includes/footer.php';
        ?>
    </div>

    <!-- Modal para selección de avatares -->
    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">Selecciona Tu Avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Avatares predefinidos -->
                    <div class="row">
                        <div class="col-4 mb-3">
                            <img src="../avatares/nino.png" class="img-thumbnail avatar-option" onclick="selectAvatar(this.src)">
                        </div>
                        <!-- Más avatares -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="openFilePicker()">Subir Imagen</button>
                    <button type="button" class="btn btn-danger" onclick="removeProfileImage()">Eliminar Foto de Perfil</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openAvatarModal() {
            const avatarModal = new bootstrap.Modal(document.getElementById('avatarModal'));
            avatarModal.show();
        }

        function selectAvatar(src) {
            document.getElementById('profile-img').src = src;
            const avatarModal = bootstrap.Modal.getInstance(document.getElementById('avatarModal'));
            avatarModal.hide();
        }

        function openFilePicker() {
            document.getElementById('upload-photo').click();
        }

        function removeProfileImage() {
            document.getElementById('profile-img').src = "../avatares/usuario.png";
        }

        function updateProfile() {
    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const sexo = document.getElementById('sexo').value;
    const telefono = document.getElementById('telefono').value;
    const nacimiento = document.getElementById('nacimiento').value;
    const password = document.getElementById('password').value;

    // Comprobar si la contraseña está vacía (si no lo está, se incluye)
    const passwordParam = password ? `&password=${encodeURIComponent(password)}` : '';

    // Crear la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../ajax/update_profile.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Manejar la respuesta de la solicitud
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Alerta si la actualización fue exitosa
                alert('Perfil actualizado correctamente');
                location.reload();  // Recargar la página para reflejar los cambios
            } else {
                // Alerta si hubo un error en la actualización
                alert('Error al actualizar el perfil: ' + response.message);
            }
        } else {
            // Alerta si hubo un error en la solicitud AJAX
            alert('Error al enviar la solicitud. Estado: ' + xhr.status);
        }
    };

    // Enviar los datos al servidor
    xhr.send(`nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&sexo=${encodeURIComponent(sexo)}&telefono=${encodeURIComponent(telefono)}&fecha_nacimiento=${encodeURIComponent(nacimiento)}&correo=${encodeURIComponent('<?php echo $correo; ?>')}${passwordParam}`);
}


        // Función para cancelar la edición
        function cancelEdit() {
            alert("Edición cancelada");
            header (location, 'dashboard.php');
        }
    </script>
</body>
</html>