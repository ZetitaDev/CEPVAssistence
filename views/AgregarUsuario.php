<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tema AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</head>



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

            .form-group input, .form-group select {
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


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php
        include '../includes/sidebar.php';
        ?>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Nuevo Usuario</h1>
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
                                    <h3 class="card-title"><i class="fas fa-user-plus nav-icon"></i> Agrega un nuevo Usuario</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-container">
                                        <form>
                                        <!-- Column 1 -->
                                        <div class="form-column">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" id="nombre" placeholder="Ingrese el nombre del/la Estudiante">
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
                                                <label for="nacimiento">Fecha de Ingreso</label>
                                                <input type="date" id="nacimiento" placeholder="Ingrese la fecha de ingreso del/la Estudiante">
                                            </div>


                                            <div class="form-group">
                                                <label for="sexo">Rol</label>
                                                <select id="sexo">
                                                    <option value="">Administrador</option>
                                                    <option value="masculino">Maestro</option>
                                                </select>
                                            </div>

                                        </div>


                                        <!-- Column 2 -->
                                        <div class="form-column">
                                            <div class="form-group">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" id="apellido" placeholder="Ingrese el apellido del/la Estudiante">
                                            </div>

                                            <div class="form-group">
                                                <label for="nacimiento">Cédula </label>
                                                <input type="date" id="nacimiento" placeholder="Ingrese la Fecha de Nacimiento del/la Estudiante">
                                            </div>


                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" id="telefono" placeholder="Ingrese el teléfono del/la Estudiante">
                                            </div>

                                      


                                        </div>
                                    </div>
                                </div>


                               
                               
                            </div>
                            <div class="form-group mx-auto p-2" style="width: 200px;">
                                <input type="submit" class="btn btn-primary"></input>
                            </div>
                            </form>
                        </section>
                    </div>
                    <!-- /.row -->
                </div>
               
            </section>
            <!-- /.content -->
        </div>
        <?php
        include '../includes/footer.php';
        ?>
     
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

</body>
</html>
