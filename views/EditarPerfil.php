<?php
        include '../includes/header.php';
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

        .profile-picture input[type="file"] {
            display: block;
            margin: 10px auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .password-container {
            position: relative;
            display: inline-block;
        }

        .password-container input {
            padding-right: 30px;
        }

        .toggle-password {
            position: absolute;
            top: 70%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #000000;
        }
    </style>
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
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
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

                                            <div class="form-group password-container">
                                                <label for="password">Contraseña</label>
                                                <input type="password" id="password" placeholder="Ingrese su teléfono">
                                                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                                            </div>

                                        </div>

                                        <!-- Column 3 -->
                                        <div class="profile-picture">
                                            <img src="https://via.placeholder.com/150" alt="Foto de perfil"
                                                id="profile-img">
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

                    </div>


            </section>
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>


    <!--  Visualizacion de la imagen en tiempo real con javascript-->
    <script>
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

    <!-- Funcion para ver y ocultar
    El campo contraseña se alterna de tipo "password" a tipo "text" -->

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
    </script>


    <!-- Busqueda  en vivo de los paises para el campo input "nacionalidad"-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#nacionalidad').select2({
                placeholder: "Seleccione su nacionalidad",
                allowClear: true
            });
        });
    </script>

        <?php
        include '../includes/footer.php';
        ?>

</body>

</html>