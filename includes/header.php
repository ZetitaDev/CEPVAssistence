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
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Inicio</a>
            </li>
        </ul>

        <!-- Dropdown de Usuario -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> John Doe
                </button>
                <ul class="dropdown-menu p-3 shadow" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href=" views/EditarPerfil.php"><i class="fas fa-user me-2"></i>Perfil</a></li>
                    <li><a class="dropdown-item" href=""><i class="fas fa-power-off me-2"></i>Salir</a></li>
                    </ul>
            </li>
        </ul>
    </nav>

    </body>
    </html>