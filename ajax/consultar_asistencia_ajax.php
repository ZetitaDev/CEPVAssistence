<?php
// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se recibieron los parámetros de curso y fecha
if (isset($_GET['curso_id']) && isset($_GET['fecha'])) {
    $curso_id = intval($_GET['curso_id']);
    $fecha = $_GET['fecha'];

    // Consultar la asistencia de ese curso en esa fecha
    $asistencia = [];
    $queryAsistencia = "SELECT a.id, e.nombre, e.apellido, a.estado, a.comentario
                        FROM asistencia a
                        JOIN estudiantes e ON a.estudiante_id = e.id
                        WHERE a.curso_id = ? AND a.fecha = ?
                        ORDER BY e.apellido, e.nombre";
    $stmt = $conn->prepare($queryAsistencia);
    $stmt->bind_param("is", $curso_id, $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $asistencia[] = $row;
    }
    $stmt->close();

    // Mostrar los resultados en formato HTML
    if (!empty($asistencia)) {
        foreach ($asistencia as $registro) {
            echo "<tr>
                    <td>{$registro['nombre']} {$registro['apellido']}</td>
                    <td>" . ucfirst($registro['estado']) . "</td>
                    <td>{$registro['comentario']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center'>No se encontró asistencia para este curso en la fecha seleccionada.</td></tr>";
    }
}
?>
