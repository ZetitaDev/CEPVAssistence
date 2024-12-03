<?php if (!isset($hideSidebar) || !$hideSidebar): ?>


    <!-- Navbar
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Inicio</a>
            </li>
        </ul> -->

        <!-- Dropdown de Usuario -->
        <!-- <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> John Doe
                </button>
                <ul class="dropdown-menu p-3 shadow" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="views/EditarPerfil.php"><i class="fas fa-user me-2"></i>Perfil</a></li>
                    <li><a class="dropdown-item" href="../controllers/logout.php"><i class="fas fa-power-off me-2"></i>Salir</a></li>
                    </ul>
            </li>
        </ul> -->


  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="../dashboard.php" class="brand-link">
                <span class="brand-text font-weight-light">CEPVA</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                        <li class="nav-item">
                            <a href="views/VerAsistencia.php" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>Asistencia</p>
                            </a>
                        </li>                                           
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#submenu-estudiantes" aria-expanded="false">
        <i class="fas fa-graduation-cap nav-icon"></i>
        <p>
            Estudiantes
            <i class="right fas fa-angle-down"></i>
        </p>
    </a>
    <dl class="collapse" id="submenu-estudiantes">
        <li class="nav-item">
        <a href="/CEPVAssistence/views/AgregarEstudiantes.php" class="nav-link">
              <i class="fas fa-user-plus nav-icon"></i>
                <p>Agregar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="views/VerEstudiantes.php" class="nav-link">
                <i class="fas fa-search nav-icon"></i>
                <p>Buscar</p>
            </a>
        </li>
    </dl>
</li>
                        <li class="nav-item">
                            <a href="views/VerDocentes.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Docente</p>
                            </a>
                        </li>


                        <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#submenu-administrador" aria-expanded="false">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>
        Administrador
            <i class="right fas fa-angle-down"></i>
        </p>
    </a>
    <dl class="collapse" id="submenu-administrador">
        <li class="nav-item">
            <a href="views/AgregarUsuario.php" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Agregar Usuario</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="views/VerUsuarios.php" class="nav-link">
                <i class="fas fa-search nav-icon"></i>
                <p>Lista de Usuarios</p>
            </a>
        </li>
    </dl>
</li>


<li class="nav-item">
                            <a href="views/Aulas.php" class="nav-link">
                                <i class="fa-solid fa-school"></i>
                                <p>Aulas</p>
                            </a>
                        </li>


                    </ul>
                </nav>
            </div>
        </aside>

<?php endif; ?>
