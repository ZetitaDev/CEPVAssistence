<?php
include '../includes/sidebar.php';

$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los usuarios (administradores y usuarios)
$sql = "SELECT nombre, apellido, sexo, rol, correo, curso_id FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);  // Obtener todos los usuarios
} else {
    $users = [];  // Si no hay usuarios, crear un arreglo vacío
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $correo = $_POST['correo'];  // Correo del usuario a editar
        // Redirección sin salida antes de usar 'header'
        header("Location: editar_usuario.php?correo=$correo");
        exit();
    } elseif (isset($_POST['delete'])) {
        $correo = $_POST['correo'];  // Correo del usuario a eliminar
        // Consulta para eliminar el usuario
        $delete_sql = "DELETE FROM usuarios WHERE correo = '$correo'";
        if ($conn->query($delete_sql) === TRUE) {
            // Usar redirección sin salida antes de header
            header("Location: VerUsuarios.php");
            exit();
        } else {
            echo "Error al eliminar usuario: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <h1>Lista de Usuarios</h1>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <input class="form-control shadow bg-body rounded" id="myInput" type="text" placeholder="Buscar..." style="margin: 5px">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Sexo</th>
                                                <th>Curso</th>
                                                <th>Rol</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?php echo $user['nombre']; ?></td>
                                                <td><?php echo $user['apellido']; ?></td>
                                                <td><?php echo $user['sexo']; ?></td>
                                                <td>
                                                    <?php
                                                        if (!empty($user['curso_id'])) {
                                                            // Obtener el nombre del curso basado en el curso_id
                                                            $curso_sql = "SELECT curso FROM cursos WHERE id = " . $user['curso_id'];
                                                            $curso_result = $conn->query($curso_sql);
                                                            if ($curso_result->num_rows > 0) {
                                                                $curso = $curso_result->fetch_assoc()['curso'];
                                                                echo $curso;
                                                            } else {
                                                                echo "Curso no encontrado";
                                                            }
                                                        } else {
                                                            echo "No asignado";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo ucfirst($user['rol']); ?></td>
                                                <td>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="correo" value="<?php echo $user['correo']; ?>">
                                                        <button type="submit" name="edit" class="btn btn-warning">Editar</button>
                                                        <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>

    <script>
        document.getElementById('myInput').addEventListener('keyup', function () {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#myTable tr');

            rows.forEach(function (row) {
                var cells = row.getElementsByTagName('td');
                var found = false;

                for (var i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(input)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            });
        });
    </script>
</body>
</html>
