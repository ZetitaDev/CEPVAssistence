<?php
// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['curso_id'])) {
    $curso_id = intval($_GET['curso_id']); // Asegúrate de que sea un entero para evitar inyecciones SQL

    // Consulta para obtener los estudiantes del curso
    $sql = "SELECT id, nombre, apellido FROM estudiantes WHERE curso_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['apellido']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay estudiantes en este curso.</td></tr>";
    }
    $stmt->close();
} else {
    echo "<tr><td colspan='4'>No se recibió un curso válido.</td></tr>";
}
?>
