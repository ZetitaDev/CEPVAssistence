-----------------------------------------------------------------------------------
                            Estructura necesaria        
-----------------------------------------------------------------------------------
/asistencia
|-- /css          # Archivos de estilos
|-- /js           # Archivos JavaScript
|-- /includes     # Archivos reutilizables como conexión a la base de datos
|-- /views        # Archivos de interfaz como formularios y tablas
|-- /controllers  # Lógica del sistema (procesar formularios, etc.)
|-- /models       # Consultas a la base de datos
|-- /uploads      # Carpeta para subir archivos (si es necesario)
|-- index.php     # Página principal
-----------------------------------------------------------------------------------
Si una carpeta de las mencionadas no esta es porque no se vio necesaria en el momento,
puede crearse en caso de nececitarla.

-----------------------------------------------------------------------------------
                            Ejemplo de la Estructura        
-----------------------------------------------------------------------------------
/asistencia
|-- /css
|   |-- estilos.css
|
|-- /js
|   |-- script.js
|
|-- /includes
|   |-- db.php
|   |-- header.php
|   |-- footer.php
|
|-- /views
|   |-- login.php
|   |-- register_user.php
|   |-- form_asistencia.php
|   |-- ver_asistencias.php
|
|-- /controllers
|   |-- login_user.php
|   |-- register_user.php
|   |-- registrar_asistencia.php
|   |-- salida_asistencia.php
|
|-- /models
|   |-- usuario_model.php
|   |-- asistencia_model.php
|
|-- index.php
|-- dashboard.php
