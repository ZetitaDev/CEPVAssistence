<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if(!isset($_SESSION['username'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: views/Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CEPVA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tema AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <!-- Estilos adicionales -->
    <link rel="stylesheet" href="~/css/site.css">
    <link rel="stylesheet" href="~/Administrador_de_asistencias_CEPVA.styles.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">

<?php
        include 'includes/sidebar.php';
        ?>

    <!-- Cuerpo principal -->
    <div class="content-wrapper">
    <section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Nuevas órdenes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53%</h3>
                        <p>Tasa de conversión</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Reporte de Actividad</h3>
                    </div>
                    <div class="card-body">
                        <p>Aquí se muestra el contenido del reporte de actividad del usuario.</p>
                    </div>
                </div>
            </section>
    </div>

    

    <!-- Scripts -->
    <script src="~/lib/jquery/dist/jquery.min.js"></script>
    <script src="~/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="~/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>
</html>
