<?php
include '../includes/sidebar.php';

// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar que 'id' esté presente en la URL y sea un número entero
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de usuario no válido.");
}

$id = $_GET['id'];

// Obtener los datos del usuario
$sql = "SELECT u.id, u.nombre, u.apellido, u.sexo, u.rol, c.curso_id, c.curso, c.nivel, c.seccion 
        FROM usuarios u 
        LEFT JOIN cursos c ON u.curso_id = c.id 
        WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Usuario no encontrado.");
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el formulario de edición
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $sexo = $_POST['sexo'];
    $rol = $_POST['rol'];
    $curso_id = $_POST['curso_id'];

    // Actualizar el usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, sexo = ?, rol = ?, curso_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $nombre, $apellido, $sexo, $rol, $curso_id, $id);
    $stmt->execute();

    header("Location: ver_usuarios.php"); // Redirigir después de actualizar
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Usuario</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Usuario</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $user['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $user['apellido']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="M" <?php echo $user['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo $user['sexo'] == 'F' ? 'selected' : ''; ?>>Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="administrador" <?php echo $user['rol'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                    <option value="usuario" <?php echo $user['rol'] == 'usuario' ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select class="form-select" id="curso_id" name="curso_id" required>
                    <?php
                    // Obtener todos los cursos disponibles
                    $sql = "SELECT id, curso, nivel, seccion FROM cursos";
                    $result = $conn->query($sql);
                    while ($curso = $result->fetch_assoc()) {
                        echo '<option value="' . $curso['id'] . '" ' . ($user['curso_id'] == $curso['id'] ? 'selected' : '') . '>';
                        echo $curso['curso'] . ' (' . $curso['nivel'] . ' - ' . $curso['seccion'] . ')';
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
