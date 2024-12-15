<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['username'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: Login.php");
    exit();
}

// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre del usuario actual
$username = $_SESSION['username']; // Supongamos que el username (correo) se guarda en la sesión

$query = "SELECT nombre FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el usuario
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nombreUsuario = $user['nombre'];
} else {
    // En caso de que no se encuentre, usar un valor genérico
    $nombreUsuario = "Usuario";
}

$stmt->close();
?>

<?php if (!isset($hideSidebar) || !$hideSidebar): ?>
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="../views/dashboard.php" class="brand-link d-flex align-items-center">
            <!-- Imagen pequeña -->
            <img src="../css/loguito.png" alt="Logo" class="brand-image">
            <span class="brand-text font-weight-light text-shift">CEPVAssistences</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#submenu-asistencia"
                        aria-expanded="false">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>
                            Asistencia
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <dl class="collapse" id="submenu-asistencia">
                        <li class="nav-item">
                            <a href="../views/VerAsistencia.php" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Ver Asistencia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="PasarAsistencia.php" class="nav-link">
                                <i class="fas fa-search nav-icon"></i>
                                <p>Pasar Asistencia</p>
                            </a>
                        </li>
</dl>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#submenu-estudiantes"
                            aria-expanded="false">
                            <i class="fas fa-graduation-cap nav-icon"></i>
                            <p>
                                Estudiantes
                                <i class="right fas fa-angle-down"></i>
                            </p>
                        </a>
                        <dl class="collapse" id="submenu-estudiantes">
                    <li class="nav-item">
                        <a href="../views/AgregarEstudiante.php" class="nav-link">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Agregar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="VerEstudiantes.php" class="nav-link">
                            <i class="fas fa-search nav-icon"></i>
                            <p>Buscar</p>
                        </a>
                    </li>
                    </dl>
                    </li>
                    <li class="nav-item">
                        <a href="VerDocentes.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Docente</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#submenu-administrador"
                            aria-expanded="false">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Administrador
                                <i class="right fas fa-angle-down"></i>
                            </p>
                        </a>
                        <dl class="collapse" id="submenu-administrador">
                    <li class="nav-item">
                        <a href="AgregarUsuario.php" class="nav-link">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Agregar Usuario</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="VerUsuarios.php" class="nav-link">
                            <i class="fas fa-search nav-icon"></i>
                            <p>Lista de Usuarios</p>
                        </a>
                    </li>
                    </dl>
                    </li>
                    <li class="nav-item">
                        <a href="Aulas.php" class="nav-link">
                            <i class="fa-solid fa-school"></i>
                            <p>Aulas</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'CEPVA'; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/site.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <!-- Agrega tus otros estilos aquí -->
    <link rel="stylesheet" href="../css/Administrador_de_asistencias_CEPVA.styles.css">
</head>

<body class="hold-transition sidebar-mini">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Dropdown de Usuario -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> <?php echo htmlspecialchars($nombreUsuario); ?>
                </button>
                <ul class="dropdown-menu p-3 shadow" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="EditarPerfil.php"><i class="fas fa-user me-2"></i>Perfil</a></li>
                    <li><a class="dropdown-item" href="../controllers/logout.php"><i
                                class="fas fa-power-off me-2"></i>Salir</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</body>

</html>