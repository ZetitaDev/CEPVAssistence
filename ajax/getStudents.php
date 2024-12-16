<?php
// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['curso_id'])) {
    $curso_id = $_GET['curso_id'];

    // Consulta para obtener los estudiantes del curso seleccionado
    $sql = "SELECT e.id, e.nombre, e.apellido, e.fecha_nacimiento, e.telefono, e.numero_tutor
            FROM estudiantes e
            WHERE e.curso_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>'; // Mostrar el ID
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['apellido'] . '</td>';
            echo '<td>' . $row['fecha_nacimiento'] . '</td>';
            echo '<td>' . $row['telefono'] . '</td>';
            echo '<td>' . $row['numero_tutor'] . '</td>';
            echo '<td>';
            echo '<a href="VerEstudiante.php?id=' . $row['id'] . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Ver</a>';
            echo ' <a href="EditarEstudiante.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Editar</a>';
            echo ' <button onclick="eliminarEstudiante(' . $row['id'] . ')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Eliminar</button>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="7" class="text-center">No hay estudiantes registrados en este curso.</td></tr>';
    }
}
?>
