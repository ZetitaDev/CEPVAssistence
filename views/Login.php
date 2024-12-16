<?php
session_start(); // Iniciar sesión

// Si ya hay una sesión activa, redirigir al dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // Asegúrate de que esta ruta sea correcta
    exit();
}

// Conexión a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$error_message = ""; // Variable para almacenar el mensaje de error

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para obtener los datos del usuario por correo
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Obtener los datos del usuario

        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($password, $user['password'])) {
            // Credenciales correctas, guardar datos en la sesión
            $_SESSION['username'] = $user['correo']; // Guardar el correo en la sesión
            $_SESSION['role'] = $user['rol']; // Guardar el rol en la sesión

            // Redirigir según el rol del usuario
            if ($_SESSION['role'] == 'usuario') {
                header("Location: dashboard_maestro.php"); // Redirigir a dashboard de maestro
            } else {
                header("Location: dashboard.php"); // Redirigir al dashboard de administrador u otro rol
            }
            exit();
        } else {
            // Si la contraseña no coincide
            $error_message = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        // Si el usuario no existe
        $error_message = "Credenciales incorrectas. Inténtalo de nuevo.";
    }

    $stmt->close(); // Cerrar el statement
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../css/stylelogin.css">
</head>
<body class="hold-transition login-page">
    <div class="image-container">
        <img src="../css/logocepva.png" alt="Logo" class="login-image">
    </div>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>CEPVA</b>ssistence</a>
            </div>
            <div class="card-body">
                <form method="post" id="loginForm">
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Correo" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye toggle-password" id="togglePassword" style="cursor: pointer;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (!empty($error_message)): ?>
        <div class="overlay"></div>
        <div class="error-message" id="errorMessage">
            <button class="close-btn" onclick="closeErrorMessage()">×</button>
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <script>
        // Función para mostrar el mensaje de error con efecto de zoom
        $(document).ready(function() {
            if ($('#errorMessage').length) {
                $('#errorMessage').css('transform', 'translateX(-50%) scale(1)'); // Aparece con efecto zoom
            }
        });

        // Función para cerrar la cajita de error y limpiar el formulario
        function closeErrorMessage() {
            document.querySelector('.error-message').style.display = 'none';
            document.querySelector('.overlay').style.display = 'none';
            document.getElementById('loginForm').reset(); // Limpia el formulario
        }

        // Mostrar/ocultar contraseña
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const passwordFieldType = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = passwordFieldType;

            // Cambiar el ícono del ojo
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
