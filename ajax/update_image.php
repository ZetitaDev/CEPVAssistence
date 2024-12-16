<?php
session_start();
include '../includes/db_connection.php'; // Asegúrate de que este archivo solo contenga la conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto_perfil'])) {
    $correo = $_POST['correo'];

    if ($_FILES['foto_perfil']['error'] == 0) {
        // Definir el directorio de subida
        $targetDir = "../avatares/";
        $targetFile = $targetDir . basename($_FILES["foto_perfil"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Verificar si la imagen es una imagen real o un falso
        if (getimagesize($_FILES["foto_perfil"]["tmp_name"]) === false) {
            echo json_encode(["success" => false, "message" => "El archivo no es una imagen"]);
            exit;
        }

        // Verificar si el archivo ya existe
        if (file_exists($targetFile)) {
            echo json_encode(["success" => false, "message" => "El archivo ya existe"]);
            exit;
        }

        // Verificar el tamaño del archivo
        if ($_FILES["foto_perfil"]["size"] > 500000) { // 500 KB
            echo json_encode(["success" => false, "message" => "El archivo es demasiado grande"]);
            exit;
        }

        // Permitir ciertos formatos
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo json_encode(["success" => false, "message" => "Solo se permiten archivos JPG, JPEG y PNG"]);
            exit;
        }

        // Intentar subir el archivo
        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $targetFile)) {
            // Actualizar la base de datos con la nueva ruta de la foto
            $newImage = basename($_FILES["foto_perfil"]["name"]);

            // Consulta para actualizar la base de datos
            $query = "UPDATE usuarios SET foto_perfil = ? WHERE correo = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $newImage, $correo);

            if ($stmt->execute()) {
                // Responder con la URL de la nueva imagen
                echo json_encode(["success" => true, "new_image_url" => "../avatares/" . $newImage]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al actualizar la base de datos: " . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Error al subir la imagen"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error en la subida del archivo"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Solicitud no válida"]);
}

// Cerrar la conexión
$conn->close();
?>