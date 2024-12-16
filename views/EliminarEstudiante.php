<?php
// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el estudiante de la base de datos
    $sql = "DELETE FROM estudiantes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Bind del ID para la eliminación

    if ($stmt->execute()) {
        // Redirigir de vuelta a la lista de estudiantes con un mensaje de éxito
        echo "<script>alert('Estudiante eliminado correctamente'); window.location.href = 'ListaEstudiantes.php';</script>";
    } else {
        // Si ocurrió un error
        echo "<script>alert('Error al eliminar el estudiante'); window.location.href = 'ListaEstudiantes.php';</script>";
    }

    $stmt->close();
} else {
    // Si no se recibe un ID válido, redirigir a la lista de estudiantes
    echo "<script>window.location.href = 'VerEstudiantes.php';</script>";
}

$conn->close();
?>
