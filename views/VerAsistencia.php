<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Asistencia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    include '../includes/sidebar.php';

    // Obtener todos los cursos para el selector
    $cursos = [];
    $queryCursos = "SELECT id, CONCAT(curso, ' - ', nivel) AS curso_nivel FROM cursos";
    $result = $conn->query($queryCursos);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $cursos[] = $row;
      }
    }
    ?>
    <!-- Content Wrapper -->
    <div class="content-wrapper" style="margin-top: -50px;">
      <div class="container mt-5">
        <h1 class="text-center">Consulta de Asistencia</h1>
        <button id="downloadCsv" class="btn btn-primary mt-3" style="display: none; ">
  Descargar CSV
</button> 
        

        <div class="row mb-4">
          <!-- Primer campo (Curso) -->
          <div class="col-md-6">
            <label for="curso_id" class="form-label">Selecciona el Curso:</label>
            <select id="curso_id" name="curso_id" class="form-select" required>
              <option value="" selected disabled>Seleccione un curso</option>
             
              
              <?php foreach ($cursos as $curso): ?>
                <option value="<?= $curso['id']; ?>"><?= $curso['curso_nivel']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Segundo campo (Fecha) -->
          <div class="col-md-6">
            <label for="fecha" class="form-label">Selecciona la Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
          </div>
        </div>


        <div id="resultados" class="mt-4">
          <!-- Los resultados de la asistencia se cargarán aquí -->
        </div>
      </div>
    </div>
    <?php include '../includes/footer.php'; ?>
  </div>

  <script>
   $(document).ready(function () {
  // Función para consultar la asistencia automáticamente
  function consultarAsistencia() {
    const cursoId = $('#curso_id').val();
    const fecha = $('#fecha').val();
    if (cursoId && fecha) {
      // Hacer la solicitud AJAX para obtener la asistencia
      $.ajax({
        url: '../ajax/consultar_asistencia_ajax.php',
        method: 'GET',
        data: {
          curso_id: cursoId,
          fecha: fecha
        },
        success: function (response) {
          // Mostrar los resultados en la página
          $('#resultados').html(`
            <h3>Asistencia del ${fecha} - Curso: ${$('#curso_id option:selected').text()}</h3>
            <div class="table-responsive" style="max-height: 660px; overflow-x: auto;">
              <table class="table table-bordered mt-3" id="tablaAsistencia">
                <thead style="position: sticky; top: 0; background-color: #f1f1f1; border: 1px solid #ddd;">
                  <tr>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Comentario</th>
                  </tr>
                </thead>
                <tbody>
                  ${response}
                </tbody>
              </table>
            </div>
          `);

          // Mostrar el botón de descarga
          $('#downloadCsv').show();
        },
        error: function () {
          alert('Error al cargar los resultados.');
        }
      });
    }
  }

  // Llamar la función cuando el curso o la fecha cambien
  $('#curso_id, #fecha').change(function () {
    consultarAsistencia();
  });

  // Función para descargar los datos de la tabla como CSV
  $('#downloadCsv').click(function () {
    const table = $('#tablaAsistencia');
    let csv = 'Estudiante|Estado|Comentario\n';  // Encabezados del CSV

    // Recorremos las filas de la tabla (sin contar la fila de encabezado)
    table.find('tbody tr').each(function () {
      const row = $(this);
      const estudiante = row.find('td').eq(0).text();
      const estado = row.find('td').eq(1).text();
      const comentario = row.find('td').eq(2).text();

      // Convertimos los datos de la fila a formato CSV
      csv += `"${estudiante}","${estado}","${comentario}"\n`;
    });

    // Crear un enlace de descarga y hacer clic en él
    const hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = `Asistencia_${$('#curso_id option:selected').text()}_${$('#fecha').val()}.csv`;
    hiddenElement.click();
  });
});

document.addEventListener('DOMContentLoaded', function () {
      // Crear un objeto de fecha
      const today = new Date();

      // Obtener el año, mes y día en el formato YYYY-MM-DD
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes empieza en 0, se suma 1
      const day = String(today.getDate()).padStart(2, '0'); // Asegurar que el día tenga dos dígitos

      // Formatear la fecha como YYYY-MM-DD
      const currentDate = `${year}-${month}-${day}`;

      // Establecer el valor predeterminado del input de tipo date
      document.getElementById('fecha').value = currentDate;
    });

  </script>
</body>

</html>