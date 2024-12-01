<?php
// Definir variables para el control de visibilidad
$hideSidebar = false; // Cambia a true para ocultar la sidebar
$hideNavbar = false; // Cambia a true para ocultar el navbar
$hideFooter = false; // Cambia a true para ocultar el footer
$title = "Página Principal - CEPVA"; // Título de la página

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/site.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Otros estilos -->
    <link rel="stylesheet" href="css/Administrador_de_asistencias_CEPVA.styles.css">
</head>
<body>

    <!-- Navbar -->
    <?php if (!$hideNavbar): ?>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if (!$hideSidebar): ?>
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    <?php endif; ?>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Inicio</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i> John Doe
                    </button>
                    <ul class="dropdown-menu p-3 shadow" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="perfil.php"><i class="fas fa-user me-2"></i>Perfil</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-power-off me-2"></i>Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

    <!-- Sidebar -->
    <?php if (!$hideSidebar): ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index.php" class="brand-link">
                <span class="brand-text font-weight-light">CEPVA</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                        <li class="nav-item">
                            <a href="student.php" class="nav-link">
                                <i class="fas fa-graduation-cap nav-icon"></i>
                                <p>Estudiantes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="attendance.php" class="nav-link">
                                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                <p>Asistencia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="teacher.php" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Docentes</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    <?php endif; ?>

    <!-- Contenido Principal -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <h1>Bienvenido al sistema de gestión de asistencia</h1>
            <p>Aquí puedes gestionar la asistencia de los estudiantes y demás funciones relacionadas.</p>
        </div>
    </div>

    <!-- Footer -->
    <?php if (!$hideFooter): ?>
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 The Proxtys. Todos los derechos reservados.</strong>
        </footer>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/site.js"></script>
    <script>
        // Opcional: Agregar más scripts o lógica JavaScript si es necesario
    </script>

</body>
</html>
