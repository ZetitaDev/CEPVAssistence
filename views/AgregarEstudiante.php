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

                    <!-- Main row -->
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-graduation-cap nav-icon"></i> Agrega un nuevo Estudiante</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-container">
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
                                                <label for="sexo">Estado</label>
                                                <select id="sexo">
                                                    <option value="">Seleccione</option>
                                                    <option value="masculino">Activo</option>
                                                    <option value="femenino">Retirado</option>
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
                                                <label for="nacimiento">Fecha de Nacimiento</label>
                                                <input type="date" id="nacimiento" placeholder="Ingrese la Fecha de Nacimiento del/la Estudiante">
                                            </div>


                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" id="telefono" placeholder="Ingrese el teléfono del/la Estudiante">
                                            </div>

                                            <div class="form-group">
                                                <label for="telefono">Curso</label>
                                                <input type="text" id="telefono" placeholder="Ingrese el curso del/la Estudiante">
                                            </div>


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
            <!-- /.content -->
        </div>

        <?php include '../includes/footer.php'; ?>
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
