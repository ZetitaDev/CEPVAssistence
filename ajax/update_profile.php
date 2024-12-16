<?php
// Incluir la conexión a la base de datos
include '../includes/sidebar.php';

// Obtener los datos enviados a través de AJAX
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$sexo = $_POST['sexo'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$correo = $_POST['correo'];
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Si se envió una nueva contraseña, actualizamos también la contraseña
if (!empty($password)) {
    // Aquí deberías aplicar un hash a la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE usuarios SET nombre = ?, apellido = ?, sexo = ?, telefono = ?, fecha_nacimiento = ?, password = ? WHERE correo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $nombre, $apellido, $sexo, $telefono, $fecha_nacimiento, $hashed_password, $correo);
} else {
    $query = "UPDATE usuarios SET nombre = ?, apellido = ?, sexo = ?, telefono = ?, fecha_nacimiento = ? WHERE correo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $nombre, $apellido, $sexo, $telefono, $fecha_nacimiento, $correo);
}

// Ejecutar la consulta y verificar si se actualizó correctamente
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Actualizacion exitosa."]);
} else {
    echo json_encode(["success" => false, "message" => "Error al actualizar el perfil"]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
