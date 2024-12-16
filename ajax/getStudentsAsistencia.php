<?php
// Conectar a la base de datos
$conn = new mysqli("152.167.11.242", "admin", "CePv4dm1n4s1s", "cepvassistence");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar la solicitud solo si se recibe un curso válido
if (isset($_GET['curso_id']) && is_numeric($_GET['curso_id'])) {
    $curso_id = intval($_GET['curso_id']); // Sanitizar el parámetro

    // Consulta para obtener los estudiantes del curso
    $sql = "SELECT id, nombre, apellido FROM estudiantes WHERE curso_id = ? AND estado = 'activo'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nombre']} {$row['apellido']}</td>
                    <td>
                        <select name='estado[{$row['id']}]' class='form-select' required>
                            <option value='' selected disabled>Estado</option>
                            <option value='presente'>Presente</option>
                            <option value='ausente'>Ausente</option>
                            <option value='tardanza'>Tardanza</option>
                            <option value='justificado'>Justificado</option>
                        </select>
                    </td>
                    <td>
                        <input type='text' name='comentario[{$row['id']}]' class='form-control' placeholder='Comentario opcional'>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center'>No hay estudiantes registrados en este curso.</td></tr>";
    }

    $stmt->close();
} else {
    echo "<tr><td colspan='3' class='text-center'>No se recibió un curso válido.</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
