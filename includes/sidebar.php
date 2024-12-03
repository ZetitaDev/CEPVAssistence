<?php if (!isset($hideSidebar) || !$hideSidebar): ?>
  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="" class="brand-link">
                <span class="brand-text font-weight-light">CEPVA</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>Asistencia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=" views/VerEstudiantes.php" class="nav-link">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Estudiantes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Docente</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Administrador</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

<?php endif; ?>
