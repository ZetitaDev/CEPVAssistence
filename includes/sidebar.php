<?php if (!isset($hideSidebar) || !$hideSidebar): ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../views/dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light">CEPVA</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                <li class="nav-item">
                    <a href="../views/student.php" class="nav-link">
                        <i class="fas fa-graduation-cap nav-icon"></i>
                        <p>Estudiantes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../views/attendance.php" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Asistencia</p>
                    </a>
                </li>
                <!-- Agrega los demás enlaces según tus necesidades -->
            </ul>
        </nav>
    </div>
</aside>
<?php endif; ?>
