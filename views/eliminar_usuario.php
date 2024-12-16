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

// Obtener los datos del usuario para confirmar la eliminación
$sql = "SELECT nombre, apellido FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Usuario no encontrado.");
}

$user = $result->fetch_assoc();

// Si se recibe la confirmación, eliminar al usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ver_usuarios.php"); // Redirigir después de eliminar
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Confirmar Eliminación</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Confirmar Eliminación</h1>
        <p>¿Está seguro de que desea eliminar al usuario <strong><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></strong>?</p>
        <form method="POST">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="ver_usuarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
