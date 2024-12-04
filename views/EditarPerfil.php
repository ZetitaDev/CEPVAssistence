<?php
include '../includes/sidebar.php';
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

    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/styleperfil.css">
</head>

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
                                        <!-- Column 1 -->
                                        <div class="form-column">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" id="nombre" placeholder="Ingrese su nombre">
                                            </div>
                                            <div class="form-group">
                                                <label for="sexo">Sexo</label>
                                                <select id="sexo">
                                                    <option value="">Seleccione</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edad">Edad</label>
                                                <input type="number" id="edad" placeholder="Ingrese su Edad">
                                            </div>
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" id="direccion" placeholder="Ingrese su Dirección">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Correo Electrónico</label>
                                                <input type="email" id="email" placeholder="Ingrese su Correo">
                                            </div>
                                        </div>

                                        <!-- Column 2 -->
                                        <div class="form-column">
                                            <div class="form-group">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" id="apellido" placeholder="Ingrese su apellido">
                                            </div>

                                            <div class="form-group">
                                                <label for="nacimiento">Fecha de Nacimiento</label>
                                                <input type="date" id="nacimiento"
                                                    placeholder="Ingrese su Fecha de Nacimiento">
                                            </div>

                                            <div class="form-group">
                                                <label for="nacionalidad">Nacionalidad</label>
                                                <select id="nacionalidad" name="nacionalidad" required>
                                                    <option value="" disabled selected>Seleccione su nacionalidad
                                                    </option>
                                                    <option value="AF">Afganistán</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Argelia</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="BO">Bolivia</option>
                                                    <option value="BR">Brasil</option>
                                                    <option value="CA">Canadá</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="DO">República Dominicana</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egipto</option>
                                                    <option value="ES">España</option>
                                                    <option value="FR">Francia</option>
                                                    <option value="DE">Alemania</option>
                                                    <option value="IN">India</option>
                                                    <option value="IT">Italia</option>
                                                    <option value="JP">Japón</option>
                                                    <option value="MX">México</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="PE">Perú</option>
                                                    <option value="RU">Rusia</option>
                                                    <option value="ZA">Sudáfrica</option>
                                                    <option value="SE">Suecia</option>
                                                    <option value="GB">Reino Unido</option>
                                                    <option value="US">Estados Unidos</option>
                                                    <option value="VE">Venezuela</option>
                                                    <!-- Añade más países según necesidad -->
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" id="telefono" placeholder="Ingrese su teléfono">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Contraseña</label>
                                                <input type="password" id="password" placeholder="Ingrese su contraseña">
                                            </div>
                                        </div>

                                        <!-- Column 3 -->
                                        <div class="profile-picture">
                                            <img src="https://via.placeholder.com/150" alt="Foto de perfil"
                                                id="profile-img"><br>
                                            <button class="btn btn-primary mt-2" onclick="openAvatarModal()">Cambiar
                                                Foto</button>
                                            <input type="file" id="upload-photo" accept="image/*"
                                                onchange="updateProfileImage(event)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-warning" type="button">Actualizar</button>
                                <button class="btn btn-secondary" type="button">Cancelar</button>
                            </div>


                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal para selección de avatares -->
    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">Seleccionar Avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <img src="../avatares/nino.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/hombre.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/hombre chaqueta roja.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/jugador.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/hombre rubio.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/mujerpcorto.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/mujer morena.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="../avatares/mujer.png" class="img-thumbnail avatar-option"
                                onclick="selectAvatar(this.src)">
                        </div>
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

        function removeProfileImage() {
    const profileImg = document.getElementById('profile-img'); // Cambia 'profile-img' si usas otro id
    profileImg.src = "../avatares/usuario.png"; // Imagen predeterminada
}
    </script>

</body>
<?php
        include '../includes/footer.php';
        ?>
</html>
